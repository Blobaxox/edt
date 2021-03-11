# edt
## Installation

récuperer et dézipper le projet.

Exécuter dans un terminal la commande composer install pour installer les dépendances du projet.
Créer un fichier .env.local à partir du fichier .env et le remplir pour connecter le projet à une base de données.
Exécuter dans un terminal la commande php bin/console doctrine:database:create pour créer la base de données.
Exécuter dans un terminal la commande php bin/console doctrine:migrations:migrate pour importer le schéma de la base de données.

ouvrir le serveur sur le port 8080 (php -S localhost:8080)

Aller sur la page http://localhost:8080/edt.html

## Base de données :

Pour ajouter un cours dans la base de données aller sur la page http://localhost:8080/admin (attention sur Firefox les champs de date ne s'affiche pas correctement, préferer Chrome ou Edge)

Nous avons créer les entités Salle et Cours, ainsi que les Crud associés. Un cours a lieu dans une salle, une salle peut accueillir plusieurs cours. Un cours concerne une matière, et une matière peut avoir plusieurs cours. Un cours est donné par un professeur, et un professeur peut donner plusieurs cours.

## Api :
Pour chaque cours l'API renvois :
- id
- type
- dateHeureDebut (datetime complet)
- heureDebut (format HH:MM)
- heureFin (format HH:MM)
- date (format AAAA-mm-jj)
- dateHeureFin (datetime complet)
- weekNumber (numéro de la semaine dans l'année)
- professeur
- matiere
- salle

### Renvois tous les cours

Route : /api/cours

### Renvois tous le cours {id}

Route : /api/cours/{id}

### Renvois tous les cours du jours numéro {date} de l'année

Route : /api/cours/date/{date}
L'API renvois {date} avant la liste des cours

## Validators :

Pour ajouter un cours, il faut que :
  Le professeur n'ait pas un autre cours en même temps
  La date de début du cours doit être antérieure à la date de fin
  La salle ne soit pas déjà utilisée par un autre cours
  Le professeur, la salle, et la matière doivent exister

Nous avons sacrément galéré pour ces validators

## Intégration des avis de professeurs dans l'edt:

Nous avons fini par réussir à afficher les cours en fonction des jours ainsi que les avis sur les professeurs sur la même page. Nous avons eu quelques difficultés pour gérer l'exception d'afficher un jour sans cours mais nous avons utiliser un v-if pour régler ce soucis.
