FROM php:alpine

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN mkdir /var/www/localhost && mkdir /var/www/localhost/metrics && mkdir /var/www/localhost/health && mkdir /var/www/localhost/metrics/src

RUN echo "<?php echo('ok');?>" >> /var/www/localhost/health/index.php

COPY index.php /var/www/localhost/metrics
COPY src /var/www/localhost/metrics/src

WORKDIR /var/www/localhost/

# Filter out access logs while keeping exceptions
CMD ["sh", "-c", "php -S 0.0.0.0:8081 2>&1 | grep -vE 'Accepted|Closing|\\[[0-9]{3}\\]: [A-Z]+ /[^ ]*$'"]

#USER manticore:manticore