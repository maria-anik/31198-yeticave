INSERT INTO lots_list (title, category_id, user_id, cost, step, img, img_alt, date_create, date_end, description)
  VALUES ("2014 Rossignol District Snowboard", 1, 4, 10999.01, 10, "img/lot-1.jpg", "Сноуборд", "2018-05-01 04:25:36", "2018-06-01 04:25:36", "Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным."),
         ("DC Ply Mens 2016/2017 Snowboard", 1,2, 159999, 1000,"img/lot-2.jpg", "Сноуборд", "2018-05-01 04:25:36", "2018-05-25 04:26:36", "Самый лучший товар"),
         ("Крепления Union Contact Pro 2015 года размер L/XL", 2,1, 8000, 140,"img/lot-3.jpg", "Крепления L/XL", "2018-05-07 04:27:36", "2018-05-27 04:25:36", "Самый лучший товар"),
         ("Ботинки для сноуборда DC Mutiny Charocal", 3,2, 10999, 105,"img/lot-4.jpg", "Ботинки для сноуборда", "2018-05-01 04:28:36", "2018-06-07 04:25:36", "Самый лучший товар"),
         ("Куртка для сноуборда DC Mutiny Charocal", 4,4, 7500, 190,"img/lot-5.jpg", "Куртка для сноуборда", "2018-05-01 04:29:36", "2018-07-01 04:25:36", "Самый лучший товар"),
         ("Маска Oakley Canopy", 6,4, 5400, 100,"img/lot-6.jpg", "Маска для сноуборда", "2018-05-01 04:30:36", "2018-06-10 04:25:36", "Самый лучший товар");

INSERT INTO lots_list (title, category_id, user_id, cost, step, img, img_alt, date_create, date_end, description) VALUES
          ("Горнолыжные ботинки Salomon Divine 4", 3,4, 5400, 100,"img/boots.png", "Ботинки для сноуборда", "2018-05-01 04:30:36", "2018-05-10 04:25:36", "Горнолыжные ботинки Salomon Divine 4 – это спортивные ботинки с использованием технологии Advanced Shell для придания точности и супершироким ботинком Sensifit, обеспечивающими простоту надевания. 4 титановые клипсы с микрорегулировкой для точной подгонки ботинка по ноге. Регулировку можно осуществлять без дополнительных инструментов. Съёмные накладки подошвы можно заменить по мере износа. Внутренний ботинок X Fit Fusion Active - зона сцепления в центре подошвы гарантирует дополнительное сцепление при ходьбе по камням, снегу. Жесткие секции в мыске и пятке обеспечивают поддержку и передачу энергии для точности и чувствительности.");


INSERT INTO categories (category, title)
  VALUES ("boards", "Доски и лыжи"),
         ("attachment", "Крепления"),
         ("boots", "Ботинки"),
         ("clothing", "Одежда"),
         ("tools", "Инструменты"),
         ("other", "Разное");


INSERT INTO user_list (name, email, password, about, img)
  VALUES ("Иван", "ivan@mail.ru", "ivan", "Любимый сын мамы, телефон +7 925 8446852, звонить после 15:00", "user_img/user_img.jpg"),
         ("Константин", "konstantin@mail.ru", "konstantin", "Купите мой товар, телефон +7 932 16587953, не звонить", "user_img/user_img.jpg"),
         ("Евгений", "evgeniy@mail.ru", "evgeniy", "емейл evgeniy@mail.ru пишите туда", "user_img/user_img.jpg"),
         ("Семён", "semen@mail.ru", "semen", "домашний телефон 856 74 85, всегда на связи", "user_img/user_img.jpg");


INSERT INTO bet_list (lot_id, user_id, price, ts)
  VALUES (1, 1, 11000, "2018-05-07 20:40:59"),
         (1, 2, 11500, "2018-05-07 21:40:59"),
         (1, 3, 12500, "2018-05-07 21:45:59"),
         (2, 4, 159999, "2018-05-07 21:40:59"),
         (2, 1, 160999, "2018-05-08 20:40:59"),
         (4, 1, 10999, "2018-05-04 20:40:59");


SELECT title, cost FROM lots_list;
SELECT category, title FROM categories;
/*Запрос для поиска всех лотов с выводом названия категории из таблицы категорий*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id;
/*Запрос для поиска всех лотов в указанной категории*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE c.title="Ботинки";
/*Запрос для поиска по подстроке названия лота*/
SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.title like "%для%";

/*Запрос для поиска ставок конкретного человека*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot_id  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category_id=c.id  WHERE us.name = "Иван";

/*Запрос для поиска ставок конкретного лота*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot_id  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category_id=c.id  WHERE l.title = "2014 Rossignol District Snowboard";

/*Запрос для поиска ставок конкретного лота*/
SELECT  us.name, l.title, c.title, price, img , ts FROM lots_list l JOIN bet_list b ON l.id=b.lot_id  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category_id=c.id;

/*отсортировать лоты в порядке создания и вывести еще открытые лоты */
select title, cost, img, date_create, date_end, now()  from lots_list where date_end > now() order by date_create;

/*Количество ставок на конкретном лоте*/
select count(*) from bet_list where lot_id=1;

INSERT INTO bet_list (lot_id, user_id, price, ts) VALUES
          (9, 1, 6000, "2018-05-01 04:25:36" );



/*обновить название лота по id*/
UPDATE lots_list SET description="Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег
          мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд
          отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер
          позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто
          посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным." WHERE id=1;

/*лоты конкретного человека*/
SELECT l.title AS lot_name, c.title AS cat_name, l.img, price, ts FROM lots_list l JOIN user_list us ON l.user_id=us.id  JOIN categories c ON l.category_id=c.id WHERE l.user_id = 1 ORDER BY ts;

SELECT l.id, l.title , c.title as category_name, category, date_end, cost, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.user_id = 1 ORDER BY date_end DESC
