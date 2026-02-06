#!/bin/bash
set -e

# Update Apache port to match Render's $PORT
# Update Apache port to match Render's $PORT
if [ -n "$PORT" ]; then
    sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
fi

# Run Migrations (Force is needed for production env)
# Run Migrations (Force is needed for production env)
echo "⏳ Waiting for Database connection..."
# Wait for the database to be ready (retry for 30 seconds)
for i in {1..30}; do
    if php artisan db:monitor > /dev/null 2>&1; then
        echo "✅ Database connection established!"
        break
    fi
    echo "Waiting for database..."
    sleep 2
done

echo "🚀 Running database migrations..."
php artisan migrate --force

# Create Storage Link (Ignore error if already exists)
echo "🔗 Linking storage..."
php artisan storage:link || true

# Start Apache
echo "✅ Starting Server..."
docker-php-entrypoint apache2-foreground
