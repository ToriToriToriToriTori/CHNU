<?php

require_once('./db/conect.php');
$conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (!empty($_POST['visible_post'])) {
    $post_id = $_POST['visible_post'];
    $sql_visible_post = "UPDATE news SET visible = NOT visible WHERE id = $post_id;";
    mysqli_query($conn, $sql_visible_post);
}

if (!empty($_POST['delete_post'])) {
    $post_id = $_POST['delete_post'];
    $sql_delete_post = "DELETE FROM news WHERE id = $post_id";
    mysqli_query($conn, $sql_delete_post);
}

$sql_10_latest = "SELECT * FROM news ORDER BY id DESC LIMIT 10";
$LATEStPOSTS = mysqli_query($conn, $sql_10_latest);

if(!empty($_POST) && empty($_POST['delete_post']) && empty($_POST['visible_post'])) {
    $visible = false;
    $date = date("Y-m-d");
    $author_id = $_SESSION["user_id"];
    $photo = $_POST['postimg'];
    $title = $_POST['postname'];
    $text = $_POST['postbody'];
    
    $sql = "INSERT INTO news (visible, date, author_id, photo, title, text) VALUES ('$visible', '$date', '$author_id', '$photo', '$title', '$text')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("Refresh:0");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<div class="news-edit-page">

    <div class="add-new-post">
        <h2>Додайте пост</h2>
        <form action="" method="post">
            <input type="url" name="postimg" id="postimg" placeholder="link">
            <input type="text" id="postname" name="postname" placeholder="title">
            <input type="textarea" id="postbody" name="postbody" placeholder="text">
            <input type="submit" value="Додати" class="submit-btn">
        </form>
    </div>
    <div class="latest-posts">
        <h2>Останні пости:</h2>

         <?php foreach ($LATEStPOSTS as $post) { ?>
            <div class="post">
                <img src="<?php echo $post["photo"]?>" alt="некоректно">
                <div>
                    <h5><?php echo $post["title"]?></h5>
                    <h6><?php echo $post["date"]?></h6> 
                    <div class="buttons">
                        <form action="" method="post">
                            <input type="hidden" name="delete_post" value="<?php echo $post['id'] ?>">
                            <button type="submit" class="delete">X</button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="visible_post" value="<?php echo $post['id'] ?>">
                            <button type="submit" class="edit"><?php echo $post['visible'] ?></button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

</div>
