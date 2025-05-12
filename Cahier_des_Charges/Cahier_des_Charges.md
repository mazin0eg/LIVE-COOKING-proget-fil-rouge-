# CookNow - Plateforme de Recettes Interactive

<div style="color: #f33f33;">

## 1. Introduction

**Titre du projet** : CookNow

**Contexte** : Aujourd'hui, avec la montée en puissance du digital, l'apprentissage de la cuisine devient de plus en plus interactif. De nombreuses plateformes proposent des recettes, mais très peu offrent une immersion en temps réel pour accompagner les utilisateurs tout au long du processus de préparation.

**Objectif** : Créer un site web interactif pour les recettes culinaires, permettant aux utilisateurs de suivre des étapes en temps réel grâce à une barre de progression (Live Cooking). Cette plateforme vise à améliorer l'expérience d'apprentissage culinaire en proposant une approche dynamique et engageante, tout en permettant aux chefs amateurs de partager leurs créations.

**Public cible** : Amateurs de cuisine, chefs, et toute personne intéressée par les recettes interactives, qu'ils soient débutants ou experts.

</div>

---

<div style="color: white; background-color: #f33f33; padding: 10px;">

## 2. Présentation du projet

**Description générale** : 
Le site web proposera une plateforme où les utilisateurs pourront :
- Explorer des recettes par catégorie, cuisine, temps de préparation et difficulté.
- S'inscrire et interagir en tant que cookers (utilisateurs standard), chefs (créateurs de contenu) ou administrateurs.
- Suivre les recettes en temps réel grâce à une fonctionnalité unique appelée "Live Cooking".
- Postuler pour devenir chef et partager leurs propres recettes.

**Valeur ajoutée** : 
- L'approche interactive rend l'apprentissage de la cuisine plus ludique et pratique.
- Système de progression qui permet de suivre chaque étape de la recette en temps réel.
- Processus de validation des chefs pour garantir la qualité des recettes.

</div>

---

<div style="color: #f33f33;">

## 3. Problématique

L'apprentissage de la cuisine en ligne présente plusieurs défis :
- Le manque d'interactivité dans les tutoriels et les recettes écrites.
- L'absence d'un guide en temps réel pour assurer une bonne gestion du temps de cuisson et de préparation.
- La difficulté pour les débutants de suivre correctement les étapes sans supervision.
- Le manque de plateforme permettant aux amateurs de cuisine de partager leurs recettes de manière professionnelle.

Le projet CookNow vise à répondre à ces problématiques en offrant une solution immersive, où les utilisateurs suivent une recette avec une barre de progression en temps réel et des notifications pour assurer le bon déroulement de chaque étape, tout en permettant aux passionnés de cuisine de devenir chefs et de partager leurs créations.

</div>

---

<div style="color: #f33f33;">

## 4. Objectifs fonctionnels

### Rôles des utilisateurs :

- **Visiteur** :
  - Consulter les recettes publiques.
  - Rechercher des recettes par catégorie, cuisine, temps de préparation ou difficulté.

- **Cooker (utilisateur enregistré)** :
  - Enregistrer des recettes en favoris.
  - Suivre les recettes avec l'option "Live Cooking".
  - Postuler pour devenir chef via le formulaire de contact.
  - Voir l'historique des recettes qu'ils ont cuisinées.

- **Chef** :
  - Publier des recettes avec des étapes, ingrédients, équipements et minutages spécifiques.
  - Gérer leurs propres recettes (modifier, supprimer).
  - Accéder à une page dédiée pour l'ajout de recettes.

- **Administrateur** :
  - Gérer les utilisateurs (cookers, chefs).
  - Approuver ou rejeter les demandes pour devenir chef.
  - Valider ou supprimer des recettes.
  - Gérer les catégories et ingrédients.
  - Surveiller l'activité du site.

### Fonctionnalité spéciale : Live Cooking

- Barre de progression interactive montrant le temps restant pour chaque étape.
- Notifications ou alertes pour passer à l'étape suivante.
- Suivi du temps de cuisson total et des étapes complétées.
- Enregistrement des statistiques de cuisson pour chaque utilisateur.

### Processus de demande pour devenir chef :

- Les utilisateurs avec le rôle "cooker" peuvent postuler via le formulaire de contact.
- Ils doivent fournir des informations sur leur expérience, spécialité et motivation.
- Les administrateurs examinent les demandes et peuvent les approuver ou les rejeter.
- Une fois approuvé, l'utilisateur reçoit une notification par email et son rôle est changé en "chef".

</div>

---

<div style="color: white; background-color: #f33f33; padding: 10px;">

## 5. Objectifs techniques

**Technologies utilisées** :

- **Frontend** : HTML, CSS, JavaScript, Bootstrap.
- **Backend** : Laravel (PHP Framework).
- **Base de données** : MySQL.
- **Système d'emails** : Laravel Mail avec SMTP.
- **Hébergement** : Serveur web compatible avec PHP et SQL.

**Fonctionnalités principales** :

- Authentification et gestion des rôles (cookers, chefs, administrateurs) avec Gates Laravel.
- CRUD (Create, Read, Update, Delete) des recettes avec relations complexes (ingrédients, étapes, équipements).
- Système de recherche avancée (par titre, ingrédient, catégorie, cuisine, temps de préparation, difficulté).
- Système de suivi des recettes cuisinées par utilisateur.
- Processus de demande et d'approbation pour devenir chef.
- Interface utilisateur responsive et intuitive.
- Système de notification par email.

**Architecture des données** :

- Modèle User avec rôles (cooker, chef, admin, banned).
- Modèle Recipe avec relations vers RecipeIngredient, RecipeStep, RecipeEquipment.
- Modèle Contact pour les demandes de contact et les candidatures chef.
- Modèle CookedRecipe pour suivre les statistiques de cuisson des utilisateurs.

</div>

---

<div style="color: #f33f33;">

## 6. Conception UX/UI

- **Thème visuel** : Design épuré et moderne, mettant en avant les images des plats.
- **Navigation** :
  - Menu clair avec catégories principales.
  - Accès rapide aux recettes "Live Cooking".
  - Tableau de bord administrateur pour la gestion des utilisateurs et des demandes chef.
  - Interface dédiée pour l'ajout et la modification des recettes.
- **Pages principales** :
  - Accueil avec recettes populaires, récentes et nouvelles.
  - Page de recherche avec filtres avancés.
  - Page détaillée de recette avec option "Start Cooking".
  - Interface Live Cooking avec barre de progression.
  - Formulaire de contact avec option pour postuler comme chef.
  - Profil utilisateur avec historique des recettes cuisinées.
- **Accessibilité** : Optimisation pour les mobiles et tablettes.

</div>

---

<div style="color: white; background-color: #f33f33; padding: 10px;">

## 7. Livrables

- Site web fonctionnel avec toutes les fonctionnalités décrites.
- Base de données avec modèles relationnels (User, Recipe, RecipeIngredient, RecipeStep, RecipeEquipment, Contact, CookedRecipe).
- Système de gestion des rôles et des permissions.
- Processus complet de demande et d'approbation pour devenir chef.
- Interface Live Cooking fonctionnelle avec suivi des statistiques.
- Documentation technique (codes, base de données, instructions d'installation).
- Manuel utilisateur pour les différents rôles (cooker, chef, administrateur).

</div>

---

<div style="color: #f33f33;">

## 8. Planning

- **Étape 1** : Recherche et analyse (1 semaine).
- **Étape 2** : Conception UML et modélisation de la base de données (2 semaines).
- **Étape 3** : Développement du système d'authentification et de gestion des rôles (1 semaine).
- **Étape 4** : Développement du système de recettes et relations (2 semaines).
- **Étape 5** : Développement du processus de demande pour devenir chef (1 semaine).
- **Étape 6** : Développement de l'interface Live Cooking (2 semaines).
- **Étape 7** : Développement du système de recherche avancée (1 semaine).
- **Étape 8** : Intégration frontend et optimisation UI/UX (2 semaines).
- **Étape 9** : Tests et corrections (2 semaines).
- **Étape 10** : Livraison finale.

</div>

---

<div style="color: white; background-color: #f33f33; padding: 10px;">

## 9. Contraintes

- Respecter le délai de fin d'année scolaire.
- Compatibilité avec les navigateurs modernes.
- Performance optimale pour une bonne expérience utilisateur.
- Sécurisation des données utilisateurs et des processus d'authentification.
- Gestion efficace des permissions pour garantir que seuls les chefs peuvent ajouter des recettes.
- Système d'emails fonctionnel pour les notifications aux utilisateurs.

</div>

---

<div style="color: #f33f33;">

## 10. Budget et ressources

- Aucun budget spécifique. Utilisation de ressources gratuites ou open-source.
- Besoin d'un ordinateur et d'un environnement de développement Laravel.
- Utilisation de Bootstrap pour le frontend.
- Système de stockage pour les images de recettes.
- Configuration SMTP pour l'envoi d'emails.

</div>
