# Projet Fullstack - Backend Symfony & Frontend Next.js

## Introduction

Ce projet est une application fullstack comprenant un backend développé avec Symfony et un frontend utilisant Next.js. Cette application permet la gestion des utilisateurs avec des fonctionnalités d'authentification.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- PHP >= 8.1
- Composer
- Node.js >= 14
- npm
- MongoDB

## Structure du Projet

### Détails des Dossiers

#### Backend

- **config/** : Contient les fichiers de configuration pour les services, les routes et les paquets Symfony.
- **public/** : Ce dossier contient le fichier `index.php`, qui est le point d'entrée de l'application Symfony. Les fichiers statiques comme les images ou les fichiers CSS peuvent également être placés ici.
- **src/** : Dossier principal où le code de l'application est écrit.
  - **Controller/** : Contient les contrôleurs qui gèrent la logique des requêtes et des réponses.
  - **Document/** : Contient les documents (modèles) qui définissent la structure des données dans MongoDB.
  - **Repository/** : Contient les classes de répertoire qui interagissent avec la base de données.
  - **Security/** : Contient la logique de sécurité, y compris les configurations d'authentification et de gestion des utilisateurs.
- **tests/** : Contient les tests unitaires et fonctionnels pour l'application.
- **var/** : Contient les fichiers temporaires et de cache générés par Symfony.
- **composer.json** : Fichier de configuration de Composer qui liste les dépendances du projet.

#### Frontend

- **pages/** : Contient les différentes pages de l'application Next.js.
  - **api/** : Les routes API créées avec Next.js.
  - **_app.js** : Permet de personnaliser le composant App qui englobe toutes les pages.
  - **index.js** : La page d'accueil de l'application.
- **public/** : Contient des fichiers statiques comme des images, qui peuvent être référencés directement dans l'application.
- **components/** : Dossier pour les composants réutilisables à travers l'application.
- **styles/** : Contient les fichiers CSS globaux ou spécifiques.
- **utils/** : Contient les fonctions utilitaires pour faciliter les opérations dans l'application.
- **package.json** : Fichier de configuration de npm qui liste les dépendances et les scripts de l'application.
