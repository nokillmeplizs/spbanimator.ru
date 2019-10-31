<main>

    <section class="justify-content row-container wrap">
        <?php foreach ($data as $show){?>
            <div class="shows column-container">
                <div class="margin charfoto"><a href="http://spbanimator.ru/shows/<?php echo $show['id']; ?>"><img src="images/shows/<?php echo $show['picname']; ?>"></a></div>
                <div class="margin  "><?php echo $show['title'];?></div>
                <?php    if($_SESSION['admin']){ ?>
                    <div>
                        <div class="delete_button">
                            <form action="/showsDelete/<?=$show['id'] ?>" method="post">
                                <input type="hidden" value="<?=$show['id'] ?>">
                                <input type="submit"  value="Удалить" onClick="return confirm('Вы уверены , что хотите удалить персонажа?');">
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
</main>
