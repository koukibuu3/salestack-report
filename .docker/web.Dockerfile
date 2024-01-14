FROM php:8.2-apache

# DocumentRootの修正
ENV DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# mod_rewriteを有効化
RUN a2enmod rewrite

WORKDIR /var/www/html/
