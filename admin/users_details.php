<?php
session_start();
include '../user/Config.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: from/login.php");
    exit();
}

$sql = "SELECT pay_id, c_id, c_phone, c_address, PPrice, payment_date, Id, PQuantity FROM paid_table";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users Page</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FontAwesome CDN -->
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
    <!-- Dashboard -->
    <div>
        <h2 class="text-center">Order Details</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered text-center">
                    <thead class="bg-danger text-white fs-5">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Customer ID</th>
                            <th>Customer Phone</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Product ID</th>
                            <th>Product Quantity</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["pay_id"] . "</td>
                                        <td>" . $row["c_id"] . "</td>
                                        <td>" ."0". $row["c_phone"] . "</td>
                                        <td>" . $row["c_address"] . "</td>
                                        <td>" . $row["PPrice"] . "</td>
                                        <td>" . $row["payment_date"] . "</td>
                                        <td>" . $row["Id"] . "</td>
                                        <td>" . $row["PQuantity"] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php

$con->close();
?>