<?php 
include('./models/News.php');


require_once('./db/conect.php');
$conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$sql_30_latest = "SELECT * FROM news WHERE visible = 1 ORDER BY id DESC LIMIT 30";
$LATEStPOSTS = mysqli_query($conn, $sql_30_latest);

?>

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
                
                <?php foreach ($LATEStPOSTS as $post) { ?>

                <div class="newsblok shadow1">
                    <img src="<?php echo $post["photo"] ?>" alt="<?php echo $post["title"]?>">
                    <div>
                        <a href="#"><?php echo $post["title"]?></a>
                        <br>
                        <span><?php echo $post["date"]?></span>
                        <hr>
                        <p><?php echo $post["text"] ?></p>
                    </div>
                </div>

                    <?php } ?>
                        

        </div>
    </div>


</div>

 