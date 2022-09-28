
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->e($title)?></title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>

    <div class="header__link">
        <div>
            <h1>моиЗАМЕТКИ</h1>
            <a href="/">Главная страница</a>
            <a href="/about">О сайте</a>
        </div>
        <div>
            <a href="/user-page"><?=$this->e($login)?></a>
            <a href="/logout" class="">Выйти</a>
        </div>
    </div>
</header>
<div class="flashes">
    <?=flash()->display();;?>
</div>
<section>
    <div class="section__content">
        <form action="index.php" class="index__form" method="post">
            <input type="text" name="search">
            <button name="send" type="submit">Поиск</button>
        </form>

        <?=$this->section('content')?>
    </div>
</section>
</body>
</html>