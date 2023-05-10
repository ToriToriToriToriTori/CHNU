<?php include('./models/News.php')?>

<div class="">


    <div class="container">

        <div class="row">
            <div class="col-12 justify-space-beetwen">
                <div>
                    <input> </input>
                </div>
                <div>
                    selec
                    
                </div>
            </div>
        </div>

        <div class="news-list">
                
                <?php foreach ($news as $n) { ?>

                <div class="newsblok shadow1">
                    <img src="<?php echo $n->photo ?>" alt="<?php echo $n->name ?>">
                    <div>
                        <a href="#"><?php echo $n->name?></a>
                        <br>
                        <span><?php echo $n->name?></span>
                        <hr>
                        <p><?php echo $n->description ?></p>
                    </div>
                </div>

                    <?php } ?>
                        

        </div>
    </div>


</div>

 