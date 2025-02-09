FROM nginx 


RUN apt-get update -y \
    &&  apt-get install -y curl \
    && apt-get install vim -y 


COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf

