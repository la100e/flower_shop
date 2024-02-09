<?php
    session_start();
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products I Liked</title>
    <link rel="stylesheet" href="stylex.css">
    <link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">
</head>
<body>
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">flower <span>.</span></a>
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="#products">products</a>
            <a href="#review">review</a>
            <a href="#contact">contact</a>
        </nav>
        <div class="icons">
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? 'productsiliked.php?id='.$_SESSION['id'] : 'login.php' ?>" class="fas fa-heart"></a>
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? 'productsibuyed.php?id='.$_SESSION['id'] : 'login.php' ?>" class="fas fa-shopping-cart"></a>
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? 'disconnect.php': 'login.php' ?>" class="fas fa-user"></a>
        </div>
    </header>
    <section class="products section1" id="products">
        <h1 class="heading"> my <span>products</span></h1>
        <div class="box-container">
            <?php
                $req = $connect->prepare('select * from products p inner join categories c on category=c.id where p.id in (select product from mycart where customer='.$_SESSION['id'].')');
                $req->execute();
                $products = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($products as $product) {
                    ?>
                        <div class="box">
                            <span class="discount">-<?= $product['discount'] ?>%</span>
                            <div class="image">
                                <img src="wallpapers/<?= $product['path'] ?>" alt="">
                                <div class="icons">
                                    <a href="#" class="fas fa-heart"></a>
                                    <a href="#" class="cart-btn">add to cart</a>
                                    <a href="#" class="fas fa-share"></a>
                                </div>
                            </div>
                            <div class="content">
                                <h3><?= $product['name'] ?> pot</h3>
                                <h6>from the family of <span><?= $product['category-name'] ?></span></h6>
                                <div class="price"> $<?= $product['price'] ?> <span>$<?= $product['price']*(1+$product['discount']/100) ?></span></div>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </div>
    </section>
</body>
</html>