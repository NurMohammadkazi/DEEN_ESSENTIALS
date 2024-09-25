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

// Calculate total amount
$query = "SELECT SUM(o.PPrice * o.PQuantity) AS total FROM order_table o WHERE o.c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_amount = $row['total'];

$stmt->close();

// Retrieve customer information
$query = "SELECT c_phone, c_address FROM customer_table WHERE c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();
$stmt->close();

// Generate a unique pay_id for this payment session
$pay_id = uniqid('pay_');

// Fetch all products in the cart for this customer
$query = "SELECT o.Id, o.PPrice, o.PQuantity, p.PName
FROM order_table o
JOIN tblproduct p ON o.Id = p.Id
WHERE o.c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$product_result = $stmt->get_result();

while ($product = $product_result->fetch_assoc()) {
	// Insert each product into the paid_table with the same pay_id
	$query = "INSERT INTO paid_table (pay_id, c_id, c_phone, c_address, PPrice, PQuantity, payment_date, Id)
VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
	$stmt = $con->prepare($query);
	$stmt->bind_param(
		"sissiii",
		$pay_id,
		$c_id,
		$customer['c_phone'],
		$customer['c_address'],
		$product['PPrice'],
		$product['PQuantity'],
		$product['Id']
	);
	$stmt->execute();
	$stmt->close();
}

$query = "
    UPDATE tblproduct t
    JOIN order_table o ON t.Id = o.Id
    SET t.Pquantity = t.Pquantity - o.PQuantity
";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();
// Clear the cart after payment
$query = "DELETE FROM order_table WHERE c_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$stmt->close();


// Redirect to a success page
header("Location: index.php");
exit();

?>

<?php
require('config2.php');
if (isset($_POST['stripeToken'])) {
	\Stripe\Stripe::setVerifySslCerts(false);

	$token = $_POST['stripeToken'];

	$data = \Stripe\Charge::create(array(
		"amount" => $total_amount * 100,
		"currency" => "inr",
		"description" => "Programming with Vishal Desc",
		"source" => $token,
	));
	/*
			echo "<pre>";
			print_r($data);
		*/
}

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
				<h3>Payment Successful</h3>
				<?php
				include 'Config.php';




				?>
			</div>
		</div>
	</div>


</body>

</html>