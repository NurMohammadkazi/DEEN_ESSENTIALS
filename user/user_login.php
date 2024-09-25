<?php
include ("Config.php");
session_start(); // Start session at the beginning
$message = '';

// Redirect if already logged in
if (isset($_SESSION['c_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['c_mail'];
    $password = $_POST['c_password'];
    $username = $con->real_escape_string($username);
    $password = $con->real_escape_string($password);

    $query = "SELECT * FROM customer_table WHERE c_mail = '$username' AND c_password = '$password'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['c_id'] = $row['c_id']; // Store customer ID in session
        header("location:index.php");
    } else {
        $message = "Login Failed.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background: #456;
            font-family: 'Open Sans', sans-serif;
        }

        .box {
            width: 400px;
            margin: 16px auto;
            font-size: 16px;
        }

        .header,
        .box p {
            margin-top: 0;
            margin-bottom: 0;
        }

        .triangle {
            width: 0;
            margin-right: auto;
            margin-left: auto;
            border: 12px solid transparent;
            border-bottom-color: #28d;
        }

        .header {
            background: #28d;
            padding: 20px;
            font-size: 1.4em;
            font-weight: normal;
            text-align: center;
            text-transform: uppercase;
            color: #fff;
        }

        .container {
            background: #ebebeb;
            padding: 12px;
        }

        .box p {
            padding: 12px;
        }

        .box input {
            box-sizing: border-box;
            display: block;
            width: 100%;
            border-width: 1px;
            border-style: solid;
            padding: 16px;
            outline: 0;
            font-family: inherit;
            font-size: 0.95em;
        }

        .box input[type="name"],
        .box input[type="password"] {
            background: #fff;
            border-color: #bbb;
            color: #555;
        }

        .box input[type="name"]:focus,
        .box input[type="password"]:focus {
            border-color: #888;
        }

        .box input[type="submit"] {
            background: #28d;
            border-color: transparent;
            color: #fff;
            cursor: pointer;
        }

        .box input[type="submit"]:hover {
            background: #17c;
        }

        .box input[type="submit"]:focus {
            background: #05a;
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="triangle"></div>
        <h2 class="header">Log in</h2>
        <form class="container" method="post">
            <h2 style="margin-left: 15px; color: red; font-family: Arial">
                <?php echo $message; ?>
            </h2>
            <p><input type="name" name="c_mail" placeholder="Email"></p>
            <p><input type="password" name="c_password" placeholder="Password"></p>
            <p><input type="submit" name="submit" value="Log in"></p>
        </form>
    </div>
</body>

</html>