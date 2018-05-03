<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';


// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

// навигация

$categories = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное',
];


// Список лотов

$lots_list = [
    [
        'title' => '2014 Rossignol District Snowboard ',
        'category' => $categories['boards'],
        'cost' => 10999.01,
        'link' => 'lot.html',
        'img' => 'img/lot-1.jpg',
        'img_alt' => 'Сноуборд'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => $categories['boards'],
        'cost' => 159999,
        'link' => 'lot.html',
        'img' => 'img/lot-2.jpg',
        'img_alt' => 'Сноуборд'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => $categories['attachment'],
        'cost' => 8000,
        'link' => 'lot.html',
        'img' => 'img/lot-3.jpg',
        'img_alt' => 'Крепления L/XL'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => $categories['boots'],
        'cost' => 10999,
        'link' => 'lot.html',
        'img' => 'img/lot-4.jpg',
        'img_alt' => 'Ботинки для сноуборда'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => $categories['clothing'],
        'cost' => 7500,
        'link' => 'lot.html',
        'img' => 'img/lot-5.jpg',
        'img_alt' => 'Куртка для сноуборда'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => $categories['other'],
        'cost' => 5400,
        'link' => 'lot.html',
        'img' => 'img/lot-6.jpg',
        'img_alt' => 'Маска для сноуборда'
    ]
];
