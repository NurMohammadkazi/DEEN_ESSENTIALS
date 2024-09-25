<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home-Page</title>

  <!--Bootstrap CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--FontAwesome CDN-->
  <script src="https://kit.fontawesome.com/cb1dffe22c.js" crossorigin="anonymous"></script>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
  </style>
</head>
<?php
session_start();
if (!$_SESSION['admin']) {
  header("location:from/login.php");
}
?>

<body>
  <nav class="navbar navbar-light bg-dark">
    <div class="container-fluid text-white">
      <a class="navbar-brand text-white" href="../admin/mystore.php">
        <h1>DEEN ESSENTIAL</h1>
      </a>
      <span>
        <i class="fas fa-user-shield"></i>
        Hello, <?php echo $_SESSION['admin']; ?> |
        <i class="fas fa-sign-out-alt"></i>
        <a href="from/logout.php" class="text-decoration-none text-white">Log out |</a>
        <a href="../admin/mystore.php" class="text-decoration-none text-white">Dashboard </a>

      </span>
    </div>
  </nav>
  <!--Dashboard-->
  <div>
    <h2 class="text-center">
      Dashboard
    </h2>
  </div>
  <div class=" col-md-6 bg-danger text-center m-auto">
    <a href="product/index.php" class="text-white text-decoration-none fs-4 fw-bold px-5">Add Post</a>
    <a href="users_details.php" class="text-white text-decoration-none fs-4 fw-bold px-5">Order Hystory</a>
  </div>
</body>

</html>