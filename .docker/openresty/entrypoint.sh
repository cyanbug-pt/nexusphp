#!/bin/sh
set -e

if [ -z "$DOMAIN" ]; then
  echo "❌ 错误：必须设置 DOMAIN 环境变量！"
  exit 1
fi

echo "当前域名是: $DOMAIN"

# 设定证书目录
CLOUDFLARE_CERT_DIR="/certs/cloudflare"
FINAL_CERT_DIR="/certs/live"
FULLCHAIN="fullchain.pem"
PRIVATE_KEY="private.key"

# 检查 Cloudflare 证书是否存在
if [ -f "$FINAL_CERT_DIR/$FULLCHAIN" ] && [ -f "$FINAL_CERT_DIR/$PRIVATE_KEY" ]; then
    echo "ssl certs already exists at: ${FINAL_CERT_DIR}"
else
    if [ -f "$CLOUDFLARE_CERT_DIR/$FULLCHAIN" ] && [ -f "$CLOUDFLARE_CERT_DIR/$PRIVATE_KEY" ]; then
        echo "⚡️ Cloudflare certs exists at: $CLOUDFLARE_CERT_DIR, copy to: $FINAL_CERT_DIR ..."
        mkdir -p "$FINAL_CERT_DIR"
        cp "$CLOUDFLARE_CERT_DIR/$FULLCHAIN" "$FINAL_CERT_DIR/$FULLCHAIN"
        cp "$CLOUDFLARE_CERT_DIR/$PRIVATE_KEY" "$FINAL_CERT_DIR/$PRIVATE_KEY"
    else
        echo "🔍 Cloudflare certs not exists at: $CLOUDFLARE_CERT_DIR，use acme.sh to apply ..."

        # 安装 acme.sh（如果还没装）
        if [ ! -d "/root/.acme.sh" ]; then
          curl https://get.acme.sh | sh
          source ~/.bashrc
        fi

        # 申请证书
        ~/.acme.sh/acme.sh --issue --standalone -d "$DOMAIN" --keylength ec-256

        # 安装证书到目标目录
        ~/.acme.sh/acme.sh --install-cert -d "$DOMAIN" --ecc \
          --key-file "$FINAL_CERT_DIR/$PRIVATE_KEY" \
          --fullchain-file "$FINAL_CERT_DIR/$FULLCHAIN"
    fi
fi

echo "✅ ssl certs done."

# 组合子域名变量
export PHPMYADMIN_SERVER_NAME="phpmyadmin.${DOMAIN}"

# 清空旧配置
rm -rf /etc/nginx/conf.d/*.conf

# 生成配置
envsubst '$DOMAIN' < /etc/nginx/conf.d/sites/app.conf.template > /etc/nginx/conf.d/app.conf
envsubst '$PHPMYADMIN_SERVER_NAME' < /etc/nginx/conf.d/sites/phpmyadmin.conf.template > /etc/nginx/conf.d/phpmyadmin.conf

exec openresty -g 'daemon off;'
