#!/bin/bash

echo "Starting Laravel migration to PostgreSQL..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "Error: Docker is not running. Please start Docker Desktop first."
    exit 1
fi

# Start PostgreSQL
echo "Starting PostgreSQL..."
docker compose up -d postgres

# Wait for PostgreSQL
echo "Waiting for PostgreSQL to be ready..."
sleep 15

# Build and start Laravel
echo "Building and starting Laravel..."
docker compose build laravel
docker compose up -d laravel

# Wait for Laravel
sleep 10

# Generate key and run migrations
echo "Running migrations..."
docker compose exec laravel php artisan key:generate
docker compose exec laravel php artisan migrate --force

echo "Migration completed!"
echo "Application available at: http://localhost:8000"