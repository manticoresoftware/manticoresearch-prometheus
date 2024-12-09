#!/bin/bash
BUILD_TAG=6.3.8.0
DOCKER_REPO=manticoresearch/prometheus-exporter
echo $BUILD_TAG
echo $DOCKER_REPO

docker buildx create --use
docker buildx build \
    --platform linux/amd64,linux/arm64 \
    --output type=registry \
    --push \
    --progress auto \
    --no-cache -t $DOCKER_REPO:$BUILD_TAG .
