<?php
if (isset($_POST['submit'])) {
    include 'Config.php';
    $product_name = $_POST['Pname'];
    $product_quantity = $_POST['Pquantity'];
    $product_price = $_POST['Pprice'];
    $product_image = $_FILES['Pimage'];
    $image_loc = $_FILES['Pimage']['tmp_name'];
    $image_name = $_FILES['Pimage']['name'];
    $image_destination = "Uploadimage/" . $image_name;

    // Check if the image upload was successful
    if (move_uploaded_file($image_loc, $image_destination)) {
        $product_category = $_POST['Pages'];

        // Prepare an SQL statement
        $stmt = $con->prepare("INSERT INTO tblproduct (pName, pPrice, pImage, pCategory, Pquantity) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sdssi", $product_name, $product_price, $image_destination, $product_category,$product_quantity);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Product successfully added.";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        echo "Failed to upload image.";
    }

    // Close the database connection
    $con->close();
}
?>
