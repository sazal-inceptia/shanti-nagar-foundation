#!/usr/bin/env bash

# ==============================================================================
# Deployment Script for Rotary Club of Shantinagar Dhaka
# Target Server: AWS Lightsail (13.203.173.126)
# Target Domain: https://rotary.appinceptia.com
# ==============================================================================

set -e

# Configuration
REMOTE_USER="ubuntu"
REMOTE_HOST="13.203.173.126"
REMOTE_PORT="22"
KEY_PATH="${KEY_PATH:-/Users/zesan/Desktop/lightsail/LightsailDefaultKey-ap-south-1.pem}"
REMOTE_DIR="/var/www/rotary"

echo "==> Step 1: Checking SSH Key..."
if [ ! -f "$KEY_PATH" ]; then
    echo "ERROR: SSH Key not found at $KEY_PATH"
    echo "Please set KEY_PATH environment variable or put the key in the expected path."
    exit 1
fi
chmod 400 "$KEY_PATH"

echo "==> Step 2: Building frontend assets locally..."
npm run build

echo "==> Step 3: Synchronizing files to remote server via rsync..."
rsync -avz --delete \
    -e "ssh -i $KEY_PATH -p $REMOTE_PORT -o StrictHostKeyChecking=no" \
    --exclude='.git/' \
    --exclude='.github/' \
    --exclude='.agents/' \
    --exclude='node_modules/' \
    --exclude='tests/' \
    --exclude='.env' \
    --exclude='.env.*' \
    --exclude='deploy.sh' \
    --exclude='storage/logs/*' \
    --exclude='storage/framework/cache/data/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    --exclude='/vendor/' \
    ./ "$REMOTE_USER@$REMOTE_HOST:$REMOTE_DIR/"

echo "==> Step 4: Running post-deployment tasks on remote server..."
ssh -i "$KEY_PATH" -p "$REMOTE_PORT" -o StrictHostKeyChecking=no "$REMOTE_USER@$REMOTE_HOST" bash << 'EOF'
set -e
cd /var/www/rotary

echo "--> Installing composer dependencies (production)..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "--> Ensuring storage symbolic link..."
php artisan storage:link --force

echo "--> Running database migrations..."
php artisan migrate --force

echo "--> Clearing and caching configurations, routes, and views..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "--> Setting proper permissions..."
sudo chown -R ubuntu:www-data /var/www/rotary
sudo chmod -R 775 /var/www/rotary/storage /var/www/rotary/bootstrap/cache

echo "--> Reloading PHP-FPM..."
sudo systemctl reload php8.4-fpm

echo "--> Deployment finished successfully on server!"
EOF

echo "==> Deployment Complete! Visit: https://rotary.appinceptia.com"
