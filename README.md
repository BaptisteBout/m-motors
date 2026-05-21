# M-Motors - Plateforme de Gestion de Véhicules d'Occasion

![Laravel](https://img.shields.io/badge/Framework-Laravel-red)
![MySQL](https://img.shields.io/badge/Database-MySQL-blue)
![Build](https://img.shields.io/badge/Status-Stable-brightgreen)

## 📌 Présentation du Projet
M-Motors est une application robuste développée avec Laravel pour la gestion d'un parc automobile national. Ce projet met l'accent sur la qualité du code, la sécurité des données et la mise en place d'un environnement de monitoring professionnel.

---

## 🚀 Guide d'Installation (Le Manuel "IKEA")

Suivez scrupuleusement ces étapes pour déployer l'application sur votre environnement local.

### 1. Clonage du projet
```bash
git clone [https://github.com/BaptisteBout/m-motors.git](https://github.com/BaptisteBout/m-motors.git)
cd m-motors
```

### 2. Installation des dépendances
```bash
composer install
npm install && npm run build
```

### 3. Configuration de l'environnement
Copiez le fichier d'exemple pour créer votre fichier .env :

```bash
cp .env.example .env
```

> **⚠️ SÉCURITÉ IMPORTANTE :** Conformément aux recommandations, ce projet utilise **MySQL** (et non SQLite) pour garantir la sécurité des données.

Veuillez configurer vos accès de base de données dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_DATABASE=m_motors
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### 4. Initialisation de l'application
Générez la clé de sécurité et lancez les migrations avec les données de test (seeds) :

```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Lancement
```bash
php artisan serve
```
L'application est maintenant disponible sur http://localhost:8000.

## 🛠 Bonnes Pratiques & Architecture

### Gestion du Git (GitFlow)
Le projet respecte une stratégie de branches rigoureuse pour éviter tout bug en production :
- **Main** : Code stable et déployé en production.
- **Develop** : Branche principale d'intégration des fonctionnalités.
- **Feature/** : Branches isolées pour le développement de chaque User Story.
- **Hotfix/** : Corrections urgentes basées sur les alertes de monitoring.

### Architecture Logicielle
- **Service Layer** : La logique métier est isolée dans des classes de Service pour garder des contrôleurs légers et maintenables.
- **Sécurité des secrets** : Aucun mot de passe ou clé API n'est stocké en dur dans le code ; tout passe par le fichier `.env` (exclu du versioning).

---

## 🧪 Tests & Qualité du Code
Le projet intègre une suite de tests automatisés validant le **"Métier Client"** :

- **Tests Fonctionnels (End-to-End)** : Vérification des parcours critiques (création de véhicules, modification, flux de réservation).
- **Tests de Sécurité** : Validation de l'authentification et de la protection des routes.
- **Analyse Statique** : Utilisation de **PHPStan** pour garantir un code sans dette technique et éviter les régressions.

### Lancer la suite de tests
```bash
php artisan test
```

## 📊 Monitoring & Maintenance (RTO/RPO)
Pour assurer une haute disponibilité et une correction rapide selon les objectifs RTO/RPO :
- **Sentry/Flare** : Capture automatique des erreurs 500 et remontée des stack traces.
- **Alerting Slack** : Notifications immédiates à l'équipe technique en cas d'exception.
- **Logs Hiérarchisés** : Utilisation du driver stack (Emergency, Error, Info) envoyé vers Papertrail pour l'audit des stocks.

---

## 🔑 Accès de Test

| Rôle | Email | Mot de passe |
| :--- | :--- | :--- |
| **Administrateur** | admin@m-motors.com | password |
| **Utilisateur** | user@m-motors.com | password |

> **📍 URL de Production :** [http://141.227.133.90/m-motors/]
