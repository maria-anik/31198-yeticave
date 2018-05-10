CREATE DATABASE IF NOT EXISTS yeticave
  DEFAULT character SET utf8
  DEFAULT collate utf8_general_ci;

use yeticave;

CREATE TABLE lots_list (
  id int auto_increment PRIMARY KEY,
  title varchar(255),
  category_id int unsigned,
  cost float,
  link varchar(255),
  img varchar(255),
  img_alt varchar(255),
  date_create DATETIME,
  date_end DATETIME
);

CREATE INDEX lot_title_key ON lots_list (title);
CREATE INDEX lot_date_create_key ON lots_list (date_create);
CREATE INDEX lot_date_end_key ON lots_list (date_end);

CREATE TABLE categories (
  id int auto_increment PRIMARY KEY,
  category varchar(255),
  title varchar(255)
);
CREATE INDEX category_key ON categories (category);


CREATE TABLE user_list (
  id int auto_increment PRIMARY KEY,
  name varchar(255),
  login varchar(255),
  email varchar(255),
  password varchar(255)
);



CREATE TABLE bet_list (
  id int auto_increment PRIMARY KEY,
  lot_id int,
  user_id int,
  price int,
  ts DATETIME
);
CREATE INDEX bet_ts_key ON bet_list (ts);



