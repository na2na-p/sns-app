FROM nginx:1.23.3-alpine-slim

COPY settings/default.conf /etc/nginx/conf.d/
WORKDIR /usr/share/nginx/public/
RUN touch /usr/share/nginx/public/index.php
