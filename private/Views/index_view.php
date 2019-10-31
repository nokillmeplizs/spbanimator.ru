
<main>
    <div class="aboutUs gold">
        <h2><?=$data[0]['title'] ?></h2>
        <div><?=nl2br($data[0]['text']) ?></div>
    </div>
<!--    <div class="partners">-->
<!--        <h3>Наши партнеры</h3>-->
<!--    </div>-->
<!--    <section class="justify-content row-container wrap">-->
<!--        --><?php //foreach ($data as $partner){?>
<!--                <div class="margin charfoto"><img src="images/characters/--><?php //echo $partner['picName']; ?><!--"></div>-->
<!--        --><?php //} ?>
<!--    </section>-->
    <?php    if($_SESSION['admin']){ ?>
        <div class="edit_button"><a href="/aboutUs/edit"><input type="submit" name="action" value="редактировать"></a></div>
    <? }?>
    <div class="videoContainer">
        <div class="videoMainPage">
            <iframe src="//vk.com/video_ext.php?oid=13712400&id=456239056&hash=62d7b78612578c88&hd=2" style="margin-top: 30px;" width="60%" height="600px" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="comments">
        <div id="feedback_vk" style="width:800px;margin: 50px auto;"></div>
    </div>


</main>