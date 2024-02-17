<?php

    require "libs/vars.php";
    require "libs/ayar.php";
    require "libs/functions.php";

    if(isLoggedin()) {
        header("location: profile.php");
        exit;
    }

    $email =  $password = "";
    $email_err = $password_err = $login_err= "";

    if (isset($_POST["login"])) {

        if(empty(trim($_POST["email"]))) {
            $email_err = "E-Posta Adresi girmelisiniz.";
        } else {
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))) {
            $password_err = "password girmelisiniz.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty($email_err) && empty($password_err)) {
            $sql = "SELECT id, email, password, user_type FROM users WHERE email = ?";

            if($stmt = mysqli_prepare($connection, $sql)) {
                $param_email =  $email;
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt,$id,$email,$hashed_password,$user_type);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["email"] = $email;
                                $_SESSION["user_type"] = $user_type;

                                header("location: profile.php");
                            } else {
                                $login_err = "yanlış parola girdiniz";
                            }
                        } 
                    } else {
                        $login_err = "yanlış Eposta girdiniz";
                    }
                } else {
                    $login_err = "bilinmeyen bir hata oluştu.";
                }
                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($connection);
    }

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

<?php
    if(!empty($login_err)) {
        echo '<div class="alert alert-danger">'.$login_err.'</div>';
    }
?>

    <div class="row">

        <div class="col-12">
           
        <div class="card">
           
           <div class="card-body">

               <form action="login.php" method="POST">

                    <div class="mb-3">
                       <label for="email" class="form-label">E-Posta Adresi</label>
                       <input type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''?>" value="<?php echo $email; ?>">
                       <span class="invalid-feedback"><?php echo $email_err; ?></span>
                   </div>

                   <div class="mb-3">
                       <label for="password" class="form-label">Parola</label>
                       <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid': ''?>" value="<?php echo $password; ?>">
                       <span class="invalid-feedback"><?php echo $password_err; ?></span>
                   </div>

                   <input type="submit" name="login" value="Submit" class="btn btn-primary">
               
               </form>
           </div>
       </div>

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

