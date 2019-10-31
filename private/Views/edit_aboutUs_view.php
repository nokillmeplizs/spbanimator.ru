<?php if (!$_SESSION['admin']){
    header('Location: /');
    exit();
};?>
<div class="add_character">
    <form action="/aboutUs/edit" enctype="multipart/form-data" method="post">
        <fieldset>
            <legend><?=$data['title']; ?></legend>
            <div>
                <label for="title">Введите заголовок</label><br>
                <textarea id="title" name="title"  rows="1" cols="30"placeholder="Введите заголовок" ><?=$data[0]['title'] ?></textarea>
            </div>
            <div>
                <label for="aboutInfoText">Напишите клевый текст на главной странице</label><br>
                <textarea id="aboutInfoText" name="aboutInfoText" rows="15" cols="55" placeholder="текст" ><?=$data[0]['text'] ?></textarea>
            </div>
            <p>Нажмите обзор, и выберите Фото партнера, если хотите её добавить или заменить</p>
            <div>
                <img src="/images/partner/<?=$data[0]['picname'] ?>" alt="" width="300px"><input type="file" name="photo[]" multiple accept="image/*">
            </div>
            <h3>Настройки для СЕО</h3>
            <div>
                <label for="title_page">Title</label><br>
                <input id="title_page" name="title_page" type="text" value="<?=$data[0]['title_page'] ?>" placeholder="Название страницы" style="text-align:center;">
            </div>
            <div>
                <label for="description">Description</label><br>
                <textarea class="seoText" id="description" name="description"  placeholder="Описание страницы" rows="5" cols="55" ><?=$data[0]['description'] ?></textarea>
            </div>
            <div>
                <label for="keywords">Keywords</label><br>
                <textarea class="seoText" id="keywords" name="keywords" placeholder="Ключевые слова"  rows="3" cols="55" ><?=$data[0]['keywords'] ?></textarea>
            </div>
            <div id="response2"></div>
            <div>
                <input type="submit" value="Сохранить изменения">
            </div>
        </fieldset>
    </form>
    </div>
    <div><a href="/">На главную</a></div>
</div>