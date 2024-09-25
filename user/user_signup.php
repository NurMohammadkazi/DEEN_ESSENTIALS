<?php
include ("Config.php");
session_start();
$message = "";

// Redirect if already logged in
if (isset($_SESSION['c_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $c_name = $_POST['c_name'];
    $c_mail = $_POST['c_mail'];
    $c_password = $_POST['c_password'];
    $c_address = $_POST['c_address'];
    $c_phone = $_POST['c_phone'];

    // Check if the email already exists
    $queryAll = "SELECT * FROM customer_table WHERE c_mail = ?";
    $stmt = $con->prepare($queryAll);
    $stmt->bind_param("s", $c_mail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message .= "<div class='alert alert-danger'>Email Already Available..!! Try Different</div>";
    } else {
        // Insert new customer
        $query = "INSERT INTO customer_table (c_password, c_mail, c_name, c_address, c_phone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssss", $c_password, $c_mail, $c_name, $c_address, $c_phone);

        if (!$stmt->execute()) {
            $message = "Query error";
        } else {
            $_SESSION['c_id'] = $stmt->insert_id; // Store customer ID in session
            $message = "<div class='alert alert-success'>Thank You For Registration.. <span> Please Check Your Email </span></div>";
            header("Refresh: 5; url=index.php");
        }
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Customer Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            position: relative;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".bg-dark" data-offset="50">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark" id="signup">
        <a class="navbar-brand text-white" href="products.php">Desired Electronics</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container mt-4 w-50 mb-4">
        <?php echo $message; ?>
    </div>

    <div class="container w-50 mt-5 bg-light shadow">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" class="p-3">
                    <h4 class="font-weight-bold text-center">Register Now !!</h4>
                    <div class="col-md-12">
                        <label for="c_name" class="">Your name</label>
                        <div class="md-form mb-0">
                            <input type="text" id="c_name" name="c_name" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="c_address" class="">Your Address</label>
                        <div class="md-form mb-0">
                            <input type="text" id="c_address" name="c_address" class="form-control form-control-sm"
                                required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="c_phone" class="">Your Phone Number</label>
                        <div class="md-form mb-0">
                            <input type="text" id="c_phone" name="c_phone" class="form-control form-control-sm"
                                required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="c_mail" class="">Your email</label>
                        <div class="md-form mb-0">
                            <input type="email" id="c_mail" name="c_mail" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="c_password">Password</label>
                        <div class="md-form">
                            <input type="password" id="c_password" name="c_password"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="mt-4 text-center col-md-12 mb-2">
                        <button type="submit" name="submit" class="btn btn-block btn-info btn-sm">Sign Up</button>
                    </div>
                    <p class="float-right mr-4">If you already signed up? <span><a href="user_login.php"
                                class="btn btn-info btn-sm">Login</a></span> </p>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <footer class="col-md-12 text-white mt-5 pt-4">
            <div class="bg-dark list-unstyled list-inline text-center py-5">
                <li class="list-inline-item">
                    <h5 class="mb-1">Register for free</h5>
                </li>
                <li class="list-inline-item">
                    <a href="#signup" class="btn btn-outline-light">Sign up!</a>
                </li>
            </div>
            <div class="footer-copyright text-center py-4 bg-secondary">
                © 2024 Copyright: <a href="#" class="text-white">Desired Electronics</a>
            </div>
        </footer>
    </div>
</body>

</html>