FROM php:8.2-apache

# Working directory set karein
WORKDIR /var/www/html

# Saare files container me copy karein
COPY . /var/www/html/

# Apache ko enable karein aur port expose karein
EXPOSE 80
