<?php include_once("./sourse/regions.php");?>

<?php
$validation = array(); 
if(!empty($_POST)) {

    

    if(isset($_POST["login"]) && strlen($_POST["login"])<4) {
    $validation[] = "login"; 
    }

    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/", $_POST["password"])){
        $validation[] = "password";
    }

    if($_POST["passwordcheck"] != $_POST["password"]){
        $validation[] = "passwordcheck";
    }

    if(!preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/", $_POST["email"])){
    $validation[] = "email";
    }


    if( empty($validation)){
        require_once('./db/conect.php');

        $conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{

            $login = $_POST['login'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $email = $_POST['email'];
            $region = $_POST['region'];

            $sql = "INSERT INTO users (login, password, email, region) VALUES ('$login', '$password', '$email', '$region')"; 

            if (mysqli_query($conn, $sql)) {
                
                $sql = "SELECT * FROM users WHERE login = '$login'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                
                $_SESSION["auth"] = true;
                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_login"] = $row['login'];
                $_SESSION["is_admin"] = $row['is_admin'];

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
            header("Location:index.php?action=graphicpage");
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
            
            
            
            <form action="" class="justify-content-left" method="POST" id="signupform">
                
                <input type="text" name="login" id="login" 
                placeholder="Логін"
                <?php if(isset($_POST["login"])){echo "value='".$_POST["login"]."'";}?>
                <?php if(in_array("login", $validation)){ echo "class='invalid'";}?>
                >
                
                <input type="password" name="password" id="password" placeholder="Пароль"
                <?php if(in_array("password", $validation)){echo "class='invalid'";}?>
                >
                                                        
                <input type="password" name="passwordcheck" id="passwordcheck" placeholder="Повторіть пароль"
                <?php if(in_array("passwordcheck", $validation)){echo "class='invalid'";}?>
                >
                                
                <input type="email" name="email" id="email" placeholder="Електронна пошта"
                <?php if(in_array("email", $validation)){echo "class='invalid'";}?>
                >
                                
                                
                                <select name="region" id="region"> 
                                    <option value="-1" disabled selected hidden>Область проживання</option>
                                    <?php  foreach ($REGIONS as $value): ?>
                                        <option value="<?= $value["code"]?>"><?= $value["name"];?></option>
                                    <?php endforeach; ?>
                                </select>

                                <button class="registration-form-btn" >Зареєструватися</button>                 
                            </form>
                            
                        </div>



                    </div>
                </div>
