FROM cravler/php5-cli
MAINTAINER Sergei Vizel <http://github.com/cravler>

# All our dependencies, in alphabetical order (to ease maintenance)
RUN apt-get update && apt-get install -y --no-install-recommends \
        g++ \
        php-pear \
        php5-dev \
        pkg-config \
        libcurl4-openssl-dev \
        libevent-dev \
        make && \

# Install pecl event extension
    pecl install event && \
    sh -c "echo 'extension=event.so' > /etc/php5/cli/conf.d/20-event.ini" && \

# Remove cache
    apt-get clean && rm -rf /var/lib/apt/lists/*