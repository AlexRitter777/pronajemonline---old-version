<!DOCTYPE html>
<html lang="cz">

<head>
    <?=$this->getMeta(); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/Validator.js"></script>
    <script src="js/validation.js"></script>

</head>

<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-logo">
                <div class="logo-items">
                    <h1 class="header-title">pronajemonline.cz</h1>
                    <h2 class="header-subtitle">Portal pronajmatele</h2>
                </div>
                <div class="logo-image">
                    <img src="img/keys.png" alt="keys" height="40px">
                </div>
            </div>
            <nav class="header-menu">
                <a class="nav_link" href="\">Home</a>
                <a class="nav_link" href="about">O projektu</a>
                <a class="nav_link" href="applications">Aplikace</a>
                <a class="nav_link" href="contact">Kontakt</a>
            </nav>
        </div>
    </header>

    <div class="content">
        <?= $content; ?>
    </div>

    <footer class="footer">
        <div class="footer-text">
            <div>Pronajemonline.cz</div>
            <div>2022</div>
        </div>
    </footer>

<script src="js/main.js"></script>
</body>
