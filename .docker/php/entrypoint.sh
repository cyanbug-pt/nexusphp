#!/bin/sh

ROOT_PATH="/var/www/html"

SOURCE_DIR="${ROOT_PATH}/nexus/Install/install"
TARGET_DIR="${ROOT_PATH}/public"
ENV_FILE="${ROOT_PATH}/.env"
VENDOR_DIR="${ROOT_PATH}/vendor"
#COMPOSER_FILE="${ROOT_PATH}/composer.json"

# 检查目标文件是否存在
if [ ! -f "$ENV_FILE" ]; then
  echo "🔧 .env file: $ENV_FILE not exists, copy $SOURCE_DIR to $TARGET_DIR ..."
  cp -r "$SOURCE_DIR" "$TARGET_DIR"
else
  echo "✅ .env file: $ENV_FILE already exists, skip copy install file ..."
fi

# composer install
if [ ! -d "$VENDOR_DIR" ]; then
  echo "🔧 vendor dir: $VENDOR_DIR not exists, run composer install ..."
  composer install --working-dir=${ROOT_PATH}
else
  echo "✅ vendor dir: $VENDOR_DIR already exists, skip run composer install ..."
fi

# 最后启动 PHP-FPM
exec php-fpm
