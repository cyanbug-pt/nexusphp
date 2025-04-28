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

if [ -z "$DOMAIN" ]; then
  echo_error "❌ 错误：必须设置 DOMAIN 环境变量！"
  exit 1
fi

echo_info "DOMAIN: $DOMAIN"

# 检查证书是否存在
if [ -f "$CERT_DIR/$FULLCHAIN" ] && [ -f "$CERT_DIR/$PRIVATE_KEY" ]; then
    echo_info "ssl certs already exists at: ${CERT_DIR}"
else
    echo_info "no ssl certs at: ${CERT_DIR}"
    USE_HTTPS="0"
fi

echo_info "USE_HTTPS: $USE_HTTPS"

# 组合子域名变量
export PHPMYADMIN_SERVER_NAME="phpmyadmin.${DOMAIN}"

# 生成配置
APP_CONF="/etc/nginx/conf.d/app.conf"
PMA_CONF="/etc/nginx/conf.d/phpmyadmin.conf"
envsubst '$DOMAIN' < /etc/nginx/conf.d/sites/app.conf.template > "$APP_CONF"
envsubst '$PHPMYADMIN_SERVER_NAME' < /etc/nginx/conf.d/sites/phpmyadmin.conf.template > "$PMA_CONF"

# if no certs, remove ssl configuration
if [ "$USE_HTTPS" = "0" ]; then
    echo_info "remove https related configuration ..."
    sed -i '/ssl_certificate/d' "$APP_CONF"
    sed -i 's/listen.*/listen 80;/g' "$APP_CONF"

    sed -i '/ssl_certificate/d' "$PMA_CONF"
    sed -i 's/listen.*/listen 80;/g' "$PMA_CONF"
fi

openresty -T

exec openresty -g 'daemon off;'
