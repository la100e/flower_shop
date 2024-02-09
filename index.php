<?php
    session_start();
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop</title>
    <link rel="stylesheet" href="stylex.css">
    <link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.css">
</head>

<body>
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">flower <span>.</span></a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
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

    <section class="home" id="home">
        <div class="content">
            <h3>fresh flowers</h3>
            <span>natural & beautiful flowers</span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, dolorem corrupti. Eum officiis, fugiat soluta incidunt ducimus hic veniam suscipit.</p>
            <a href="products.php" class="btn">shop now</a>
        </div>
    </section>

    <section class="about" id="about">
        <h1 class="heading"><span> about </span> us </h1>
        <div class="row">
            <div class="video-container">
                <video src="wallpapers/vid2.mp4" loop autoplay muted></video>
                <h3>best flower sellers</h3>
            </div>
            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium accusamus esse consequuntur ipsa, perspiciatis sapiente quos ipsum dolores ipsam itaque dignissimos dolorum saepe ut doloremque repudiandae! Aut reiciendis eveniet officiis.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt reprehenderit minus debitis excepturi eveniet laborum veritatis inventore ipsa, dolores dolore.</p>
                <a href="#" class="btn">learn more</a>
            </div>
        </div>
    </section>

    <section class="icons-container">
        <div class="icons">
            <img src="wallpapers/icon1.png" alt="">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>
        <div class="icons">
            <img src="wallpapers/icon2.png" alt="">
            <div class="info">
                <h3>3 days returns</h3>
                <span>money back garantee </span>
            </div>
        </div>
        <div class="icons">
            <img src="wallpapers/icon3.png" alt="">
            <div class="info">
                <h3>offers & gifts</h3>
                <span>on all orders</span>
            </div>
        </div>
        <div class="icons">
            <img src="wallpapers/icon4.png" alt="">
            <div class="info">
                <h3>secure payments</h3>
                <span>protected by paypal</span>
            </div>
        </div>
    </section>

    <section class="products" id="products">
        <h1 class="heading"> latest <span>products</span></h1>
        <div class="box-container">
            <?php
                $req = $connect->prepare('select * from products');
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

    <section class="review" id="review">
        <h1 class="heading"> customer's <span>review</span> </h1>
        <div class="box-container">
            <?php
                $req = $connect->prepare('select * from customers where review is not null');
                $req->execute();
                $customers = $req->fetchAll(PDO::FETCH_ASSOC);
                foreach ($customers as $customer) {
                    ?>
                        <div class="box">
                            <div class="stars">
                                <?php
                                    // if($customer['review-stars'] != 0){
                                    if(!is_null($customer['review-stars'])){
                                        for ($i=0; $i < $customer['review-stars']; $i++) { 
                                            echo('<i class="fas fa-star"></i>');
                                        }
                                ?>
                            </div>
                            <p><?= $customer['review'] ?></p>
                            <div class="user">
                                <img src="wallpapers/user.png" alt="">
                                <div class="user-info">
                                    <h3><?= $customer['full name'] ?></h3>
                                </div>
                            </div>
                            <span class="fas fa-quote-right"></span>
                        </div>
                    <?php 
                    }
                }
            ?>
        </div>
    </section>

    <section class="contact" id="contact">
        <h1 class="heading"> <span> contact </span> us </h1>
        <div class="row">
            <form action="">
                <input type="text" placeholder="name">
                <input type="text" placeholder="email">
                <textarea name="msg" id="msg" cols="30" rows="10"></textarea>
                <input type="submit" class="btn" value="Send">
            </form>
        </div>
    </section>

</body>

</html>