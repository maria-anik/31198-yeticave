CREATE DATABASE IF NOT EXISTS yeticave
  DEFAULT character SET utf8
  DEFAULT collate utf8_general_ci;

use yeticave;

CREATE TABLE lots_list (
  id int auto_increment PRIMARY KEY,
  title char(128),
  category_id tinyint unsigned,
  cost float,
  link char(128),
  img char(128),
  img_alt char(128),
  date_create DATETIME,
  date_end DATETIME
);

CREATE TABLE categories (
  id int auto_increment PRIMARY KEY,
  category char(128),
  title char(128)
);


CREATE TABLE user_list (
  id int auto_increment PRIMARY KEY,
  name char(128),
  login char(128),
  email char(128),
  password char(128)
);



CREATE TABLE bet_list (
  id int auto_increment PRIMARY KEY,
  lot_id int,
  user_id int,
  price int,
  ts DATETIME
);



