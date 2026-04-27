#!/bin/bash

echo "🚀 Début du déploiement M-Motors..."

# 1. Mettre le site en mode maintenance pour la sécurité
php artisan down

# 2. Récupérer les dernières modifications (si tu utilises Git)
# git pull origin main

# 3. Installer les dépendances PHP
composer install --no-interaction --prefer-dist --optimize-autoloader

# 4. Lancer les migrations de base de données (Sécurisé)
php artisan migrate --force

# 5. Vider et reconstruire le cache pour les performances (C3.2)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Relancer le site
php artisan up

echo "✅ Déploiement terminé avec succès !"