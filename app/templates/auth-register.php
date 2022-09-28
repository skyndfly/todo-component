
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
    <h1>моиЗАМЕТКИ</h1>
</header>
<div class="flashes">
    <?=flash()->display();;?>
</div>
<section>
    <div class="section__content">


        <?=$this->section('content')?>
    </div>
</section>
</body>
</html>