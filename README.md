# Task Manager – Application de gestion de tâches

## Présentation

**Task Manager** est une application web de gestion de tâches développée avec **PHP et Symfony**.

Ce projet personnel a pour objectif de mettre en pratique mes connaissances en développement web, d'approfondir ma maîtrise de Symfony et de consolider mes compétences en programmation orientée objet, gestion des données et conception d'applications.

L'application permet à chaque utilisateur de gérer ses propres tâches, de suivre leur avancement et d'organiser son travail selon différents critères.

## Fonctionnalités

### Gestion des utilisateurs
- Authentification des utilisateurs.
- Gestion individuelle des tâches.
- Restriction d'accès aux tâches selon leur propriétaire.

### Gestion des tâches
- Création et gestion des tâches.
- Association de chaque tâche à son utilisateur.
- Gestion des dates de création et des dates limites.
- Possibilité de terminer ou de rouvrir une tâche.

### Recherche et organisation
- Recherche dynamique par mot-clé.
- Tri par date de création.
- Tri par date limite.
- Gestion des différents modes de tri à l'aide d'une Enum PHP.

### Interface utilisateur
- Interface réalisée avec Twig et Bootstrap.
- Actualisation dynamique de la liste des tâches grâce à Symfony UX LiveComponent.
- Affichage des messages de confirmation et d'erreur.

## Technologies utilisées

| Technologie | Utilisation |
|---|---|
| PHP | Langage de programmation |
| Symfony | Framework backend |
| Doctrine ORM | Gestion de la persistance des données |
| MySQL | Base de données |
| Twig | Moteur de templates |
| Symfony UX LiveComponent | Interactions dynamiques |
| Bootstrap | Mise en forme de l'interface |
| Git / GitHub | Gestion du code source |

## Architecture et conception

Une attention particulière est portée à la séparation des responsabilités et à la maintenabilité du code.

Quelques éléments de conception mis en place :

- **Entités Doctrine** : représentation des utilisateurs et des tâches.
- **Repositories** : centralisation des requêtes liées aux tâches.
- **Enums PHP** : sécurisation et encadrement des valeurs de tri.
- **TaskSearchCriteria** : centralisation des critères de recherche.
- **TaskList** : gestion de l'affichage dynamique et des interactions avec les tâches.
- **Sécurité** : vérification de l'utilisateur connecté et contrôle de la propriété des tâches.

## Installation du projet

### Prérequis

- PHP
- Composer.
- MySQL.
- Symfony CLI.

### 1. Récupérer le projet

```bash
git clone https://github.com/Fercak-Florian/task-manager.git
cd TON-DEPOT
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer la base de données

Configurer la variable `DATABASE_URL` dans le fichier `.env.local` en fonction de ton environnement MySQL.

Exemple :

```dotenv
DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/task_manager?serverVersion=8.0"
```

### 4. Créer la base de données et exécuter les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Lancer l'application

Avec Symfony CLI :

```bash
symfony server:start
```

Ou avec le serveur PHP intégré :

```bash
php -S localhost:8000 -t public
```

L'application est alors accessible à l'adresse :

`http://localhost:8000`

## Évolutions envisagées

Ce projet est développé progressivement dans une démarche d'apprentissage et d'amélioration continue.

Les prochaines fonctionnalités envisagées sont :

- Gestion des priorités des tâches.
- Détection automatique des tâches en retard.
- Filtres combinés (priorité, statut, date limite).
- Pagination des résultats.
- Tableau de bord avec statistiques.
- Mise en place de tests automatisés avec PHPUnit.

## Objectifs d'apprentissage

À travers ce projet, je souhaite approfondir plusieurs compétences :

- Développer une application avec Symfony en respectant les bonnes pratiques.
- Améliorer la conception orientée objet en PHP.
- Maîtriser les relations entre entités avec Doctrine.
- Concevoir des requêtes dynamiques avec QueryBuilder.
- Mettre en place des composants réactifs avec Symfony UX.
- Renforcer la sécurité des applications web.
- Développer une approche structurée des tests et de la qualité logicielle.

## À propos

Développeur en progression, je m'intéresse particulièrement au développement backend et full-stack.

Après un parcours dans les domaines de l'informatique et des télécommunications, je développe mes compétences en PHP, Symfony, Java et Angular à travers des projets concrets.

Ce projet illustre ma démarche : apprendre, expérimenter, comprendre les choix techniques et améliorer progressivement la qualité du code.
