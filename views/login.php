<?php

$validation = array();
if(!empty($_POST)) {
    if(isset($_POST["login"]) && strlen($_POST["login"])<4) {
        $validation[] = "login"; 
    }
    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/", $_POST["password"])){
        $validation[] = "password";
    }
    if( empty($validation)){
        require_once('./db/conect.php');
        $conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            $login = $_POST['login'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE login = '$login'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    
                    $_SESSION["auth"] = true;
                    $_SESSION["user_id"] = $user['id'];
                    $_SESSION["user_login"] = $user['login'];
                    $_SESSION["is_admin"] = $user['Admin'];

                    header("Location:index.php?action=graphicpage");
                } else {
                    echo "Incorrect password!";
                }
            } else {
                echo "User not found!";
            }
            
           
        }

    }
}

?>


        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-12 col-md-4">

        <div class="registration-box shadow1">
                        
                        <div class="reg-type-btn">
                            <a href="index.php?action=login">Вхід</a>
                            /
                            <a href="index.php?action=signup">Реєстрація</a>
                        </div>
                        <form action="" class="justify-content-left" method="POST" id="loginform">

 
                                <input type="text" name="login" id="login"
                                placeholder="Логін"
                                <?php if(isset($_POST["login"])){echo "value='".$_POST["login"]."'";}?>
                                <?php if(in_array("login", $validation)){ echo "class='invalid'";}?>
                                >
                        
                                <input type="password" name="password" id="password"
                                placeholder="Пароль"
                                <?php if(in_array("password", $validation)){echo "class='invalid'";}?>
                                >
                          
                            <button class="registration-form-btn">Увійти</button>

                        </form>
                    </div>
        </div>
        </div>
        </div>