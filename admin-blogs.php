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
                <a href="blog-create.php" class="btn btn-primary">Yeni Film Ekle</a>
            </div>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 50px;">Fotoğraf</th>
                    <th>Başlık</th>
                    <th>Url</th>
                    <th>Kategori</th>
                    <th style="width: 120px ;">Aktif</th>
                    <th style="width: 150px ;">Aktiflik Durumu</th>
                    <th style="width: 150px;">Düzenle/Sil</th>
                </tr>
            </thead>
            <tbody>
                <?php $result = getBlogs(); while($film = mysqli_fetch_assoc($result)):?>
                    <tr>
                        <td>
                            <img src="img/<?php echo $film["imageUrl"] ?>" alt="" class="img-fluid" >
                        </td>
                        <td><?php echo $film ["title"]?></td>
                        <td><?php echo $film ["url"]?></td>
                        <td>
                            
                        <?php 
                                echo"<ul>";
                                $sonuc = getCategoriesByBlogId($film["id"]);

                                if(mysqli_num_rows($sonuc)> 0){
                                    while($category = mysqli_fetch_assoc($sonuc)){
                                        echo"<li>".$category["name"]."</li>";
                                    }
                                }else{
                                    echo "<li>kategori seçilmedi</li>";
                                }
                            echo "</ul>";

                        ?>
                    
                        </td>
                        <td>
                            <?php if($film["isActive"]): ?>
                                <p class="text-center"><i class="fas fa-check"></i></p>
                            <?php else: ?>
                                <p class="text-center"><i class="fas fa-times"></i></p>
                                
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($film["isHome"]): ?>
                                <p class="text-center"><i class="fas fa-check"></i></p>
                            <?php else: ?>
                                <p class="text-center"><i class="fas fa-times"></i></p>
                                
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="blog-edit.php?id=<?php echo $film ["id"] ?>">Düzenle</a>
                            <a class="btn btn-danger btn-sm" href="blog-delete.php?id=<?php echo $film ["id"] ?>">Sil</a>
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