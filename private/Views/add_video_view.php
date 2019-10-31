<?php if (!$_SESSION['admin']){
    header('Location: /');
    exit();
};?>
<div class="add_video">
    <form id="videoAddForm" action="/videoadd" enctype="multipart/form-data" method="post" >
        <fieldset>
            <legend>Добавление ссылки на видео из контакта</legend>
            <div>
                <label for="videoName">Введите название персонажа</label><br>
                <input id="videoName" name="videoName" type="text" placeholder="Название видео" size="60" required>
            </div>
            <div>
                <label for="videoLink">Укажите ссылку на видео из контакта</label><br>
                <textarea id="videoLink" name="videoLink" rows="10" cols="55" placeholder="Ссылка на видео из контакта" ></textarea>
            </div>
            <div id="response2"></div>
            <div>
                <input type="submit" value="отправить">
            </div>
        </fieldset>
    </form>
    <a href="/">На главную</a>
</div>