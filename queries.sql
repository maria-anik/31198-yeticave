INSERT INTO lots_list (title, category_id, cost, link, img, img_alt, date_create, date_end)
  VALUES ('2014 Rossignol District Snowboard', 1, 10999.01, 'lot.html', 'img/lot-1.jpg', 'Сноуборд', '2018-05-01 04:25:36', '2018-05-15 04:25:36'),
         ('DC Ply Mens 2016/2017 Snowboard', 1, 159999, 'lot.html', 'img/lot-2.jpg', 'Сноуборд', '2018-05-01 04:25:36', '2018-05-12 04:26:36'),
         ('Крепления Union Contact Pro 2015 года размер L/XL', 2, 8000, 'lot.html', 'img/lot-3.jpg', 'Крепления L/XL', '2018-05-01 04:27:36', '2018-05-10 04:25:36'),
         ('Ботинки для сноуборда DC Mutiny Charocal', 3, 10999, 'lot.html', 'img/lot-4.jpg', 'Ботинки для сноуборда', '2018-05-01 04:28:36', '2018-05-07 04:25:36'),
         ('Куртка для сноуборда DC Mutiny Charocal', 4, 7500, 'lot.html', 'img/lot-5.jpg', 'Куртка для сноуборда', '2018-05-01 04:29:36', '2018-05-01 04:25:36'),
         ('Маска Oakley Canopy', 6, 5400, 'lot.html', 'img/lot-6.jpg', 'Маска для сноуборда', '2018-05-01 04:30:36', '2018-05-01 04:25:36');


INSERT INTO categories (category, title)
  VALUES ('boards', 'Доски и лыжи'),
         ('attachment', 'Крепления'),
         ('boots', 'Ботинки'),
         ('clothing', 'Одежда'),
         ('tools', 'Инструменты'),
         ('other', 'Разное');


INSERT INTO user_list (name, login, email, password)
  VALUES ('Иван', 'ivan', 'ivan@mail.ru', 'ivan'),
         ('Константин', 'konstantin', 'konstantin@mail.ru', 'konstantin'),
         ('Евгений', 'evgeniy', 'evgeniy@mail.ru', 'evgeniy'),
         ('Семён', 'semen', 'semen@mail.ru', 'semen');


INSERT INTO bet_list (lot_id, user_id, price, ts)
  VALUES (1, 1, 11500, '2018-05-07 20:40:59'),
         (1, 2, 11000, '2018-05-07 21:40:59'),
         (1, 3, 10500, '2018-05-07 21:20:59'),
         (1, 4, 10000, '2018-05-07 21:40:59'),
         (2, 1, 10500, '2018-05-08 20:40:59'),
         (4, 1, 4500, '2018-05-04 20:40:59');




SELECT title, cost FROM lots_list;
SELECT category, title FROM categories;

/*Запрос для поиска всех лотов с выводом названия категории из таблицы категорий*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category=c.id;
/*Запрос для поиска всех лотов в указанной категории*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category=c.id WHERE c.title='Доски и лыжи';
/*Запрос для поиска по подстроке названия лота*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category=c.id WHERE l.title like '%для%';

/*Запрос для поиска ставок конкретного человека*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category=c.id  WHERE us.name = 'Иван';

/*Запрос для поиска ставок конкретного лота*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category=c.id  WHERE l.title = '2014 Rossignol District Snowboard';

/*Запрос для поиска ставок конкретного лота*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category=c.id;

/*отсортировать лоты в порядке создания и вывести еще открытые лоты */
select title, cost, img, date_create, date_end, now()  from lots_list order by date_create where CONVERT(datetime, date_end, 121) > now();

/*Количество ставок на конкретном лоте*/
select count(*) from bet_list where lot_id=1;


/*обновить название лота по id*/
UPDATE lots_list SET title='2018 Rossignol District Snowboard' WHERE id=1;

/*получить список самых свежих ставок для лота по его идентификатору ???????????*/
SELECT name, price, l.title, ts from bet_list b JOIN user_list us on b.user_id=us.id JOIN lots_list l on b.lot_id=l.id where lot_id=1 ORDER BY ts DESC;

SELECT title, cost, img, date_create, count(b.lot) as cout_bet FROM lots_list l GROUP BY bet_list b ORDER BY cost;
