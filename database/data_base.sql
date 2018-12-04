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
  story_id INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL REFERENCES users,
  title TEXT NOT NULL, 
  body TEXT NOT NULL,
  hour DATETIME NOT NULL
);

CREATE TABLE themes(
  theme TEXT,
  story INTEGER REFERENCES stories,
  PRIMARY KEY (theme, story)
);

CREATE TABLE comments (
  comment_id INTEGER PRIMARY KEY,
  user_id VARCHAR NOT NULL REFERENCES users,
  story_id INTEGER NOT NULL REFERENCES stories,
  body TEXT NOT NULL,
  hour DATETIME
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

INSERT INTO users Values("sheila1", "rosa@gmail.com", "c7021fedf66cbda549838f07647e3489ce85990e");
INSERT INTO users Values("sheila2", "pota@pota.com", "64fe28c207ce4605548a45b0230f71d97b45957b");
INSERT INTO users Values("Gansini", "carlosdcfgomes@hotmail.com","976358f0e93dec372cfae1d679ad9e48cfcc8845");
INSERT INTO stories Values(1,"Gansini", "A bela Faculdade", "É sempre top tar na feup", date('now'));
INSERT INTO stories Values(2,"Gansini", "Faculdade de Merda", "Mas isto às vezes chateia", date('now'));
INSERT INTO stories Values(3,"sheila1", "Dormir", "Eu devia estar mesmo a nanar a esta hora", date('now'));
INSERT INTO stories Values(4,"sheila2", "PUTA QUE PARIU ESTA MERDA", "FODACE CARALHO PQP", Date('now'));
INSERT INTO comments Values(1, "sheila2", "A bela Faculdade", "LOL, TAVA BEM SEM ESTA MERDA", date('now'));
INSERT INTO comments Values(2, "sheila1", "PUTA QUE PARIU ESTA MERDA", "same <3", date('now'));
INSERT Into comments Values(3, "Gansini", "Faculdade de Merda", "Nunca disse algo tão certo", date('now'));
INSERT INTO themes Values("School", 1);
INSERT INTO themes Values("Preguiça", 3);
Insert INTO themes Values("Palavrões", 4);