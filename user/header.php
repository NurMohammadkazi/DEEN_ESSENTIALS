<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$count = 0;
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--FontAwesome CDN-->
    <script src="https://kit.fontawesome.com/cb1dffe22c.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
        /* Your custom CSS styles */
        body {
            background: url('back6.jpg') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(10px);
        }

        .glass {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .navbar-light .navbar-brand {
            color: #fff;
        }

        .text-warning {
            color: #fff !important;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bg-danger {
            background: rgba(220, 53, 69, 0.2) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light glass">
        <div class="container-fluid font-monospace">
            <a class="navbar-brand pb-2"><img src="..." alt="">Desired Electronics</a>
            <div class="d-flex">
                <a href="index.php" class="text-warning text-decoration-none pe-2"><i
                        class="fa-solid fa-house-chimney"></i> Home |</a>
                <a href="viewCart.php" class="text-warning text-decoration-none pe-2"><i
                        class="fa-solid fa-cart-shopping"></i> Cart |</a>
                <span class="text-warning pe-2">
                    <?php if (isset($_SESSION['c_id'])): ?>
                        <a href="logout.php" class="text-warning text-decoration-none pe-2"><i
                                class="fa-solid fa-right-to-bracket"></i> Logout |</a>
                    <?php else: ?>
                        <a href="user_signup.php" class="text-warning text-decoration-none pe-2"><i
                                class="fa-solid fa-right-to-bracket"></i> Login |</a>
                    <?php endif; ?>
                    <a href="../admin/mystore.php" class="text-warning text-decoration-none pe-2"><i
                            class="fa-solid fa-user-tie"></i> Admin</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="bg-danger font-monospace my-3 glass">
        <ul class="list-unstyled d-flex justify-content-center">
            <li><a href="Laptop.php" class="text-decoration-none text-white fw-bold fs-4 px-5">Laptop</a></li>
            <li><a href="Mobile.php" class="text-decoration-none text-white fw-bold fs-4 px-5">Mobile</a></li>
            <li><a href="Bag.php" class="text-decoration-none text-white fw-bold fs-4 px-5">Others</a></li>
        </ul>
    </div>
</body>

</html>