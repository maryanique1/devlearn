# Dev Learn

Plateforme d'apprentissage du developpement web par QCM, construite avec Laravel.

## Fonctionnalites

### Parcours progressifs
- **6 technologies** : C++, HTML, CSS, JavaScript, PHP, SQL
- **7 chapitres** par technologie avec mini-lecons integrees
- **50 questions** par parcours, progressant du debutant a l'intermediaire
- Chaque chapitre commence par une lecon illustree avant les questions
- Sauvegarde automatique de la progression (reprise ou on s'est arrete)

### Epreuves & QCM
- **12 epreuves** issues de sujets d'examen reels (Licence SIL, Ecoles Superieures)
- **325+ questions** couvrant HTML, CSS, JavaScript, PHP, MySQL
- Questions melangees aleatoirement a chaque tentative
- Correction immediate avec explications detaillees
- Bouton "Retravailler mes erreurs" pour cibler ses points faibles

### Examen Final
- **60 questions** chronometre (30 minutes)
- Couvre les 6 technologies
- Resultat detaille par categorie avec analyse des points faibles
- Certificat de reussite imprimable a partir de 80%

### Tableau de bord
- Message de bienvenue personnalise selon l'heure
- Statistiques : QCM completes, score moyen, tentatives
- Reprise rapide du dernier parcours en cours
- Parcours visuel de progression (6 etapes)
- Citation motivante aleatoire

### Profil utilisateur
- Photo de profil avec upload (compatible mobile)
- Modification du nom et mot de passe
- Biographie personnalisable
- Historique complet des scores avec graphique d'evolution

### Classement
- Tableau des meilleurs scores par utilisateur
- Comparaison entre apprenants

### Certificat
- Generation automatique apres validation de l'examen final (>= 80%)
- Certificat imprimable avec nom et date

### Administration
- Panel d'administration pour les comptes admin
- Gestion des utilisateurs (promotion admin, suppression)
- Consultation et suppression des scores

## Stack technique

- **Backend** : Laravel 12, PHP 8.2
- **Frontend** : Blade, CSS natif (variables CSS, Flexbox, Grid), JavaScript vanilla
- **Base de donnees** : MySQL
- **Icons** : Lucide Icons
- **Authentification** : systeme natif Laravel

## Installation

```bash
git clone https://github.com/maryanique1/devlearn.git
cd devlearn
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

## Structure du projet

```
app/
  Http/Controllers/
    DashboardController.php    # Tableau de bord, parcours, epreuves
    QcmController.php          # Affichage des quiz
    ScoreController.php        # Sauvegarde des scores (API)
    ProgressController.php     # Sauvegarde de la progression (API)
    ProfileController.php      # Profil utilisateur
    LeaderboardController.php  # Classement
    CertificateController.php  # Generation du certificat
    AdminController.php        # Administration
  Models/
    User.php, Score.php, Progress.php

resources/views/
    qcm/           # 20 fichiers de quiz (6 parcours + 12 epreuves + exam)
    dashboard.blade.php
    parcours.blade.php
    epreuves.blade.php
    profil.blade.php
    classement.blade.php
    accueil.blade.php   # Landing page (visiteurs non connectes)
    layouts/app.blade.php  # Layout principal avec sidebar
```

## Auteur

Maryanique
