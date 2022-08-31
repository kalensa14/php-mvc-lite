#!/bin/sh

docker run --rm -d --name buy-a-cow -v /"$PWD"://app -w //app -p 8000:8000 php:8.1-cli-alpine php -S 0.0.0.0:8000 -t ./public