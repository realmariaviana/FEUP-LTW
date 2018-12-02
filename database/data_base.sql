drop TABLE if exists users;
drop TABLE if exists stories;
drop TABLE if exists comments;
drop TABLE if exists likes;
drop TABLE if exists dislikes;


CREATE TABLE users(
  username VARCHAR PRIMARY KEY,
  email VARCHAR UNIQUE,
  password VARCHAR NOT NULL
);

CREATE TABLE stories(
  story_id INTEGER AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR NOT NULL REFERENCES users,
  title TEXT NOT NULL, 
  body TEXT NOT NULL,
  hour DATE NOT NULL
);

CREATE TABLE comments (
  comment_id INTEGER AUTO_INCREMENT PRIMARY KEY,
  user_id VARCHAR NOT NULL REFERENCES users,
  story_id INTEGER NOT NULL REFERENCES stories,
  body TEXT NOT NULL,
  hour DATE
);

CREATE TABLE likes(
  story_id INTEGER REFERENCES stories,
  username VARCHAR REFERENCES users,
  PRIMARY KEY (story_id, username)
);

CREATE TABLE dislikes(
  story_id INTEGER REFERENCES stories,
  username VARCHAR REFERENCES users,
  PRIMARY KEY (story_id, username)
);

/*
--NEED TO KNOW IF THE SINTAX IS RIGHT
CREATE likes_dislike AFTER INSERT ON likes
BEGIN 
  When((Select username, story_id from dislikes Where username = New.username, story_id = NEW.story_id) NOT NULL )
  THEN Delete from dislikes where username = New.username AND story_id = NEW.story_id
End;
END;
*/

INSERT INTO users Values("sheila1", "rosa@gmail.com", "lagrosinha");
INSERT INTO users Values("sheila2", "pota@pota.com", "distraida");
INSERT INTO users Values("Gansini", "carlosdcfgomes@hotmail.com","parolini");
INSERT INTO stories Values(1,"Gansini", "A bela Faculdade", "É sempre top tar na feup", date('now'));
INSERT INTO stories Values(2,"Gansini", "Faculdade de Merda", "Mas isto às vezes chateia", date('now'));
INSERT INTO stories Values(3,"sheila1", "Dormir", "Eu devia estar mesmo a nanar a esta hora", date('now'));
INSERT INTO stories Values(4,"sheila2", "PUTA QUE PARIU ESTA MERDA", "FODACE CARALHO PQP", Date('now'));
INSERT INTO comments Values(1, "sheila2", "A bela Faculdade", "LOL, TAVA BEM SEM ESTA MERDA", date('now'));
INSERT INTO comments Values(2, "sheila1", "PUTA QUE PARIU ESTA MERDA", "same <3", date('now'));
INSERT Into comments Values(3, "Gansini", "Faculdade de Merda", "Nunca disse algo tão certo", date('now'));
