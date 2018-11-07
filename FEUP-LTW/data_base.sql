CREATE TABLE user (
  username VARCHAR PRIMARY KEY,
  password VARCHAR NOT NULL
);

CREATE TABLE story (
  story_id INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL REFERENCES user,
  title TEXT NOT NULL, 
  body TEXT NOT NULL,
  hour DATE NOT NULL,
  likes INTEGER, 
  dislikes INTEGER
);

CREATE TABLE comment (
  comment_id INTEGER PRIMARY KEY,
  user_id VARCHAR NOT NULL REFERENCES user,
  story_id INTEGER NOT NULL REFERENCES story,
  body TEXT NOT NULL,
  hour DATE
);