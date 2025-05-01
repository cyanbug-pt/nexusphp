#!/bin/sh
set -e

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


# 设定证书目录
CERT_DIR="/certs"
FULLCHAIN="fullchain.pem"
PRIVATE_KEY="private.key"
USE_HTTPS="1"

if [ -z "$NP_DOMAIN" ]; then
  echo_error "❌ 错误：必须设置 NP_DOMAIN 环境变量！"
  exit 1
fi

echo_info "NP_DOMAIN: $NP_DOMAIN"

# 检查证书是否存在
if [ -f "$CERT_DIR/$FULLCHAIN" ] && [ -f "$CERT_DIR/$PRIVATE_KEY" ]; then
    echo_info "ssl certs already exists at: ${CERT_DIR}"
    chmod 644 "$CERT_DIR/$FULLCHAIN"
    chmod 644 "$CERT_DIR/$PRIVATE_KEY"
    ls -l "$CERT_DIR"
else
    echo_info "no ssl certs at: ${CERT_DIR}"
    USE_HTTPS="0"
fi

echo_info "USE_HTTPS: $USE_HTTPS"

# 组合子域名变量
dot_count_tmp="${NP_DOMAIN//[^.]/}"
dot_count="${#dot_count_tmp}"
PHPMYADMIN="phpmyadmin"
if [ "$dot_count" -eq 1 ]; then
    PHPMYADMIN="${PHPMYADMIN}."
else
    PHPMYADMIN="${PHPMYADMIN}-"
fi
export PHPMYADMIN_SERVER_NAME="${PHPMYADMIN}${NP_DOMAIN}"

echo_info "PHPMYADMIN_SERVER_NAME: ${PHPMYADMIN_SERVER_NAME}"

# 生成配置
APP_CONF="/etc/nginx/conf.d/app.conf"
PMA_CONF="/etc/nginx/conf.d/phpmyadmin.conf"
envsubst '$NP_DOMAIN' < /etc/nginx/conf.d/sites/app.conf.template > "$APP_CONF"
envsubst '$PHPMYADMIN_SERVER_NAME' < /etc/nginx/conf.d/sites/phpmyadmin.conf.template > "$PMA_CONF"

# if no certs, remove ssl configuration
if [ "$USE_HTTPS" = "0" ]; then
    echo_info "remove https related configuration ..."
    sed -i '/ssl_certificate/d' "$APP_CONF"
    sed -i '/http2/d' "$APP_CONF"
    sed -i 's/listen.*/listen 80;/g' "$APP_CONF"

    sed -i '/ssl_certificate/d' "$PMA_CONF"
    sed -i '/http2/d' "$PMA_CONF"
    sed -i 's/listen.*/listen 80;/g' "$PMA_CONF"
fi

openresty -T

exec openresty -g 'daemon off;'
