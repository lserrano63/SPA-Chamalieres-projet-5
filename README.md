# Jean-Forteroche

Projet 4 Openclassrooms / Dév Web Junior

Vous venez de décrocher un contrat avec Jean Forteroche, acteur et écrivain. Il travaille actuellement sur son prochain roman, "Billet simple pour l'Alaska". Il souhaite innover et le publier par épisode en ligne sur son propre site.

Seul problème : Jean n'aime pas WordPress et souhaite avoir son propre outil de blog, offrant des fonctionnalités plus simples. Vous allez donc devoir développer un moteur de blog en PHP et MySQL.

Lien d'hébergement: https://projetsls.fr/JeanForteroche/index.php

Application de blog simple en PHP et avec une base de données MySQL. Elle fournit une interface frontend (lecture des billets) et une interface backend (administration des billets pour l'écriture). On doit y retrouve tous les éléments d'un CRUD.

Chaque billet permet l'ajout de commentaires, qui peuvent être modérés dans l'interface d'administration au besoin.
Les lecteurs peuvent "signaler" les commentaires pour que ceux-ci remontent plus facilement dans l'interface d'administration pour être modérés.
L'interface d'administration est protégée par mot de passe. La rédaction de billets se fera dans une interface WYSIWYG basée sur TinyMCE.

Le site a été codé en pur PHP avec une architecture MVC. De plus, le modèle est orienté objet. Concernant le CSS, j'ai aussi utilisé Bootstrap.

Concernant le site :
- Controllers -> regroupe les controlleurs backend (actions admin) et frontend (actions utilisateur).
- Css -> complément à Bootstrap et media queries.
- Images -> regroupe une image de fond d'acceuil et un favicon.
- Models -> regroupe les modèles : Manager pour la connection bdd, PostManager données liées aux posts, BioManager données liées aux parties biographie et contact, CommentManager données liées aux commentaires/posts.
- Scripts -> regroupe le script TinyMCE.
- Views -> regroupe les différentes vues du site. Utilisation d'un template. Le routeur gère les vues du site par rapport aux actions.
- index.php -> page d'acceuil du site.
- Lisez-moi-Jean -> aide pour le client.
