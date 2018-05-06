create database yeticave
  default character set utf8
  default collate utf8_general_ci;

use yeticave;

create table lots_list (
  id int auto_increment primary key,
  title char(128),
  category tinyint,
  cost double,
  link char(128),
  img char(128),
  img_alt char(128)
);

insert into lots_list set
  title = '2014 Rossignol District Snowboard',
  category = 1,
  cost = 10999.01,
  link = 'lot.html',
  img = 'img/lot-1.jpg',
  img_alt = 'Сноуборд';

insert into lots_list set
  title = 'DC Ply Mens 2016/2017 Snowboard',
  category = 1,
  cost = 159999,
  link = 'lot.html',
  img = 'img/lot-2.jpg',
  img_alt = 'Сноуборд';

insert into lots_list set
  title = 'Крепления Union Contact Pro 2015 года размер L/XL',
  category = 2,
  cost = 8000,
  link = 'lot.html',
  img = 'img/lot-3.jpg',
  img_alt = 'Крепления L/XL';

insert into lots_list set
  title = 'Ботинки для сноуборда DC Mutiny Charocal',
  category = 3,
  cost = 10999,
  link = 'lot.html',
  img = 'img/lot-4.jpg',
  img_alt = 'Ботинки для сноуборда';

insert into lots_list set
  title = 'Куртка для сноуборда DC Mutiny Charocal',
  category = 4,
  cost = 7500,
  link = 'lot.html',
  img = 'img/lot-5.jpg',
  img_alt = 'Куртка для сноуборда';

insert into lots_list set
  title = 'Маска Oakley Canopy',
  category = 6,
  cost = 5400,
  link = 'lot.html',
  img = 'img/lot-6.jpg',
  img_alt = 'Маска для сноуборда';



create table categories (
  id int auto_increment primary key,
  category char(128),
  title char(128)
);

insert into categories set
  category = 'boards',
  title = 'Доски и лыжи';

insert into categories set
  category = 'attachment',
  title = 'Крепления';

insert into categories set
  category = 'boards',
  title = 'Ботинки';

insert into categories set
  category = 'clothing',
  title = 'Одежда';

insert into categories set
  category = 'tools',
  title = 'Инструменты';

insert into categories set
  category = 'other',
  title = 'Разное';

create table user_list (
  id int auto_increment primary key,
  name char(128),
  login char(128),
  email char(128),
  password char(128)
);

insert into user_list set
  name = 'Иван',
  login = 'ivan',
  email = 'ivan@mail.ru',
  password = 'ivan';


insert into user_list set
  name = 'Константин',
  login = 'konstantin',
  email = 'konstantin@mail.ru',
  password = 'konstantin';

insert into user_list set
  name = 'Евгений',
  login = 'evgeniy',
  email = 'ivan@mail.ru',
  password = 'ivan';

insert into user_list set
  name = 'Семён',
  login = 'semen',
  email = 'semen@mail.ru',
  password = 'semen';

create table bet_list (
  id int auto_increment primary key,
  lot int,
  user_name int,
  price int,
  ts char(128)
);

insert into bet_list set
  lot = 1,
  user_name = 1,
  price = '11500',
  ts = '07.05.2018 20:40:59';

insert into bet_list set
  lot = 1,
  user_name = 2,
  price = '11000',
  ts = '07.05.2018 21:00:59';

insert into bet_list set
  lot = 1,
  user_name = 3,
  price = '10500',
  ts = '07.05.2018 21:20:59';

insert into bet_list set
  lot = 1,
  user_name = 4,
  price = '10000',
  ts = '07.05.2018 21:40:59';

insert into bet_list set
  lot = 2,
  user_name = 1,
  price = '10500',
  ts = '04.05.2018 20:40:59';


insert into bet_list set
  lot = 4,
  user_name = 1,
  price = '4500',
  ts = '04.05.2018 20:40:59';

select title, cost from lots_list;
select category, title from categories;

/*Запрос для поиска всех лотов с выводом названия категории из таблицы категорий*/
select  l.title, c.title, cost, img from lots_list l join categories c on l.category=c.id;
/*Запрос для поиска всех лотов в указанной категории*/
select  l.title, c.title, cost, img from lots_list l join categories c on l.category=c.id where c.title='Доски и лыжи';
/*Запрос для поиска по подстроке названия лота*/
select  l.title, c.title, cost, img from lots_list l join categories c on l.category=c.id where l.title like '%для%';

/*Запрос для поиска ставок конкретного человека*/
select  us.name, l.title, c.title, price, img , ts from lots_list l join bet_list b on l.id=b.lot  join user_list us on b.user_name=us.id  join categories c on l.category=c.id  where us.name = 'Иван';

/*Запрос для поиска ставок конкретного лота*/
select  us.name, l.title, c.title, price, img , ts from lots_list l join bet_list b on l.id=b.lot  join user_list us on b.user_name=us.id  join categories c on l.category=c.id  where l.title = '2014 Rossignol District Snowboard';

/*Запрос для поиска ставок конкретного лота*/
select  us.name, l.title, c.title, price, img , ts from lots_list l join bet_list b on l.id=b.lot  join user_list us on b.user_name=us.id  join categories c on l.category=c.id;
