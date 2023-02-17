# Generic Makefile for Docker images

# Copyright (C) 2018-2023 Peter Mosmans [Go Forward]
# SPDX-License-Identifier: GPL-3.0-or-later

DOCKER_IMG := gofwd/deserialization
DOCKER_BUILD := DOCKER_BUILDKIT=1 docker build

# Recipes that aren't filenames: This ensures that they always will be executed
.PHONY: image test javaimage phpimage pythonimage

image:
	@[ "$(TYPE)" ] || echo "This Makefile target cannot be run standalone"
	@[ "$(TYPE)" ] && \
	echo "Building $(DOCKER_IMG):$(TYPE)..." && \
	cd $(TYPE) && \
	$(DOCKER_BUILD) . -f Dockerfile.$(TYPE) -t $(DOCKER_IMG):$(TYPE)

# Set specific type
javatest javaimage: TYPE = java
pythontest pythonimage: TYPE = python
phptest phpimage: TYPE = php

# Build image
javaimage phpimage pythonimage: image

# Test image
javatest phptest pythontest: test

test:
	@[ "$(TYPE)" ] || echo "This Makefile target cannot be run standalone"
	@[ "$(TYPE)" ] && \
	echo "Testing $(DOCKER_IMG):$(TYPE)" && \
	mkdir --parent test/$(TYPE) && \
	cd test/$(TYPE) && \
	echo "Serializing object using STDOUT..." && \
	docker run --rm $(DOCKER_IMG):$(TYPE) serialize > serialized.stream && \
	echo "Serializing object using file..." && \
	docker run --rm  -v $$PWD:/workdir:rw $(DOCKER_IMG):$(TYPE) serialize serialized.file && \
	echo "Comparing objects..." && \
	diff --brief serialized.stream serialized.file && \
	echo "Deserializing object using STDIN..." && \
	cat serialized.stream | docker run --rm -i $(DOCKER_IMG):$(TYPE) deserialize && \
	echo "Deserializing object using file..." && \
	docker run --rm -i -v $$PWD:/workdir:ro $(DOCKER_IMG):$(TYPE) deserialize serialized.file && \
	rm -rf test/$(TYPE) && \
	echo "All tests for $(DOCKER_IMG):$(TYPE) successful"

all:
	make javaimage javatest
	make phpimage phptest
	make pythonimage pythontest
