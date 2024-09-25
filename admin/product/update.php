<?php
include 'Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $Record = mysqli_query($con, "SELECT * FROM tblproduct WHERE Id=$id");
    $data = mysqli_fetch_array($Record);

    if (isset($_POST['update'])) {
        $product_name = $_POST['Pname'];
        $product_price = $_POST['Pprice'];
        $product_category = $_POST['Pages'];

        if ($_FILES['Pimage']['name']) {
            $product_image = $_FILES['Pimage'];
            $image_loc = $_FILES['Pimage']['tmp_name'];
            $image_name = $_FILES['Pimage']['name'];
            $image_destination = "Uploadimage/" . $image_name;
            move_uploaded_file($image_loc, $image_destination);
        } else {
            $image_destination = $data['PImage'];
        }

        $stmt = $con->prepare("UPDATE tblproduct SET pName=?, pPrice=?, pImage=?, pCategory=? WHERE Id=?");
        if ($stmt) {
            $stmt->bind_param("sdssi", $product_name, $product_price, $image_destination, $product_category, $id);

            if ($stmt->execute()) {
                echo "
                    <script>
                    alert('Product successfully updated.');
                    window.location.href = 'index.php';
                    </script>
                ";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $con->error;
        }
        $con->close();
    }
} else {
    echo "No product ID received.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background: url('back.jpg') no-repeat center center fixed;
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
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 m-auto border glass mt-3">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 text-warning">Update Product Details</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name: </label>
                        <input type="text" name="Pname" class="form-control" value="<?php echo $data['PName']; ?>"
                            placeholder="Enter Product Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price: </label>
                        <input type="text" name="Pprice" class="form-control" value="<?php echo $data['PPrice']; ?>"
                            placeholder="Enter Product Price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Add Product Image: </label>
                        <input type="file" name="Pimage" class="form-control">
                        <img src="<?php echo $data['PImage']; ?>" height="120px" width="200px">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category: </label>
                        <select class="form-select" name="Pages">
                            <option value="Home" <?php if ($data['PCategory'] == 'Home')
                                echo 'selected'; ?>>All</option>
                            <option value="Laptop" <?php if ($data['PCategory'] == 'Laptop')
                                echo 'selected'; ?>>Clothes
                            </option>
                            <option value="Mobile" <?php if ($data['PCategory'] == 'Mobile')
                                echo 'selected'; ?>>
                                Accessories</option>
                            <option value="Bag" <?php if ($data['PCategory'] == 'Bag')
                                echo 'selected'; ?>>Perfumes
                            </option>
                        </select>
                    </div>
                    <button name="update" class="bg-danger fs-3 fw-bold my-3 form-control text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>