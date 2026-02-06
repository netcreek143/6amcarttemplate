#!/bin/bash
set -e

# Update Apache port to match Render's $PORT
# Update Apache port to match Render's $PORT
if [ -n "$PORT" ]; then
    sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
fi

# Run Migrations (Force is needed for production env)
# Run Migrations (Force is needed for production env)
# Run Migrations (Force is needed for production env)
echo "🔍 DEBUG: DB_HOST='$DB_HOST'"
echo "🔍 DEBUG: DB_HOST='$DB_HOST'"
echo "🔍 DEBUG: DB_PORT='$DB_PORT'"
echo "🔍 DEBUG: DB_DATABASE='$DB_DATABASE'"

# Network Check
echo "🔍 DEBUG: Checking DNS resolution for $DB_HOST..."
getent hosts "$DB_HOST" || echo "❌ DNS Resolution FAILED for '$DB_HOST'"

echo "⏳ Waiting for Database connection to $DB_HOST:$DB_PORT..."
# Wait for the database to be ready (retry for 30 seconds)
for i in {1..30}; do
    if php artisan db:monitor; then
        echo "✅ Database connection established!"
        break
    fi
    echo "⚠️ Connection failed. Retrying in 2s..."
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
