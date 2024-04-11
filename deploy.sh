#!/bin/bash
BUILD_TAG=6.2.12.0
echo $BUILD_TAG
docker build --no-cache -t manticoresearch/prometheus-exporter:$BUILD_TAG .
docker push manticoresearch/prometheus-exporter:$BUILD_TAG
