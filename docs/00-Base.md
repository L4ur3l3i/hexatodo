# Todo-list en architecture hexagonale

## Un peu de vocabulaire

En architecture hexagonale et DDD (Domain-Driven Design), les termes techniques sont importants pour bien structurer et comprendre l’application. Voici les principaux termes à garder en tête pour ton projet :

### **Entités**

Ce sont des objets métier principaux avec une identité unique, comme tes Utilisateurs, Tâches et Catégories. Une entité est reconnaissable à l’unicité de son identifiant dans le système.

### **Valeurs**

Ce sont des objets métier sans identifiant unique et qui ne sont pas considérés comme indépendants (par exemple, une date de création ou un statut de tâche). Les valeurs peuvent être utiles pour des sous-éléments de tâches, comme un statut ou une priorité.

### **Aggrégats**

En architecture hexagonale, un agrégat regroupe plusieurs entités ou valeurs pour en former une structure cohérente. Par exemple, l’agrégat principal pourrait être un Utilisateur, qui engloberait une collection de Tâches. Dans les projets plus simples, il n'est pas indispensable de formaliser des agrégats, mais c'est un concept utile dans des applications plus complexes.

### **Repository**

C’est un adaptateur pour le stockage des entités (base de données, fichier, etc.). Il gère l’accès aux entités persistantes. Par exemple, un TaskRepository centralisera les opérations CRUD sur les Tâches.

### **Services**

Ils contiennent des règles ou actions métier qui ne relèvent pas d’une seule entité. Par exemple, un Service de gestion des tâches peut contenir des actions comme assigner une tâche à un utilisateur ou filtrer les tâches par catégorie.

### **Ports**

Ce sont des interfaces qui définissent comment le monde extérieur (par exemple, un client HTTP ou un service de notification) interagit avec le cœur de ton application. Ils sont indépendants de l’implémentation.

### **Adaptateurs**

Ce sont les implémentations concrètes des ports, comme un adaptateur de base de données, d’API, ou d’interface utilisateur.

---
En résumant avec une structure pour ton projet todo-list en hexagone :

- **Core (Cœur)** : contient les entités, les services métier, et les interfaces pour les ports (ex. TaskRepository).
- **Infrastructure** : contient les adaptateurs pour les interactions externes (ex. implémentation de TaskRepository avec une base de données).
- **Application** : la couche d’interface (ex. contrôleurs ou adaptateurs front-end).

## Plan d'action étape par étape

### 1. **Définis tes entités dans le domaine (Core)**

- Commence par créer les **entités de base** : **Utilisateur**, **Tâche**, et **Catégorie**.
- Chaque entité doit inclure ses attributs principaux, par exemple :
  - **Utilisateur** : `id`, `nom`, `email`.
  - **Tâche** : `id`, `titre`, `description`, `statut`, `date_creation`, `date_echeance`, et éventuellement un lien vers l’utilisateur et la catégorie.
  - **Catégorie** : `id`, `nom`, `description`.

   Dans une structure de dossier, tu peux organiser les entités dans un répertoire `Domain` ou `Core`, et définir un sous-dossier pour chaque entité.

### 2. **Crée les interfaces des ports**

- Définis des interfaces pour les **repositories** des entités (par exemple, `TaskRepository`, `UserRepository`, et `CategoryRepository`) dans le cœur de l’application.
- Ces interfaces décriront les méthodes nécessaires pour interagir avec chaque entité (ex. `findById`, `save`, `delete`).

### 3. **Détermine les services métier**

- Identifie des règles ou des actions métier spécifiques qui ne se limitent pas à une seule entité. Par exemple :
  - **Gestion des Tâches** : création, mise à jour, suppression, modification du statut (par ex. "terminée", "en cours").
  - **Gestion des Utilisateurs** : ajout, mise à jour, suppression de comptes.
- Place ces services dans un dossier `Services` au sein du cœur de ton application.

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
