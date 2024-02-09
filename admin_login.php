<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            <a href="#contact">contact</a>
        </nav>
        <!-- <div class="icons">
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? 'productsiliked.php?'.$_SESSION['id'] : 'login.php' ?>" class="fas fa-heart"></a>
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? 'productsibuyed.php?'.$_SESSION['id'] : 'login.php' ?>" class="fas fa-shopping-cart"></a>
            <a href="<?= (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) ? '#': 'login.php' ?>" class="fas fa-user"></a>
        </div> -->
    </header>

    <!-- <h1 class="heading head"> log <span> in </span></h1> -->
    <section class="section2">
        <form method="post" id="login-form">
            <div class="row1">
                <input type="text" id="login" name="login" placeholder="Login">
                <div id="loginmsg" class="wmsg"></div>
            </div>
            <div class="row1">
                <input type="password" name="password" id="password" placeholder="Password">
                <div id="passwordmsg" class="wmsg"></div>
            </div>
            <input type="submit" value="Log In" class="btn">
        </form>
        <div class="rowx">
            <span>Don't have an account? </span>
            <a href="signin.php">Sign In</a>
        </div>
    </section>

    <script>
        function Validate(event) {

            var login = document.getElementById('login').value;
            var password = document.getElementById('password').value;
            var stat = true;

            login == '' ? (stat = false, document.getElementById('loginmsg').innerText = '* Invalid login !') : document.getElementById('loginmsg').innerText = '';
            password == '' ? (stat = false, document.getElementById('passwordmsg').innerText = '* Invalid password !') : document.getElementById('passwordmsg').innerText = '';

            if (!stat)
                event.preventDefault();
        }

        document.getElementById('login-form').addEventListener('submit', Validate);
    </script>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $req = $connect->prepare('select * from admins where login=? and password=?');
            $req->execute([$_POST['login'],$_POST['password']]);

            if ($req->rowCount() == 0)
                header('Location:index.php');
            else {
                $admin = $req->fetchAll(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['loggedInAdmin'] = true;
                $_SESSION['id'] = $admin[0]['id'];
                header('Location:admin_page.php');
            }
        }
    ?>
</body>
</html>