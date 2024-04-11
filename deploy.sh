#!/bin/bash
BUILD_TAG=6.2.13.1
echo $BUILD_TAG
docker build --platform="linux/amd64" --no-cache -t manticoresearch/prometheus-exporter:$BUILD_TAG .
docker push manticoresearch/prometheus-exporter:$BUILD_TAG
