<?php if (!$_SESSION['admin']){
    header('Location: /');
    exit();
};?>
<div class="add_character">
        <form action="/showsUpdate/<?=$data['id']?>" enctype="multipart/form-data" method="post">
    <fieldset>
        <legend><?=$data['title']; ?></legend>
        <div>
            <label for="title">Введите название шоу</label><br>
            <textarea id="title" name="title"  rows="1" cols="40"placeholder="Название шоу" required><?=$show[0]['title'] ?></textarea>
        </div>
        <div>
            <label for="price">Укажите стоимость персонажа</label><br>
            <textarea id="price" name="price"  rows="1" cols="30"placeholder="Стоимость" ><?=$price[0]['price'] ?></textarea>
        </div>
        <div>
            <label for="character_text"></label>
            <textarea id="character_text" name="show_text" rows="15" cols="55" placeholder="Описание шоу" ><?=$show[0]['show_info'] ?></textarea>
        </div>
        <p>Нажмите обзор, и выберите другую фотографию, если хотите её заменить</p>
        <div>
            <img src="/images/shows/<?=$show[0]['picname'] ?>" alt="" width="300px"><input type="file" name="photo[]" multiple accept="image/*">
        </div>
        <p>Загрузите дополнительные фото шоу</p>
        <?php
        foreach($data['photos'] as $photo){?>
        <div><img src="/images/shows/<?php echo $photo;?>" alt="photos" width="300px" class="img-fluid">
            <?php };
            ?>
        </div>
        <div><input type="file" name="photos[]" multiple accept="image/*"></div>
        <br>
        <div><img src="images/seo-cat2.png" alt="Расскажите мне о СЕО"> </div>
        <div>
            <label for="title_page"></label>
            <input id="title_page" name="title_page" type="text" value="<?=$show[0]['title_page'] ?>" size="60" placeholder="Название страницы" style="text-align:center;">
        </div>
        <div>
            <label for="description"></label>
            <textarea class="seoText" id="description" name="description"  placeholder="Описание страницы" ><?=$show[0]['description'] ?></textarea>
        </div>
        <div>
            <label for="keywords"></label>
            <textarea class="seoText" id="keywords" name="keywords" placeholder="Ключевые слова"><?=$show[0]['keywords'] ?></textarea>
        </div>
        <div id="response2"></div>
        <div>
        <div>
            <input type="submit" value="Сохранить изменения">
        </div>
    </fieldset>
</form>
    <?php
    foreach($data['photos'] as $photo){?>
    <div><img src="/images/shows/<?php echo $photo;?>" alt="photos" width="300px" class="img-fluid">
        <div class="delete_button">
            <form action="/showmultPhotoDelete/1" method="post">
                <input type="hidden" name="DeletePhoto" value="<?=$photo;?>">
                <input type="submit"  value="Удалить" onClick="return confirm('Вы уверены , что хотите удалить персонажа?');">
            </form>
        </div>
        <?php };
        ?>
    </div>
<a href="/">На главную</a>
</div>