<?php
session_start();
include 'Config.php';

if (!isset($_SESSION['c_id'])) {
    echo "
        <script>
        alert('Please log in to view your cart.');
        window.location.href = 'user_login.php';
        </script>
    ";
    exit();
}

$c_id = $_SESSION['c_id'];
$query = "SELECT o.o_id, o.PPrice, o.Id, p.PName, o.PQuantity FROM order_table o
          JOIN tblproduct p ON o.Id = p.Id
          WHERE o.c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5 rounded glass">
                <h1 class="text-warning">My Cart</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <table class="table table-bordered text-center">
                    <thead class="bg-danger text-white fs-5">
                        <tr>
                            <th>Serial No.</th>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Total Price</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                $product_price = (float) $row['PPrice'];
                                $product_quantity = (int) $row['PQuantity'];
                                $ptotal = $product_price * $product_quantity;
                                $total += $ptotal;
                                echo "
                                    <form action='Insertcart.php' method='POST'>
                                    <tr>
                                        <td class='text-white fs-5'>$i</td>
                                        <td class='text-white fs-5'>{$row['o_id']}</td>
                                        <td class='text-white fs-5'>{$row['PName']}</td>
                                        <td class='text-white fs-5'>{$product_price}</td>
                                        <td class='text-white fs-5'><input type='number' name='PQuantity' value='{$product_quantity}'></td>
                                        <td class='text-white fs-5'>" . number_format($ptotal, 2) . "</td>
                                        <td><button name='update' class='btn btn-warning'>Update</button></td>
                                        <td><button name='remove' class='btn btn-danger'>Delete</button></td>
                                        <td><input type='hidden' name='o_id' value='{$row['o_id']}'></td>
                                    </tr>
                                    </form>
                                ";

                            }
                        } else {
                            echo "
                                <tr>
                                    <td class='text-white fs-5' colspan='8'>Your cart is empty.</td>
                                </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3 text-center text-white">
                <h3>Total</h3>
                <h1 class="bg-danger text-white"><?php echo number_format($total, 2); ?></h1>
            </div>
            <div class="col-lg-5 text-white text-center">
                <h3>Payment</h3>
                <a class="btn btn-success" href="payment.php" role="button">Pay Your Bill</a>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$stmt->close();
$con->close();
?>