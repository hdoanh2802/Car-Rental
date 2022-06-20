# FROM ubuntu as stage1
# COPY . /var/html
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install

# FROM ubuntu as stage2
# COPY --from=stage1 /app/vendor ./vendor/
# COPY ./car_rental /var/html
# CMD tail -f /dev/null
FROM php:7.4-fpm

CMD php /app/public/index.php