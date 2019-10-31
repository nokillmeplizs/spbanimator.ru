<main>
    <h2 style="text-align: center">Наше видео</h2>
    <section class="justify-content row-container wrap videoContainer margin6">
        <?php foreach ($data['video'] as $video){?>
        <div class="video">
        <?php echo $video['videolink'];?>
            <h3 class="videoName"> <?php echo $video['videoname'];?></h3>
        <?php    if($_SESSION['admin']){ ?>
            <div>
                <div class="delete_button">
                    <form action="/videoDelete/<?=$video['id'] ?>" method="post">
                        <input type="hidden" value="<?=$video['id'] ?>">
                        <input type="submit"  value="Удалить" onClick="return confirm('Вы уверены , что хотите удалить персонажа?');">
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
</main>
