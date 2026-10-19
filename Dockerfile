FROM ubuntu:26.04
RUN apt update && apt install apache2 php libapache2-mod-php -y
RUN apt install php-mysql -y