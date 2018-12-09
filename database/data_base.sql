drop TABLE if exists users;
drop TABLE if exists stories;
drop TABLE if exists comments;
drop TABLE if exists likes;
drop TABLE if exists dislikes;
drop TABLE if exists likes_c;
drop TABLE if exists dislikes_c;
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
  hour DATETIME NOT NULL,
  UNIQUE(username, title, body)
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



CREATE TABLE likes_c(
  comment_id INTEGER REFERENCES comments,
  username VARCHAR REFERENCES users,
  PRIMARY KEY (comment_id, username)
);

CREATE TABLE dislikes_c(
  comment_id INTEGER REFERENCES comments,
  username VARCHAR REFERENCES users,
  PRIMARY KEY (comment_id, username)
);



CREATE TRIGGER likesTodislike AFTER INSERT ON likes
  When ((Select COUNT(story_id) from dislikes Where dislikes.username = New.username AND story_id = NEW.story_id) != 0) 
  BEGIN  Delete from dislikes where dislikes.username = New.username AND dislikes.story_id = NEW.story_id;
End;

 CREATE TRIGGER dislikesTolikes AFTER INSERT ON dislikes
  When ((Select Count(story_id) from likes Where likes.username = New.username AND likes.story_id = NEW.story_id) != 0) 
  BEGIN  Delete from likes where likes.username = New.username AND likes.story_id = NEW.story_id;
End;



CREATE TRIGGER likesTodislikeC AFTER INSERT ON likes_c
  When ((Select COUNT(comment_id) from dislikes_c Where dislikes_c.username = New.username AND comment_id = NEW.comment_id) != 0) 
  BEGIN  Delete from dislikes_c where dislikes_c.username = New.username AND dislikes_c.comment_id = NEW.comment_id;
End;

 CREATE TRIGGER dislikesTolikesC AFTER INSERT ON dislikes_c
  When ((Select Count(comment_id) from likes_c Where likes_c.username = New.username AND likes_c.comment_id = NEW.comment_id) != 0) 
  BEGIN  Delete from likes_c where likes_c.username = New.username AND likes_c.comment_id = NEW.comment_id;
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

INSERT INTO likes VALUES(1,"sheila1");


INSERT INTO likes_c VALUES(1,"sheila1");