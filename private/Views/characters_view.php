<main>

    <section class="justify-content row-container wrap">
    <?php foreach ($data as $character){?>
            <div class="characters column-container">
                <div class="margin charfoto"><a href="http://spbanimator.ru/characters/<?php echo $character['id']; ?>"><img src="images/characters/<?php echo $character['picname']; ?>"></a></div>
            <div class="margin  "><?php echo $character['title'];?></div>
                <?php    if($_SESSION['admin']){ ?>
                <div>
                    <div class="delete_button">
                        <form action="/charactersDelete/<?=$character['id'] ?>" method="post">
                        <input type="hidden" value="<?=$character['id'] ?>">
                        <input type="submit"  value="Удалить" onClick="return confirm('Вы уверены , что хотите удалить персонажа?');">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
    <?php } ?>
    </section>
</main>
