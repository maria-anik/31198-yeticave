
<nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($categories as $category) {?>
        <li class="nav__item">
          <a href="category.php?category=<?= $category['category']?>"><?= $category["title"] ?></a>
        </li>
      <?};?>
    </ul>
</nav>
<section class="lot-item container">
    <p>Сори, 404</p>
    <a href="index.php">Главная страница</a>
</section>
