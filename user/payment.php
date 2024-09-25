<?php
session_start();
include 'Config.php';

if (!isset($_SESSION['c_id'])) {
    echo "
        <script>
        alert('Please log in to make a payment.');
        window.location.href = 'user_login.php';
        </script>
    ";
    exit();
}

$c_id = $_SESSION['c_id'];
$query = "SELECT SUM(o.PPrice * o.PQuantity) AS total FROM order_table o WHERE o.c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_amount = $row['total'];

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5 rounded glass">
                <h1 class="text-warning">Payment</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center text-white">
                <h3>Total Amount: BDT <?php echo number_format($total_amount, 2); ?></h3>

                <?php
                require('config2.php');
                ?>
                <form action="submit.php" method="post">
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="<?php echo $publishableKey ?>" 
                        data-amount="$total_amount*100"
                        data-name="Programming with Vishal" data-description="Programming with Vishal Desc"
                        data-image="https://www.logostack.com/wp-content/uploads/designers/eclipse42/small-panda-01-600x420.jpg"
                        data-currency="usd" data-email="phpvishal@gmail.com">
                        </script>

                </form>
            </div>
        </div>
    </div>

    
</body>

</html>