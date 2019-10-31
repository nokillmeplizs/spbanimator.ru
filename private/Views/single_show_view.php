<?php //var_dump($show);?>
<main>
    <section class="aboutmain row-container gold margin6">
        <div class=" flex-2 about gold align-self-center"><img src="/images/shows/<?php echo $show[0]['picname'];?>" alt="шоу"></div>
        <div class=" flex-2 abouttext ">
            <div><h3><?= $show[0]['title'];?></h3></div>
           <div><?= $show[0]['show_info']?></div>
            <div class="character_price">
                <?if($price[0]['price']!= null){
                    echo "Стоимость:".$price[0]['price'];
                }?>
            </div>
            <?php    if($_SESSION['admin']){ ?>
            <div class="edit_button"><a href="/shows/<?=$show[0]['id'] ?>/edit"><input type="submit" name="action" value="редактировать"></a></div>
            <? }?>
        </div>

    </section>
    <div class="gold margin6">
        <div class="row">
            <?php
            foreach($data['photos'] as $photo){?>
                <div class="morePhotos col-lg-4 col-md-6 col-sm-12">
                    <img src="/images/shows/<?php echo $photo;?>" alt="photos" class="img-fluid">
                </div>
            <?php };?>
        </div>
    </div>


</main>