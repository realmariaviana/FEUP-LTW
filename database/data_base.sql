CREATE TABLE user (
  username VARCHAR PRIMARY KEY,
  email VARCHAR UNIQUE,
  password VARCHAR NOT NULL
);

CREATE TABLE story (
  story_id INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL REFERENCES user,
  title TEXT NOT NULL, 
  body TEXT NOT NULL,
  hour DATE NOT NULL,
);

CREATE TABLE comment (
  comment_id INTEGER PRIMARY KEY,
  user_id VARCHAR NOT NULL REFERENCES user,
  story_id INTEGER NOT NULL REFERENCES story,
  body TEXT NOT NULL,
  hour DATE
);

CREATE TABLE likes(
  story_id INTEGER REFERENCES story,
  username VARCHAR REFERENCES user,

    PRIMARY KEY (story_id, username)
);

CREATE dislikes(
  
  story_id INTEGER REFERENCES story,
  username VARCHAR REFERENCES user,
  PRIMARY KEY (story_id, username)
);


--NEED TO KNOW IF THE SINTAX IS RIGHT
CREATE likes_dislike AFTER INSERT ON likes
BEGIN 
  When((Select username, story_id from dislikes Where username = New.username, story_id = NEW.story_id) NOT NULL )
  THEN Delete from dislikes where username = New.username AND story_id = NEW.story_id
End;
END;


INSERT INTO username Values("Inês Marques", "rosa@gmail.com", "lagrosinha");
INSERT INTO username Values("Maria Viana", "pota@pota.com" "distraida");
INSERT INTO username Values("Gansini", "carlosdcfgomes@hotmail.com","parolini");
INSERT INTO story Values("Gansini", "A bela Faculdade", "É sempre top tar na feup");
INSERT INTO story Values("Gansini", "Faculdade de Merda", "Mas isto às vezes chateia");
INSERT INTO story Values("Inês Marques", "Dormir", "Eu devia estar mesmo a nanar a esta hora");
INSERT INTO story Values("Maria Viana", "PUTA QUE PARIU ESTA MERDA", "FODACE CARALHO PQP");
INSERT INTO comment Values("Maria Viana", "A bela Faculdade", "LOL, TAVA BEM SEM ESTA MERDA");
INSERT INTO comment Values("Inês Marques", "PUTA QUE PARIU ESTA MERDA", "same <3");
INSERT Into comment Values("Gansini", "Faculdade de Merda", "Nunca disse algo tão certo");
