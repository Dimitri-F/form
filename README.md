
# Formulaire d'envoi d'e-mail avec PHPMailer

Ce projet consiste en un formulaire permettant l'envoi d'e-mails en utilisant la bibliothèque PHPMailer. Le formulaire est conçu pour collecter le nom de l'utilisateur, son adresse e-mail et son message, puis envoyer ces informations par e-mail.

## Installation

1. Clonez ce dépôt sur votre machine locale.
2. Assurez-vous d'avoir une installation de PHP sur votre serveur.
3. Téléchargez la bibliothèque PHPMailer et placez les fichiers dans un dossier nommé `phpMailer` à la racine du projet.
4. Configurez les informations d'adresse e-mail de destination dans le fichier `treatment.php` en remplaçant `"your email address"` par votre adresse e-mail réelle.
5. Assurez-vous d'avoir une clé de site reCAPTCHA valide. Remplacez `"your site key here"` dans le fichier `index.php` par votre clé de site reCAPTCHA.

## Utilisation

1. Ouvrez le fichier `index.php` dans votre navigateur.
2. Remplissez tous les champs du formulaire.
3. Cliquez sur le bouton "Send" pour soumettre le formulaire.
4. Si toutes les validations sont réussies, un message de réussite sera affiché et l'e-mail sera envoyé à l'adresse de destination spécifiée.
5. En cas d'erreurs de validation, les messages d'erreur correspondants seront affichés à côté des champs correspondants.

## Structure des fichiers

- `index.php` : Le fichier principal contenant le formulaire HTML et le script JavaScript pour la gestion de la soumission.
- `treatment.php` : Le fichier PHP qui traite les données du formulaire, envoie l'e-mail en utilisant PHPMailer et renvoie les informations de validation au format JSON.
- `script.js` : Le fichier JavaScript qui gère la soumission du formulaire via une requête Ajax vers `treatment.php`.
- `phpMailer/` : Le dossier contenant les fichiers de la bibliothèque PHPMailer.

## Dépendances

- PHPMailer : [Lien vers la bibliothèque PHPMailer](https://github.com/PHPMailer/PHPMailer)

## Auteur

Dimitri F.
