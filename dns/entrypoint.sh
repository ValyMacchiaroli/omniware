#!/bin/sh
set -e
chown -R bind:bind /etc/bind

exec /usr/sbin/named -g -u bind