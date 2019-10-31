<?php if (!$_SESSION['admin']){
    header('Location: /');
    exit();
};?>
<div class="add_character">
    <form id="characterAddForm" action="/charactersAdd" enctype="multipart/form-data" method="post" >
        <fieldset>
            <legend>Добавление персонажа</legend>
            <div>
                <label for="title">Введите название персонажа</label><br>
                <input id="title" name="title" type="text" placeholder="Название персонажа" size="40" required>
            </div>
            <div>
                <label for="price">Укажите стоимость персонажа</label><br>
                <input id="price" name="price" type="text" placeholder="Стоимость" >
            </div>
            <div>
                <label for="character_text"></label>
                <textarea id="character_text" name="character_text" rows="10" cols="55" placeholder="Описание персонажа" ></textarea>
            </div>
            <p>Загрузите основную фото персонажа</p>
            <div><input type="file" name="photo[]" multiple accept="image/*"></div>
            <p>Загрузите дополнительные фото персонажа</p>
            <div><input type="file" name="photos[]" multiple accept="image/*"></div>
            <div><img src="images/seo-cat2.png" alt="Расскажите мне о СЕО"> </div>
            <div>
                <label for="title_page"></label>
                <input id="title_page" name="title_page" type="text" placeholder="Название страницы" style="text-align:center;">
            </div>
            <div>
                <label for="description"></label>
                <input id="description" name="description" type="text" placeholder="Описание страницы" size="40" style="text-align:center;">
            </div>
            <div>
                <label for="keywords"></label>
                <input id="keywords" name="keywords" type="text" placeholder="Ключевые слова" size="40" style="text-align:center;">
            </div>
            <div id="response2"></div>
            <div>
                <input type="submit" value="отправить">
            </div>
         </fieldset>
    </form>
<a href="/">На главную</a>
</div>