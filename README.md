
<br/><br/><br/>
<p align="center"><img src="https://www.oneci.ci/assets/images/oneci_logo.svg" width="150"/></p>

<br/>

# Plateforme Identification Abonnés Mobile ONECI
### Code source du Projet d'identification des abonnés mobile de l'Office National de l'Etat Civil et de l'Identification de Côte d'Ivoire
[![Build Status](https://app.travis-ci.com/oneci-dev/identification-abonnes-mobile.svg?token=FCxHLpk7WCyDNpfd9wST&branch=main)](https://app.travis-ci.com/oneci-dev/identification-abonnes-mobile)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)]()

<br/>

## Description

Le **projet** a pour but de permettre à l'**ONECI** de pouvoir **identifier** les **abonnés** des **opérateurs télécoms** à travers un **formulaire** ayant pour but de **collecter les données** et un **Back office** permettant d'effectuer le **traitement** des **données collectées**.

```mermaid
graph LR
A((Abonne Mobile)) -- Renseigner --> B(Formulaire Front Office)
B -- Stocker--> D[(Base de Donnees)]
C[Back Office] -- Mettre a jour --> D
D -- Importer et Traiter --> C
```

## Choix des technologies d'implémentation

|         Spécifications        |FRONT END (Navigateur Client)|BACK END (Serveur ONECI)|
|-------------------------------|-----------------------------|------------------------|
|**Language de développement**  |`HTML` `CSS` `JavaScript`    |`PHP`                   |
|**Framework**                  |`jQuery` `Vue.JS`            |`Laravel`               |
|**Gestionnaire de dépendances**|`NPM`                        |`Composer`              |
|**Base de données**            |`Cookies` `Cache`            |`MariaDB`               |

## Pré-réquis

Pour pouvoir exécuter le code source du projet, assurez-vous de pouvoir disposer des outils suivants :
- [![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4.9-blue.svg)](https://www.php.net/downloads.php)
- [![Composer](https://img.shields.io/badge/Composer-%3E%3D2.3.9-blue.svg)](https://getcomposer.org/download/)
- [![NodeJS](https://img.shields.io/badge/NodeJS-%3E%3D14.18.1-blue.svg)](https://nodejs.org/en/download/)
- [![NPM](https://img.shields.io/badge/NPM-%3E%3D6.14.15-blue.svg)](https://www.npmjs.com/)
- [![MariaDB](https://img.shields.io/badge/MariaDB-%3E%3D10.4.21-blue.svg)](https://mariadb.org/download/)

## Initialisation du projet

Ouvrir votre **terminal** ou **invite de commande** `cmd`, aller à la racine du projet et exécutez les commandes suivantes :
<br/>

- Installation de toutes les dépendances PHP permettant au projet de pouvoir fonctionner convenablement :
```console
composer install
```
- Installation de toutes les dépendances Javascript permettant au projet de pouvoir fonctionner convenablement :
```console
npm install
```
- Création du fichier `.env`
> *Dupliquer le fichier `.env.example` présent dans la racine du projet et renommer le fichier dupliqué avec le nom `.env` puis renseigner ce fichier en spécifiant les **paramètres de votre base de données** locale du projet*.
- Création d'une `APP_KEY`
```console
php artisan key:generate
```
- Création des tables de la base de données du projet
```console
php artisan migrate
```
- Remplisage des tables de la base de données
```console
php artisan db:seed
```

<br/>

- Démarrage du serveur
```console
php artisan serve
```

:blush: Enjoy !

<br/><br/>

*&copy; Copyright Office National de l'Etat Civil et de l'Identification - ONECI - Projet Privé - Tous droits réservés*
