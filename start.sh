#!/bin/bash

PORT=${PORT:-8080}

# Update Apache to listen on the correct port
sed -i "s/^Listen .*/Listen $PORT/" /etc/apache2/ports.conf

# Disable all MPM modules
a2dismod mpm_event mpm_worker mpm_prefork

# Enable exactly one MPM module (choose one)
a2enmod mpm_prefork

# Start Apache in foreground
apache2-foreground
