#!/bin/sh

# 定义颜色
COLOR_RED='\033[0;31m'
COLOR_GREEN='\033[0;32m'
COLOR_YELLOW='\033[1;33m'
COLOR_BLUE='\033[0;34m'
COLOR_RESET='\033[0m'

# 封装彩色输出函数
echo_info() {
  echo -e "${COLOR_BLUE}[INFO]${COLOR_RESET} $*"
}

echo_success() {
  echo -e "${COLOR_GREEN}[SUCCESS]${COLOR_RESET} $*"
}

echo_warn() {
  echo -e "${COLOR_YELLOW}[WARN]${COLOR_RESET} $*"
}

echo_error() {
  echo -e "${COLOR_RED}[ERROR]${COLOR_RESET} $*"
}

# 正式开始
echo_info "Starting container for SERVICE_NAME=$SERVICE_NAME..."

ROOT_PATH="/var/www/html"

SOURCE_DIR="${ROOT_PATH}/nexus/Install/install"
TARGET_DIR="${ROOT_PATH}/public"
ENV_FILE="${ROOT_PATH}/.env"
VENDOR_DIR="${ROOT_PATH}/vendor"

chown -R www-data:www-data $ROOT_PATH

until nc -z mysql 3306; do
  echo_info "Waiting for MySQL to be ready..."
  sleep 2
done
echo_success "MySQL is ready."

until nc -z redis 6379; do
  echo_info "Waiting for Redis to be ready..."
  sleep 2
done
echo_success "Redis is ready."

if [ "$SERVICE_NAME" = "php" ]; then
    if [ ! -f "$ENV_FILE" ]; then
      echo_info ".env file: $ENV_FILE not exists, copy $SOURCE_DIR to $TARGET_DIR ..."
      cp -r "$SOURCE_DIR" "$TARGET_DIR"
      sed -i 's|LOG_FILE.*|LOG_FILE=php://stdout|g' "$ROOT_PATH/.env.example"
    else
      echo_success ".env file: $ENV_FILE already exists, skip copy install file ..."
    fi

    # composer install
    if [ ! -d "$VENDOR_DIR" ]; then
      echo_info "vendor dir: $VENDOR_DIR not exists, run composer install ..."
      composer install --working-dir=${ROOT_PATH}
    else
      echo_success "vendor dir: $VENDOR_DIR already exists, skip run composer install ..."
    fi

    # 最后启动 PHP-FPM
    exec php-fpm
elif [ "$SERVICE_NAME" = "queue" ]; then
    echo_info "Start Queue Worker...";
    while true; do
      if [ -f "$ENV_FILE" ] && [ -d "$VENDOR_DIR" ]; then
        echo_success "[Queue] Run queue:work at $(date '+%Y-%m-%d %H:%M:%S')";
        php artisan queue:horizon;
      else
        echo_info "[Queue] .env or vendor not exists，wait 5 seconds ...";
        sleep 5;
      fi
    done
elif [ "$SERVICE_NAME" = "scheduler" ]; then
    echo_info "Start Scheduler ...";
    while true; do
      if [ -f "$ENV_FILE" ] && [ -d "$VENDOR_DIR" ]; then
        echo_success "[Scheduler] Run schedule:run at $(date '+%Y-%m-%d %H:%M:%S')";
        php artisan schedule:run --verbose --no-interaction;
        sleep 60;
      else
        echo_info "[Scheduler] .env or vendor not exists，wait 5 seconds...";
        sleep 5;
      fi
    done
else
    echo_error "Unknown SERVICE_NAME: $SERVICE_NAME, exiting."
    exit 1
fi




