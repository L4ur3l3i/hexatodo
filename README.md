# Todo-list en architecture hexagonale

## Plan d'action étape par étape

### 1. **Définis tes entités dans le domaine (Core)**

- Commence par créer les **entités de base** : **Utilisateur**, **Tâche**, et **Catégorie**.
- Chaque entité doit inclure ses attributs principaux, par exemple :
  - **Utilisateur** : `id`, `nom`, `email`.
  - **Tâche** : `id`, `titre`, `description`, `statut`, `date_creation`, `date_echeance`, et éventuellement un lien vers l’utilisateur et la catégorie.
  - **Catégorie** : `id`, `nom`, `description`.

   Dans une structure de dossier, tu peux organiser les entités dans un répertoire `Domain` ou `Core`, et définir un sous-dossier pour chaque entité.

### 2. **Détermine les services métier**

- Identifie des règles ou des actions métier spécifiques qui ne se limitent pas à une seule entité. Par exemple :
  - **Gestion des Tâches** : création, mise à jour, suppression, modification du statut (par ex. "terminée", "en cours").
  - **Gestion des Utilisateurs** : ajout, mise à jour, suppression de comptes.
- Place ces services dans un dossier `Services` au sein du cœur de ton application.

### 3. **Crée les interfaces des ports**

- Définis des interfaces pour les **repositories** des entités (par exemple, `TaskRepository`, `UserRepository`, et `CategoryRepository`) dans le cœur de l’application.
- Ces interfaces décriront les méthodes nécessaires pour interagir avec chaque entité (ex. `findById`, `save`, `delete`).

### 4. **Implémente les adaptateurs dans l’infrastructure**

- Crée un répertoire `Infrastructure` pour tes adaptateurs. Dans ce dossier, ajoute des implémentations concrètes des ports (par exemple, une classe `DatabaseTaskRepository` pour interagir avec la base de données).
- En fonction de la persistance choisie (ex. base de données SQLite, MySQL), les adaptateurs peuvent inclure des connecteurs spécifiques pour chaque type de stockage.

### 5. **Crée les interfaces utilisateur (Application)**

- Si tu veux une API, ajoute des contrôleurs qui reçoivent les requêtes, les transforment en appels vers les services métier, et renvoient des réponses JSON.
- Si tu préfères une interface graphique (même très simple), ajoute un adaptateur d’interface utilisateur (comme une vue console ou un front-end basique).

## Résumé de la structure des dossiers

Voici une structure indicative pour l’organisation de ton projet :

```text
/src
 ├── /Core
 │    ├── /Domain
 │    │    ├── /Entities
 │    │    │    ├── User.php
 │    │    │    ├── Task.php
 │    │    │    └── Category.php
 │    │    ├── /Services
 │    │    │    ├── TaskService.php
 │    │    │    └── UserService.php
 │    │    └── /Ports
 │    │         ├── TaskRepository.php
 │    │         ├── UserRepository.php
 │    │         └── CategoryRepository.php
 │    └── /Application
 │         ├── /Controllers
 │         └── (Autres adaptateurs d'interface utilisateur)
 └── /Infrastructure
      ├── /Persistence
      │    ├── DatabaseTaskRepository.php
      │    ├── DatabaseUserRepository.php
      │    └── DatabaseCategoryRepository.php
      └── /(Autres adaptateurs techniques)
```

Commence par définir les entités et les interfaces pour les repositories dans le dossier Core. Ensuite, une fois tes entités et services en place, tu pourras passer aux adaptateurs.
