
<?php

   require "libs/vars.php";
   require "libs/functions.php";
   if (!isLoggedin()) {
    header("location: login.php");
    exit;
}
  
?>
<?php include "views/_header.php"?>
<?php include "views/_navbar.php"?>

<div class="container my-3">
    <div class="row">

        <div class="col-12">
            
            <h3>Merhaba, <?php echo htmlspecialchars($_SESSION["email"]) ?></h3>
            <div>
                
            </div>
        </div>
    </div>
</div>
   
<?php include "views/_footer.php"?>