ARG DUMPER_VERSION=1.13 \
    YSOSERIAL_VERSION=0.0.6

FROM eclipse-temurin:17-jdk

LABEL maintainer="support@go-forward.net" \
    vendor="Go Forward"

ARG DUMPER_VERSION \
    YSOSERIAL_VERSION

RUN curl -L -o /usr/local/bin/SerializationDumper.jar "https://github.com/NickstaDB/SerializationDumper/releases/download/${DUMPER_VERSION}/SerializationDumper-v${DUMPER_VERSION}.jar" && \
    curl -L -o /usr/local/bin/ysoserial.jar "https://github.com/frohoff/ysoserial/releases/download/v${YSOSERIAL_VERSION}/ysoserial-all.jar"

WORKDIR /srv/demo/net/gofwd/
COPY Serialize.java .
COPY Deserialize.java .
COPY MyObject.java /srv/demo/net/gofwd/
COPY serialize.sh /usr/local/bin/
COPY deserialize.sh /usr/local/bin/
COPY SerializationDumper.sh /usr/local/bin/
COPY ysoserial.sh /usr/local/bin/

RUN javac MyObject.java Serialize.java Deserialize.java

RUN chmod ugo+x /usr/local/bin/serialize.sh && \
    chmod ugo+x /usr/local/bin/deserialize.sh && \
    chmod ugo+x /usr/local/bin/SerializationDumper.sh && \
    chmod ugo+x /usr/local/bin/ysoserial.sh && \
    ln -s /usr/local/bin/serialize.sh /usr/local/bin/serialize && \
    ln -s /usr/local/bin/deserialize.sh /usr/local/bin/deserialize && \
    ln -s /usr/local/bin/SerializationDumper.sh /usr/local/bin/SerializationDumper && \
    ln -s /usr/local/bin/ysoserial.sh /usr/local/bin/ysoserial

WORKDIR /workdir
