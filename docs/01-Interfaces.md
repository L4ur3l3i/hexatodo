# Les **interfaces** en programmation orientée objet (POO)

## 1. **Qu'est-ce qu'une interface ?**

Une **interface** est un contrat. C'est une sorte de "plan" qui définit un ensemble de méthodes qu'une classe doit implémenter, **sans** fournir d'implémentation elle-même. En d'autres termes, une interface ne contient que la **déclaration des méthodes** (leur nom, les paramètres et le type de retour), mais **pas le code** qui les réalise.

Une classe qui "implémente" une interface doit fournir une **implémentation** pour toutes les méthodes déclarées dans cette interface. Cela permet de garantir que la classe possède un certain ensemble de fonctionnalités, sans dire comment ces fonctionnalités doivent être réalisées.

## 2. **Pourquoi utiliser des interfaces ?**

- **Abstraction** : Elles permettent de **séparer la définition** des méthodes (ce que les méthodes doivent faire) de leur implémentation (comment elles le font).
- **Flexibilité** : En utilisant des interfaces, tu peux changer l’implémentation de certaines classes **sans changer le reste du code**. Cela rend ton code plus flexible et plus modulaire.
- **Polymorphisme** : Grâce aux interfaces, tu peux écrire du code qui utilise une interface commune, sans se soucier de la classe exacte qui implémente cette interface. Cela te permet de traiter différentes classes de manière homogène.

## 3. **Un exemple simple**

Imaginons que tu as une application qui envoie des notifications, mais que tu veux pouvoir envoyer des notifications par email, par SMS ou par d'autres moyens. Tu pourrais définir une **interface** pour cette fonctionnalité :

```php
<?php

interface Notifiable
{
    public function send(string $message): void;
}
```

Cette interface **Notifiable** garantit qu’une classe qui l'implémente doit avoir une méthode `send` qui prend un message en paramètre.

Maintenant, tu peux créer plusieurs classes qui implémentent cette interface de différentes manières.

### Implémentation par Email

```php
<?php

class EmailNotifier implements Notifiable
{
    public function send(string $message): void
    {
        echo "Envoi d'un email avec le message : " . $message;
    }
}
```

### Implémentation par SMS

```php
<?php

class SmsNotifier implements Notifiable
{
    public function send(string $message): void
    {
        echo "Envoi d'un SMS avec le message : " . $message;
    }
}
```

## 4. **Comment utiliser une interface ?**

Une fois que tu as des classes qui implémentent l'interface **Notifiable**, tu peux écrire du code qui travaille uniquement avec l'interface, sans se soucier de quelle classe spécifique est utilisée.

Exemple :

```php
<?php

function notifyUser(Notifiable $notifier, string $message): void
{
    $notifier->send($message);
}

$emailNotifier = new EmailNotifier();
$smsNotifier = new SmsNotifier();

notifyUser($emailNotifier, "Bonjour par email !");
notifyUser($smsNotifier, "Bonjour par SMS !");
```

Dans cet exemple, la fonction `notifyUser` attend un objet qui implémente l'interface **Notifiable**, mais elle ne se soucie pas de savoir s'il s'agit d'un **EmailNotifier** ou d'un **SmsNotifier**. Cela permet de changer l'implémentation plus tard (ajouter des notifications par push, par exemple) sans modifier la fonction `notifyUser`.

## 5. **Applications dans ton projet**

Dans ton projet de **todo-list** :

- L'**interface `TaskRepository`** définit ce qu'un repository de tâches doit être capable de faire (comme trouver, enregistrer, et supprimer des tâches).
- L'implémentation concrète de ce repository (comme `DatabaseTaskRepository`) va fournir le code qui réalise ces actions pour une base de données particulière, par exemple.

Tu pourrais avoir plusieurs implémentations différentes de ce repository, par exemple :

- Un **repository en base de données** (qui sauvegarde les tâches dans une base de données SQL).
- Un **repository en mémoire** (pour des tests, qui garde les tâches dans un tableau PHP en mémoire).

## 6. **Avantages d'une interface dans ton projet**

En utilisant des interfaces, tu pourras :

- **Changer l’implémentation** du stockage des tâches sans impacter le reste de l'application. Par exemple, si tu veux passer de MySQL à une API externe, tu n’as qu’à changer l’implémentation du repository.
- **Tester** plus facilement ton application en fournissant des implémentations factices des repositories (comme un repository en mémoire pour simuler le comportement sans avoir besoin d'une base de données réelle).

## Conclusion

Les interfaces sont un outil puissant pour structurer et rendre ton code plus flexible, plus modulaire et plus facile à maintenir. Elles permettent aussi de respecter les principes de l'architecture hexagonale, où tu veux que ton cœur applicatif soit découplé des détails techniques (comme la manière dont les données sont stockées).

---

Les **interfaces** permettent de **mutualiser** et d'uniformiser les interactions avec tes entités, tout en gardant la flexibilité de changer ou d'améliorer l'implémentation sans impacter le reste de l'application.

Par exemple, comme tu l’as mentionné, les méthodes comme `save`, `delete`, ou `findById` peuvent être communes à plusieurs types de repositories (**UserRepository**, **TaskRepository**, **CategoryRepository**), mais chaque implémentation peut être différente en fonction du stockage que tu choisis (en base de données, en mémoire, etc.).

Cette approche te permet aussi de :

- **Changer facilement le système de stockage** : Imaginons que tu commences avec un repository en mémoire pour le développement rapide ou les tests, puis que tu passes à une base de données MySQL ou à une API REST plus tard, tout cela sans toucher au reste du code qui utilise ces repositories.
- **Tester facilement** : Pendant les tests, tu pourrais simuler des repositories avec des classes en mémoire qui ne font que stocker des données temporairement dans des tableaux, tout en utilisant les mêmes méthodes que tu utiliseras en production avec une base de données.

### Un autre exemple avec un repository générique

Si tu souhaites mutualiser encore plus certaines méthodes (comme `save`, `delete`, etc.), tu pourrais même envisager un **repository générique**. Par exemple :

#### Interface `RepositoryInterface`

```php
<?php

interface RepositoryInterface
{
    public function findById(int $id);
    public function save($entity): void;
    public function delete($entity): void;
}
```

Ensuite, chaque repository spécifique implémenterait cette interface :

#### Implémentation de `TaskRepository`

```php
<?php

class TaskRepository implements RepositoryInterface
{
    // Ici, l'implémentation concrète des méthodes
    public function findById(int $id): ?Task
    {
        // code pour trouver une tâche
    }

    public function save(Task $task): void
    {
        // code pour enregistrer une tâche
    }

    public function delete(Task $task): void
    {
        // code pour supprimer une tâche
    }
}
```

Tu aurais ainsi une structure encore plus réutilisable pour toutes tes entités, tout en pouvant avoir des implémentations spécifiques pour chaque cas.

### Décorrélation totale de la mémoire ou du système de persistance

Un des gros avantages, comme tu l’as vu, c’est que tu peux complètement **décorréler la persistance (système de stockage)** de la logique métier. Par exemple, avec cette flexibilité, tu pourrais :

- **Passer d'un stockage en fichier** (par exemple des fichiers CSV) à une **base de données** relationnelle.
- **Simuler des tests** sans avoir à toucher à une base de données réelle.
- **Changer le backend** de ton application sans impacter la logique métier. Par exemple, passer d'une base SQL à un NoSQL comme MongoDB ou à une API REST distante.

C'est là tout l’intérêt des interfaces et des architectures découplées comme l’architecture hexagonale : le cœur de ton application (la logique métier) reste indépendant des détails d'implémentation techniques, que ce soit pour la persistance, les notifications, ou d'autres aspects.
