<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/flex.css">
    <link rel="stylesheet" href="/css/response.css">
    <link rel="stylesheet" href="/css/video.css">
</head>
<body>
<div>
    <header class="header column-container">
        <div class="logo containerr row-container justify-content-end">
            <a href="/" class="mainpage"></a>
            <div class="column-container padding">
                <div class="row-container">
                    <div class="flex-1 social1"><a href="https://vk.com/evgeniyasmail"><img src="/images/icon/vk.png" alt="Вконтакте"></a></div>
                    <div class="flex-1 social2"><a href="https://www.instagram.com/ulybka1/"><img src="/images/icon/instagram.png" alt="Вконтакте"></a></div>
                </div>
                <div class="header-right flex-1">
                    <h3>контактный телефон</h3>
                    <p>+7 911 268-35-94</p>
                    <?php if ($_SESSION['auth']){
                        echo "<div class='hello'>Привет ".$_SESSION['name']."</div><a href='/logout'>Выйти</a>";
                    }
                    else{
                        echo "<span class=\"sign\"><a href=\"#openModal\">Авторизация</a></span>";
                        //echo "<span class=\"sign\"><a href=\"/account\">Регистрация</a></span>";
                    }
                    ?>
                    <div id="openModal" class="modalw">
                        <div class="modalw-dialog">
                            <div class="modalw-content">
                                <div class="modalw-header">
                                    <h3 class="modalw-title"></h3>
                                    <a href="#close" title="Close" class="close">×</a>
                                </div>
                                <div class="modalw-body">
                                    <form action="/account/auth" method="post">
                                        <fieldset>
                                            <legend>Введите логин и пароль</legend>
                                            <div id="response"></div>
                                            <div>
                                                <label for="login"></label>
                                                <input id="login" name="email" type="text" placeholder="login">
                                            </div>
                                            <div>
                                                <label for="pwd"></label>
                                                <input id="pwd" name="password" type="password" placeholder="password">
                                            </div>
                                            <div>
                                                <input type="submit" value="Отправить">
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu">
            <ul>
                <li class="icon"><a id="menu" href="#">&#9776;</a></li>
            </ul>
        </div>
        <nav class="menu show container-fluid row-container">
            <ul>
                <li class="menuall"><a href="/about">О нас</a></li>
                <li class="menuall"><a href="/characters">Персонажи</a>
                    <?php if($_SESSION['admin']){
                        echo "<ul>
                                <li class=\"menuall\"><a href=\"/charactersAdd\">Добавить персонажа</a></li>                                
                              </ul>";
                    }/*else{
                        echo "<ul>
                                <li class=\"menuall\"><a href=\"/characters\">мужские</a></li>
                                <li class=\"menuall\"><a href=\"/characters\">женские</a></li>
                              </ul>";
                    }
                    */?>
                </li>
                <li class="menuall"><a href="/show">Шоу-программы</a>
                    <?php if($_SESSION['admin']){
                        echo "<ul>
                                <li class=\"menuall\"><a href=\"/showadd\">Добавить ШОУ</a></li>                                
                              </ul></li>";}
                              else
                              {echo'</li>';}
                    ?>
                <li class="menuall"><a href="/video">Наше видео</a>
                    <?php if($_SESSION['admin']){
                        echo "<ul>
                                <li class=\"menuall\"><a href=\"/videoadd\">Добавить видео</a></li>                                
                              </ul></li>";}
                    else
                    {echo'</li>';}
                    ?>
                <li class="menuall"><a href="/comment">Отзывы</a></li>
                <li class="menuall"><a href="#">Заказ праздника</a></li>
            </ul>
        </nav>
    </header>
<div>
    <?php
        include_once $view;
    ?>
</div>

        <footer class="footer">
            <div class="contacts">
                Наш телефон
                7 911 268-35-94
                <a href="https://vk.com/evgeniyasmail"><img src="/images/icon/vk.png" alt="Вконтакте"  title="Вконтакте"></a>
                <a href="https://www.instagram.com/ulybka1/"><img src="/images/icon/instagram.png" alt="Инстаграм"  title="Инстаграм"></a>
                <a href="http://spbanimator.ru"><img src="/images/icon/logo2min.png" alt="Сайт агентства праздников Улыбка" title="Агентство праздников улыбка"></a>
            </div>
            <div class="copyright">2019 © "УЛЫБКА" Организация праздников и Шоу, аниматоры</div>
        </footer>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/script.js"></script>
<script src="/js/sendForm.js"></script>
<script src="https://feedback.kupiapp.ru/widget/widget.js" type="text/javascript"></script>
<script type="text/javascript">document.addEventListener("DOMContentLoaded", feedback_vk.init({id:'feedback_vk', gid:130128382}));</script>
</body>
</html>