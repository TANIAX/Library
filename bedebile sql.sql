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
  user_name VARCHAR(50) DEFAULT NULL,
  user_firstname VARCHAR(50) DEFAULT NULL,
  user_email VARCHAR(255) NOT NULL UNIQUE,
  user_login VARCHAR(255) NOT NULL UNIQUE,
  user_password VARCHAR(255) NOT NULL,
  user_adresse VARCHAR(255) DEFAULT NULL,
  user_role INT(11) NOT NULL,
  user_tel CHAR(11) DEFAULT NULL,
  FOREIGN KEY (user_role) REFERENCES roles(role_id)
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO users (user_email,user_name,user_firstname,user_login,user_password,user_adresse,user_role,user_tel)
VALUES ('Guillaume.cornez@gmail.com','Guillaume','Cornez','toto','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','82 Rue des champs 7100 La louviere',1,'0497393939'),
       ('Guillaume.taniax@gmail.com','Guillaume','Cornez','blabla','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','33 rue de la tourette 7170 Maurage',2,'0497393939'),
       ('Guillaume.tnx@hotmail.com','Guillaume','Cornez','tata','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','1 rue de la lois 1100 Bruxelle',2,'0497393939'),
       ('Guillaume.tnx@gmail.com','Guillaume','Cornez','souris','$2y$10$wnr2tAMWMYFFcYnEp8KGSuW/ZMBpz/FoeHmoBZ2AzwGw8QPvbyVWa','15 rue de la villete 3500 Ixelle',2,'0497393939');

 DROP TABLE IF EXISTS articles ;
 CREATE TABLE articles (
 article_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 article_prix FLOAT NOT NULL,
 article_nom VARCHAR(255) NOT NULL,
 article_image VARCHAR(1000) DEFAULT 'http://res.cloudinary.com/dfencxbqa/image/upload/v1523033518/unnamed.jpg',
 article_isbn VARCHAR(255) DEFAULT NULL UNIQUE,
 article_auteur VARCHAR(50) DEFAULT NULL,
 article_editeur VARCHAR(50) DEFAULT NULL,
 article_categorie INT(11) NOT NULL,
 article_date DATE NOT NULL,
 article_description TEXT,
FOREIGN KEY (article_categorie) REFERENCES categorie(categorie_id)
) ENGINE=INNODB DEFAULT CHARSET=latin1;
INSERT INTO articles (article_prix,article_image,article_nom,article_auteur,article_editeur,article_categorie,article_isbn,article_date,article_description)
VALUES (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034128/op73png.png','One piece t.73 : L\'opération dressrosa S.O.P.','Eiichiro ODA','Glenat',5,'11113',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034128/op72.png','One piece t.72 : Les oubliés de dressrosa ','Eiichiro ODA','Glenat',5,'11112',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034127/op71.png','One piece t.71 : Le colisée de tous les dangers.','Eiichiro ODA','Glenat',5,'11111',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523047075/Opera_Instantané_2018-04-06_223534_www.amazon.fr.png','One piece t.74 : Je serai toujours à tes côtés','Eiichiro ODA','Glenat',5,'11114',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523047074/Opera_Instantané_2018-04-06_223555_www.amazon.fr.png','One piece t.75 : Ma gratitude','Eiichiro ODA','Glenat',5,'11116',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523047075/Opera_Instantané_2018-04-06_223654_www.amazon.fr.png','One piece t.76 : Poursuis ta route !','Eiichiro ODA','Glenat',5,'111117',NOW(),'Test'),
       (7.5,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523047258/77_www.amazon.fr.png','One piece t.76 : Smile','Eiichiro ODA','Glenat',5,'111118',NOW(),'Test'),
       (15,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034128/popkylo.png','Figurine POP : Kylo ren ',NULL,NULL,4,NULL,NOW(),'Test'),
       (15,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034128/Opera_Instantané_2018-04-06_185954_www.amazon.fr.png','Figurine POP : Chopper ',NULL,NULL,4,NULL,NOW(),'Test'),
       (9.99,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034126/Opera_Instantané_2018-04-06_190036_www.amazon.fr.png','Tintin t.17 : On a marcher sur la lune','Hergé','Casterman',1,5165,NOW(),'Test'),
       (159,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034126/Opera_Instantané_2018-04-06_190114_www.amazon.fr.png','Kray Kat Collector Edition','George Herriman','Eclipse comics',2,4648,NOW(),'Test'),
       (0,'http://res.cloudinary.com/dfencxbqa/image/upload/v1523034127/Opera_Instantané_2018-04-06_190152_www.amazon.fr.png','Vingt mille lieues sous les mers','Jules Verne','Pierre-Jules Hetzel',3,15185,NOW(),'Test');

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
