DROP DATABASE bedebile;
CREATE DATABASE bedebile;
USE bedebile;

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
  role_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  role_name VARCHAR(10) NOT NULL UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO Roles (role_name) VALUES ('admin'),('membre');

DROP TABLE IF EXISTS categorie;
CREATE TABLE categorie (
  categorie_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  categorie_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO categorie (categorie_name)
VALUES ('Bande_dessinee'),('comics'),('livre'),('figurine'),('manga'),('dvd'),('jeux_plateau'),('jeux_cartes'),('affiche'),('divers');

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  user_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_email VARCHAR(255) NOT NULL UNIQUE,
  user_login VARCHAR(255) NOT NULL UNIQUE,
  user_password VARCHAR(255) NOT NULL,
  user_adresse VARCHAR(255) DEFAULT NULL,
  user_role INT(11) NOT NULL,
  FOREIGN KEY (user_role) REFERENCES roles(role_id)
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO users (user_email,user_login,user_password,user_adresse,user_role)
VALUES ('Guillaume.cornez@gmail.com','toto','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','82 Rue des champs 7100 La louviere',1),
       ('Guillaume.taniax@gmail.com','blabla','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','33 rue de la tourette 7170 Maurage',2),
       ('Guillaume.tnx@hotmail.com','tata','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','1 rue de la lois 1100 Bruxelle',2),
       ('Guillaume.tnx@gmail.com','souris','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','15 rue de la villete 3500 Ixelle',2);

 DROP TABLE IF EXISTS articles ;
 CREATE TABLE articles (
 article_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 article_prix FLOAT NOT NULL,
 article_nom VARCHAR(255) NOT NULL,
 article_image MEDIUMBLOB,
 article_auteur VARCHAR(50) DEFAULT NULL,
 article_editeur VARCHAR(50) DEFAULT NULL,
 article_categorie INT(11) NOT NULL,
FOREIGN KEY (article_categorie) REFERENCES categorie(categorie_id)
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO articles (article_prix,article_nom,article_auteur,article_editeur,article_categorie)
VALUES (7.5,'One piece t.73 : L\'opération dressrosa S.O.P.','Eiichiro ODA','Glenat',5),
       (7.5,'One piece t.72 : Les oubliés de dressrosa ','Eiichiro ODA','Glenat',5),
       (7.5,'One piece t.71 : Le colisée de tous les dangers.','Eiichiro ODA','Glenat',5),
       (15,'Figurine POP : Kylo ren ',NULL,NULL,4),
       (15,'Figurine POP : Chopper ',NULL,NULL,4),
       (9.99,'Tintin t.17 : On a marcher sur la lune','Hergé','Casterman',1),
       (159,'Kray Kat Collector Edition','George Herriman','Eclipse comics',2),
       (0,'Vingt mille lieues sous les mers','Jules Verne','Pierre-Jules Hetzel',3);

DROP TABLE IF EXISTS commandes;
CREATE TABLE commandes (
  commande_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  commande_user_id INT(11) NOT NULL,
  FOREIGN KEY (commande_user_id) REFERENCES users (user_id)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

  DROP TABLE IF EXISTS jointable;
  CREATE TABLE jointable(
    jointure_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    jointure_commande_id INT(11) NOT NULL,
    jointure_article_id INT(11) NOT NULL,
    jointure_prix FLOAT NOT NULL, -- Re écrire le prix de la table articles en dur
    FOREIGN KEY (jointure_commande_id) REFERENCES commandes(commande_id),
    FOREIGN KEY (jointure_article_id) REFERENCES articles(article_id)
  )ENGINE=INNODB DEFAULT CHARSET=latin1;
