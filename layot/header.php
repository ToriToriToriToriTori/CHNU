<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Графік електропостачання</title>
    <link rel="icon" type="image/x-icon" href="/sourse/images.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/news.css">
    <link rel="stylesheet" href="./styles/tables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <div class="wrapper">

        <header>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.php?action=mainpage">Головна</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=newspage">Новини</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=graphicpage">Графіки</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Поділ по змінах</a>
                </li>
                <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) { ?>
                  <li class="nav-item">
                  <a class="nav-link" href="index.php?action=login">Увійти</a>
                  </li>

                <?php } else { ?>

                  <li class="nav-item">
                  <a class="nav-link" href="index.php?action=graphicediting">+</a>
                  </li>
                  
                  <li class="nav-item">
                  <a class="nav-link" href="index.php?action=logout">Вийти</a>
                  </li>

                <?php } ?>
                
              </ul>
        </header>