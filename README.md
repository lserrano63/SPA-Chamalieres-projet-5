# Jean-Forteroche

Projet 5 Openclassrooms / Dév Web Junior
https://openclassrooms.com/fr/paths/48/projects/34/assignment

Lien d'hébergement: https://projetsls.fr/SPA-Chamalieres/Acceuil
Site correspondant au nouveau refuge de la Société Protectrice des Animaux (SPA) de Chamalières.

Le site a été codé en HTML/CSS/JS/PHP avec une architecture MVC orienté objet. Framework : Bootstrap. Utilisation de l'autoloader de Composer.

Concernant le site :

- Css -> complément à Bootstrap et media queries.
- Fonts -> Différentes polices du site.
- Images -> regroupe les images globales du site et un dossier animals contenant les images des animaux du refuge.
- MVC -> - Controllers -> regroupe les controlleurs backend (actions admin) et frontend (actions utilisateur).
         - Models -> regroupe les modèles : Manager pour la connection bdd, PostManager données liées aux posts, CommentManager données liées aux commentaires/posts/animaux, AnimalManager données liées aux animaux, UserManager données liées aux utilisateurs/admins, data_to_json données liées aux différentes spa pour la carte.
         - Views -> regroupe les différentes vues du site. Utilisation d'un template. Le routeur gère les vues du site par rapport aux actions.
- Scripts -> regroupe les scripts pour TinyMCE, l'affichage de la carte, l'affichage du carousel et le tri des animaux.
- Vendor -> Autoloader de composer.
- composer.json -> idem.
- .htacess -> Réecriture d'urls.
- index.php -> page d'acceuil du site.
