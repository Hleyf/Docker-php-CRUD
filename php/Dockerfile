FROM php:8.3.3-apache

# Install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# copy the source code to the container
COPY . /var/www/html/

# Update the package lists for upgrades and new package installations, then install the necessary packages
RUN apt-get update && apt-get install -y

# Clean cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

