<?php if (!$_SESSION['admin']){
    header('Location: /');
    exit();
};?>
<div class="add_character">
        <form action="/charactersUpdate/<?=$data['id']?>" enctype="multipart/form-data" method="post">
    <fieldset>
        <legend><?=$data['title']; ?></legend>
        <div>
            <label for="title">Введите название персонажа</label><br>
            <textarea id="title" name="title"  rows="1" cols="30"placeholder="Название персонажа" required><?=$character[0]['title'] ?></textarea>
        </div>
        <div>
            <label for="price">Укажите стоимость персонажа</label><br>
            <textarea id="price" name="price"  rows="1" cols="30"placeholder="Стоимость" ><?=$price[0]['price'] ?></textarea>
        </div>
        <div>
            <label for="character_text"></label>
            <textarea id="character_text" name="character_text" rows="15" cols="55" placeholder="Описание персонажа" ><?=$character[0]['character_info'] ?></textarea>
        </div>
        <p>Нажмите обзор, и выберите другую фотографию, если хотите её заменить</p>
        <div>
            <img src="/images/characters/<?=$character[0]['picname'] ?>" alt="" width="300px"><input type="file" name="photo[]" multiple accept="image/*">
        </div>
        <p>Загрузите дополнительные фото персонажа</p>
        <?php
        foreach($data['photos'] as $photo){?>
        <div><img src="/images/characters/<?php echo $photo;?>" alt="photos" width="300px" class="img-fluid">
            <?php };
            ?>
        </div>
        <div><input type="file" name="photos[]" multiple accept="image/*"></div>
        <br>
        <h3>Настройки для СЕО</h3>
        <div>
            <label for="title_page">Title</label><br>
            <input id="title_page" name="title_page" type="text" value="<?=$character[0]['title_page'] ?>" placeholder="Название страницы" style="text-align:center;">
        </div>
        <div>
            <label for="description">Description</label><br>
            <textarea class="seoText" id="description" name="description"  placeholder="Описание страницы" rows="5" cols="55" ><?=$character[0]['description'] ?></textarea>
        </div>
        <div>
            <label for="keywords">Keywords</label><br>
            <textarea class="seoText" id="keywords" name="keywords" placeholder="Ключевые слова"  rows="3" cols="55" ><?=$character[0]['keywords'] ?></textarea>
        </div>
        <div id="response2"></div>
        <div>
            <input type="submit" value="Сохранить изменения">
        </div>
    </fieldset>
</form>
    <?php
    foreach($data['photos'] as $photo){?>
    <div><img src="/images/characters/<?php echo $photo;?>" alt="photos" width="300px" class="img-fluid">
        <div class="delete_button">
            <form action="/multPhotoDelete/1" method="post">
                <input type="hidden" name="DeletePhoto" value="<?=$photo;?>">
                <input type="submit"  value="Удалить" onClick="return confirm('Вы уверены , что хотите удалить персонажа?');">
            </form>
        </div>
        <?php };
        ?>
    </div>
    <div><a href="/">На главную</a></div>
</div>