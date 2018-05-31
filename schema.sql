CREATE DATABASE IF NOT EXISTS yeticave
  DEFAULT character SET utf8
  DEFAULT collate utf8_general_ci;

use yeticave;

CREATE TABLE lots_list (
  id int auto_increment PRIMARY KEY,
  title varchar(255),
  category_id int unsigned,
  description text,
  user_id int unsigned,
  cost float,
  step int unsigned,
  img varchar(255),
  img_alt varchar(255),
  date_create DATETIME,
  date_end DATETIME,
  user_win int unsigned
);

CREATE INDEX lot_title_key ON lots_list (title);
CREATE INDEX lot_date_create_key ON lots_list (date_create);
CREATE INDEX lot_date_end_key ON lots_list (date_end);
CREATE INDEX lot_cat_id ON lots_list (category_id);
CREATE INDEX lot_user_id ON lots_list (user_id);
CREATE FULLTEXT INDEX lot_ft_search ON lots_list(title, description);

CREATE TABLE categories (
  id int auto_increment PRIMARY KEY,
  category varchar(255),
  title varchar(255)
);
CREATE INDEX category_key ON categories (category);


CREATE TABLE user_list (
  id int auto_increment PRIMARY KEY,
  name varchar(255),
  email varchar(255),
  about text,
  password varchar(255),
  img  varchar(255)
);
CREATE INDEX user_pass ON user_list (password);
CREATE INDEX user_email ON user_list (email);



CREATE TABLE bet_list (
  id int auto_increment PRIMARY KEY,
  lot_id int,
  user_id int,
  price int,
  ts DATETIME
);
CREATE INDEX bet_ts_key ON bet_list (ts);
CREATE INDEX bet_lot_id ON bet_list (lot_id);
CREATE INDEX bet_user_id ON bet_list (user_id);



