<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">Blog</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="blogs.php" class="nav-link">Bloglar</a>
                </li>
                <?php if (isAdmin()): ?>
                    <li class="nav-item">
                        <a href="admin-blogs.php" class="nav-link">Yönetici Bloglar</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin-categories.php" class="nav-link">Yönetici Kategoriler</a>
                    </li>
                <?php endif; ?>       
              
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">

                <?php if (isLoggedin()): ?>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Çıkış Yap</a>
                    </li>
                    
                
                <?php else: ?>
                
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Üye Ol</a>
                    </li>

                <?php endif; ?>       


            </ul>
            <form class="d-flex" action="blogs.php" method="GET">
                <input type="text" name="q" class="form-control me-2" placeholder="Aradığınız Filmi Yazınız">
                <button class="btn btn-outline-light">Ara</button>
            </form>
        </div>
    </div>
</nav>