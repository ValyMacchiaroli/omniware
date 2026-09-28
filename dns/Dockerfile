FROM ubuntu:26.04
RUN apt update && \
    apt upgrade -y && \
    apt install -y \
        bind9 bind9utils dnsutils
COPY ./entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]