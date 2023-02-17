# Use a base image to build (and download) the tools on

FROM php:cli-alpine

LABEL maintainer="support@go-forward.net"
LABEL vendor="Go Forward"

WORKDIR /usr/local/bin/

COPY serialize.php .
COPY serialize_function.php /usr/local/lib/php/
COPY deserialize.php .
COPY deserializeobject.php /usr/local/lib/php/
COPY serialize_chain.php .
COPY serialize_chain_self.php .
COPY deserialize_chain.php .
RUN chmod ugo+x /usr/local/bin/serialize.php && \
    chmod ugo+x /usr/local/bin/serialize_chain.php && \
    chmod ugo+x /usr/local/bin/serialize_chain_self.php && \
    chmod ugo+x /usr/local/bin/deserialize.php && \
    chmod ugo+x /usr/local/bin/deserialize_chain.php && \
    ln -s /usr/local/bin/serialize.php /usr/local/bin/serialize && \
    ln -s /usr/local/bin/serialize_chain.php /usr/local/bin/serialize_chain && \
    ln -s /usr/local/bin/serialize_chain_self.php /usr/local/bin/serialize_chain_self && \
    ln -s /usr/local/bin/deserialize.php /usr/local/bin/deserialize && \
    ln -s /usr/local/bin/deserialize_chain.php /usr/local/bin/deserialize_chain

WORKDIR /workdir
