<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobiles</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container fluid mt-3">

        <div class="col-md-12">
            <div class="row">
                <h1 class="text-white font-monospace text-center my-3 glass">Others</h1>
                <?php
                include 'Config.php';
                $Record = mysqli_query($con, "SELECT * FROM tblproduct");
                while ($row = mysqli_fetch_array($Record)) {
                    $check_page = $row['PCategory'];
                    if ($check_page === 'Others') {
                        if ($row['Pquantity'] > 0) {
                            echo "
                        <div class='col-md-6 col-lg-4 m-auto mb-3'>
                            <form action='Insertcart.php' method='post'>
                                <div class='card m-auto' style='width: 18rem;'>
                                    <img src='../admin/product/{$row['PImage']}' class='card-img-top m-auto' style='width:270px; height:300px' alt='...'>
                                    <div class='card-body text-center'>
                                        <h5 class='card-title text-white fs-4 fw-bold'>{$row['PName']}</h5>
                                        <p class='card-text text-white fs-4 fw-bold'>price: {$row['PPrice']}</p>
                                        <input type='hidden' name='PName' value='{$row['PName']}'>
                                        <input type='hidden' name='PPrice' value='{$row['PPrice']}'>
                                        <input type='number' name='PQuantity' min='1' max='20' placeholder='Quantity'><br><br>
                                        <input type='submit' name='addCart' class='btn btn-danger text-white w-100' value='Add to Cart'>
                                    </div>
                                </div>
                            </form>
                        </div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>

</html>