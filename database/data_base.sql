drop TABLE if exists users;
drop TABLE if exists stories;
drop TABLE if exists comments;
drop TABLE if exists likes;
drop TABLE if exists dislikes;
drop TABLE if exists themes;


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

CREATE TABLE comments (
  comment_id INTEGER PRIMARY KEY,
  user_id VARCHAR NOT NULL REFERENCES users,
  story_id INTEGER NOT NULL REFERENCES stories,
  body TEXT NOT NULL,
  hour DATETIME
);

CREATE TABLE themes(
  theme TEXT,
  story INTEGER REFERENCES stories,
  PRIMARY KEY (theme, story)
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




--NEED TO KNOW IF THE SINTAX IS RIGHT
CREATE TRIGGER likes_dislike AFTER INSERT ON likes
  When ((Select username, story_id from dislikes Where username = New.username AND story_id = NEW.story_id) NOT NULL) 
  BEGIN  Delete from dislikes where username = New.username AND story_id = NEW.story_id;
End;


INSERT INTO users Values("sheila1", "rosa@gmail.com", "c7021fedf66cbda549838f07647e3489ce85990e");
INSERT INTO users Values("sheila2", "pota@pota.com", "64fe28c207ce4605548a45b0230f71d97b45957b");
INSERT INTO users Values("Gansini", "carlosdcfgomes@hotmail.com","976358f0e93dec372cfae1d679ad9e48cfcc8845");
INSERT INTO stories Values(1,"Gansini", "A bela Faculdade", "É sempre top tar na feup", datetime('now'));
INSERT INTO stories Values(2,"Gansini", "Faculdade de Merda", "Mas isto às vezes chateia", datetime('now'));
INSERT INTO stories Values(3,"sheila1", "Dormir", "Eu devia estar mesmo a nanar a esta hora", datetime('now'));
INSERT INTO stories Values(4,"sheila2", "PUTA QUE PARIU ESTA MERDA", "FODACE CARALHO PQP", datetime('now'));
INSERT INTO comments Values(1, "sheila2", 1, "LOL, TAVA BEM SEM ESTA MERDA", datetime('now'));
INSERT INTO comments Values(2, "sheila1", 4, "same <3", datetime('now'));
INSERT INTO comments Values(4, "sheila1", 1, "Tava nada", datetime('now'));
INSERT Into comments Values(3, "Gansini", 2, "Nunca disse algo tão certo", datetime('now'));
INSERT INTO themes Values("School", 1);
INSERT INTO themes Values("Preguiça", 3);
Insert INTO themes Values("Palavrões", 4);