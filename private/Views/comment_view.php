<main>
            <section class="fd-col row-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="fb-row">
                                <?php foreach ($data['last3comments'] as $comment){?>
                                    <div class=" flex-1 gold feedback-text">
                                        <h3><?=$comment['username']?></h3>
                                        <div class="show_commets">
                                            <?=$comment['comment_text']?>
                                        </div>
                                    </div>
                                <? }?>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="fb-row">
                                <?php foreach ($data['moreComments'] as $comment){?>
                                    <div class=" flex-1 gold feedback-text">
                                        <h3><?=$comment['username']?></h3>
                                        <div class="show_commets">
                                            <?=$comment['comment_text']?>
                                        </div>
                                    </div>
                                <? }?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="fb-slide">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"><div class="fb-prev"><button>Предыдущие</button></div></a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <div class="fb-next"><button>Следующие</button></div> </a>
                <button style="font-size: 20px; font-weight: bold;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Оставить отзыв
    </button>


                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Оставить отзыв</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/animator/addComment" method="post">
                                    <fieldset>
                                        <div>
                                            <label for="textarea"></label>
                                            <textarea id="textarea" name="textarea" rows="10" cols="70" placeholder="напишите свой отзыв здесь" required></textarea>
                                        </div>
                                    </fieldset>
                                    <div class="modal-footer">
                                        <div id="response3"></div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">закрыть</button>
                                        <button type="submit" id="sendComment" class="btn btn-primary">Отправить</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</main>