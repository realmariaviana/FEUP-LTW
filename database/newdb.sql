drop TABLE if exists users;
drop TABLE if exists stories;
drop TABLE if exists comments;
drop TABLE if exists likes;
drop TABLE if exists dislikes;
drop TABLE if exists entities;
drop TABLE if exists entityThemes;
drop TABLE if exists themes;


/**
*tables
*/
CREATE TABLE entities (
    entity_id INTEGER PRIMARY KEY
);

CREATE TABLE users(
  username VARCHAR PRIMARY KEY,
  email VARCHAR UNIQUE,
  password VARCHAR(254) NOT NULL,
  salt VARCHAR(32) NOT NULL,
  birthday DATE,
  img VARCHAR
);

CREATE TABLE stories(
  entity_id INTEGER PRIMARY KEY REFERENCES entities,
  username VARCHAR NOT NULL REFERENCES users,
  title TEXT NOT NULL, 
  body TEXT NOT NULL,
  hour DATETIME NOT NULL,
  UNIQUE(username, title, body)
);

CREATE TABLE comments (
  entity_id INTEGER REFERENCES entities,
  story_id INTEGER REFERENCES stories,
  username VARCHAR NOT NULL REFERENCES users,
  body TEXT NOT NULL,
  hour DATETIME,
  PRIMARY KEY (entity_id, story_id)
);


CREATE TABLE likes(
    entity_id INTEGER REFERENCES entities,
    username VARCHAR REFERENCES users,
    PRIMARY KEY(entity_id, username)
);

CREATE TABLE dislikes(
    entity_id INTEGER REFERENCES entities,
    username VARCHAR REFERENCES users,
    PRIMARY KEY(entity_id, username)
);

CREATE TABLE entityThemes(
    entity_id INTEGER REFERENCES entities,
    theme VARCHAR REFERENCES themes,
    PRIMARY KEY(entity_id, theme)
);

CREATE TABLE themes(
    theme VARCHAR PRIMARY KEY
);


/**
*triggers
*/
CREATE TRIGGER likesTodislike AFTER INSERT ON likes
  When ((Select entity_id from dislikes Where dislikes.username = New.username AND dislikes.entity_id = NEW.entity_id) NOT NULL) 
  BEGIN  Delete from dislikes where dislikes.username = New.username AND dislikes.entity_id = NEW.entity_id;
End;

 CREATE TRIGGER dislikesTolikes AFTER INSERT ON dislikes
  When ((Select entity_id from likes Where likes.username = New.username AND likes.entity_id = NEW.entity_id) NOT NULL) 
  BEGIN  Delete from likes where likes.username = New.username AND likes.entity_id = NEW.entity_id;
End;

CREATE TRIGGER IF NOT EXISTS updateNameStories AFTER UPDATE ON users
    WHEN(new.username != old.username)
    Begin UPDATE stories SET username = New.username
     WHERE stories.username = old.username;
    END;

CREATE TRIGGER IF NOT EXISTS updateNameComments AFTER UPDATE ON users
    WHEN(new.username != old.username)
    Begin UPDATE comments SET username = New.username
     WHERE comments.username = old.username;
    END;
  