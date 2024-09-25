<?php
session_start();
include 'Config.php';

if (!isset($_SESSION['c_id'])) {
    echo "
        <script>
        alert('Please log in to add items to the cart.');
        window.location.href = 'user_login.php';
        </script>
    ";
    exit();
}

$product_name = $_POST['PName'] ?? null;
$product_price = $_POST['PPrice'] ?? null;
$product_quantity = $_POST['PQuantity'] ?? null;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['addCart'])) {
    $check_product = array_column($_SESSION['cart'], 'productName');
    if (in_array($product_name, $check_product)) {
        echo "
            <script>
            alert('Product already added');
            window.location.href = 'index.php';
            </script>
        ";
    } else {
        $_SESSION['cart'][] = [
            'productName' => $product_name,
            'productPrice' => $product_price,
            'productQuantity' => $product_quantity
        ];

        $c_id = $_SESSION['c_id'];
        // Ensure subquery returns a single row
        $query = "INSERT INTO order_table (c_id, Id, PPrice, PQuantity, order_date) 
                  VALUES (?, (SELECT Id FROM tblproduct WHERE PName = ? LIMIT 1), ?, ?, NOW()) ";
        $stmt = $con->prepare($query);
        $stmt->bind_param("isdi", $c_id, $product_name, $product_price, $product_quantity);
        $stmt->execute();
        $stmt->close();

        header("Location: viewCart.php");
    }
}

if (isset($_POST['remove'])) {
    $o_id = $_POST['o_id'];
    $c_id = $_SESSION['c_id'];

    $query = "DELETE FROM order_table WHERE o_id = ? AND c_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $o_id, $c_id);
    $stmt->execute();
    $stmt->close();

    header("Location: viewCart.php");
    exit();
}

if (isset($_POST['update'])) {
    $o_id = $_POST['o_id'];
    $product_quantity = $_POST['PQuantity'];
    $c_id = $_SESSION['c_id'];

    $query = "UPDATE order_table SET PQuantity = ? WHERE o_id = ? AND c_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iii", $product_quantity, $o_id, $c_id);
    $stmt->execute();
    $stmt->close();

    header("Location: viewCart.php");
    exit();
}

$con->close();
?>