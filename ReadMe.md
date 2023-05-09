# Studio Experience

## Introduction

Le projet est une plateforme de gestion de contenu qui permet de créer et gérer des postes sous divers formats (articles, vidéos, podcasts, etc.), des catégories, des utilisateurs et des commentaires. Les droits des utilisateurs sont également gérés par cette plateforme.

### 1. Création et de gestion de contenu

Les créateurs de contenu pourront non seulement créer des posts, mais également différer la date de publication, modifier et supprimer leur contenu. L'interface de création offre des options de personnalisation telles que le choix de la police, des couleurs, des tailles, des images, des vidéos, des liens, etc. Ils pourront également mettre en forme le texte (gras, italique, souligné, alignement, listes, etc.) et mettre en avant certaines parties (titre, sous-titre, citation, code, etc.).

### 2. Fonctionnalités

Outre la création de posts, le projet proposera une barre de recherche, un système de commentaires, de notation, de partage sur les réseaux sociaux, de newsletter, de gestion de favoris, de gestion de playlists et de connexion groupée aux autres solutions web proposées par le Studio OKAI™.

### 3. Modèle économique

Le contenu sera présenté sous la forme d'un blog freemium, proposant à la fois du contenu gratuit et du contenu payant.

### 4. Design

Le design de la plateforme s'inspirera de Netflix pour la partie client et de Wix pour la partie admin. Ceci se traduit par un design simple et épuré, des sliders pour présenter les posts pour la partie client, et une interface d'options complète et intuitive pour la partie admin. Un système d'AB testing sera mis en place pour déterminer le design le plus efficace sur certains points.

### 5. Gestion des cookies

La plateforme gérera les cookies pour mémoriser les préférences des utilisateurs, tout en respectant les lois en vigueur sur la RGPD.

### 6. Sécurité

La plateforme gérera les droits des utilisateurs et les droits d'accès aux contenus payants. Elle se protégera également contre les attaques XSS, CSRF, par injection SQL et par brute force. Des logs seront mis en place pour suivre les actions des utilisateurs/administrateurs et détecter les attaques potentielles.

### 7. SEO

Le projet offrira des options de gestion des meta tags (title, description, keywords) pour chaque post. Les sitemaps et les robots.txt seront également gérés dès la création et la mise en ligne de l'article.

### 8. Technologies

Le projet se basera sur les technologies suivantes :

-   Symfony 6.2 (voir la [documentation](https://symfony.com/doc/current/index.html#gsc.tab=0)) : framework PHP pour la partie back-end
-   PHPUnit (voir la [documentation](https://phpunit.readthedocs.io/en/9.5/)) : librairie PHP pour la gestion des tests unitaires
-   Webpack (voir la [documentation](https://webpack.js.org/concepts/)) : module bundler pour la partie front-end
-   SaSS sous la syntaxe SCSS   (voir la [documentation](https://sass-lang.com/documentation)) : préprocesseur CSS pour la partie front-end
-   Full Calandar (voir la [documentation](https://fullcalendar.io/docs)) : librairie JavaScript pour la gestion des calendriers et des événements 
-   Day.js (voir la [documentation](https://day.js.org/docs/en/installation/installation)) : librairie JavaScript pour la gestion des dates
-   Swiper.js (voir la [documentation](https://swiperjs.com/get-started)) : librairie JavaScript pour la gestion des sliders
     
-   TinyMCE (voir la [documentation](https://www.tiny.cloud/docs/)) : librairie JavaScript pour la gestion des éditeurs de texte enrichi (WYSIWYG) 
-   Howler.js (voir la [documentation](https://howlerjs.com/)) : librairie JavaScript pour la gestion des sons 
-   Chart.js (voir la [documentation](https://www.chartjs.org/docs/latest/)) : librairie JavaScript pour la gestion des graphiques 
-   Video.js (voir la [documentation](https://docs.videojs.com/)) : librairie JavaScript pour la gestion des vidéos 
-   Guzzle (voir la [documentation](https://docs.guzzlephp.org/en/stable/)) : librairie PHP pour la gestion des requêtes HTTP 
-   Stripe (voir la [documentation](https://stripe.com/docs/api)) : librairie PHP pour la gestion des paiements 
-    Paypal (voir la [documentation](https://developer.paypal.com/docs/api/overview/)) : librairie PHP pour la gestion des paiements 
-   API Platform (voir la [documentation](https://api-platform.com/docs/core/getting-started/)) : framework PHP pour la gestion des API REST associer à Symfony
-   Logger (voir la [documentation](https://symfony.com/doc/current/logging.html)) : librairie PHP pour la gestion des logs 

