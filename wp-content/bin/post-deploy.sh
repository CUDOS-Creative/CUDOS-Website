#!/bin/sh

echo "Starting post deploy script..."
echo "Switch directory to wp-content/cudos"
cd wp-content/cudos
echo "Installing Composer dependencies..."
composer install --no-dev --no-progress