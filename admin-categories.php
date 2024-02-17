<?php

   require "libs/vars.php";
   require "libs/functions.php";
   if(!isAdmin()){
    header("location: unauthorize.php");
    exit;
   }
   
?>
<?php include "views/_header.php"?>
<?php include "views/_message.php"?>
<?php include "views/_navbar.php"?>

<div class="container">
    <div class="row">

        <div class="col-12">

        <div class="card mb-1">
            <div class="card-body">
                <a href="category-create.php" class="btn btn-primary">Yeni Kategori Ekle</a>
            </div>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 50px;">Id</th>
                    <th>Kategori Adı</th>
                    <th style="width: 150px ;">Aktiflik Durumu</th>
                    <th style="width: 130px;">Düzenle/Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php $result = getCategories(); while($item = mysqli_fetch_assoc($result)):?>
                    <tr>
                        <td><?php echo $item ["id"]?></td>
                        <td><?php echo $item ["name"]?></td>
                        <td>
                        
                            <?php if($item["isActive"]): ?>
                                <p class="text-center"><i class="fas fa-check"></i></p>
                            <?php else: ?>
                                <p class="text-center"><i class="fas fa-times"></i></p>
                                
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="category-edit.php?id=<?php echo $item ["id"] ?>">Düzenle</a>
                            <a class="btn btn-danger btn-sm" href="category-delete.php?id=<?php echo $item ["id"] ?>">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>    
            </tbody>
        </table>
        
        </div>
    </div>
    </div>
   
    <?php
    include "views/_footer.php"
?>