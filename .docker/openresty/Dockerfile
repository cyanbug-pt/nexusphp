FROM openresty/openresty:alpine

# 安装基础依赖
RUN apk add --no-cache gettext bash curl openssl socat

# 拷贝 entrypoint
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

CMD ["/bin/sh", "/usr/local/bin/entrypoint.sh"]
