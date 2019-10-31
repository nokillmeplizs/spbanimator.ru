<?php //var_dump($photos);?>
<main>
    <section class="aboutmain row-container gold margin6">
        <div class=" flex-1 about gold "><img src="/images/characters/<?php echo $character[0]['picname'];?>" alt="анимационный персонаж"></div>
        <div class=" flex-3 abouttext ">
            <div>
                <h1><?= $character[0]['title'];?></h1>
            </div>
           <div><?= nl2br($character[0]['character_info'])?></div>
           <div class="character_price">
               <?if($price[0]['price']!= null){
               echo "Стоимость:".$price[0]['price'];
           }?>
           </div>
            <?php    if($_SESSION['admin']){ ?>
            <div class="edit_button"><a href="/characters/<?=$character[0]['id'] ?>/edit"><input type="submit" name="action" value="редактировать"></a></div>
            <? }?>
        </div>
    </section>
    <div class="gold margin6">
        <div class="row">
            <?php
            foreach($data['photos'] as $photo){?>
                <div class="morePhotos col-lg-4 col-md-6 col-sm-12">
                    <img src="/images/characters/<?php echo $photo;?>" alt="photos" class="img-fluid">
                </div>
            <?php };?>
        </div>
    </div>



</main>