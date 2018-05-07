# Installation
Cours de projet web 

* git clone https://github.com/TANIAX/Library

* Editer le fichier models/db.php. Modifier le login/pass pour la connexion à la db en ligne 5 (par défaut: login: 'root', password: '').

* importer le dump qui se trouve à la racine du répertoire (bedebile sql.sql).

* Créer un nouveau host dans /etc/hosts.
```
127.0.0.1 projet.local
```
* Créer un vhost pour votre projet.
```
##### 
## monprojet.local 
## DOMAINE de monprojet 
##### 
NameVirtualHost monprojet.local

<Directory "C:/wamp/www/monprojet/">
AllowOverride All
Options Indexes MultiViews FollowSymLinks
Require all granted
</Directory>

<VirtualHost monprojet.local> 
DocumentRoot C:/wamp/www/monprojet/ 
ServerName monprojet.local
</VirtualHost>
```
## User de test 'Admin':

* login: toto
* password: tata
## User de test 'Client':

* login: tata
* password: tata
