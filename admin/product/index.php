<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
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

        .navbar-light .navbar-brand {
            color: #fff;
        }

        .text-warning {
            color: #fff !important;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bg-danger {
            background: rgba(220, 53, 69, 0.2) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .tex {

            background: -webkit-linear-gradient(#00224D, #FF204E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 m-auto border glass mt-3">
                <form action="insert.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 tex">Product Details</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label tex fw-bold">Product Name: </label>
                        <input type="text" name="Pname" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price: </label>
                        <input type="text" name="Pprice" class="form-control" placeholder="Enter Product Price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Add Product Image: </label>
                        <input type="file" name="Pimage" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Quantity: </label>
                        <input type="text" name="Pquantity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category: </label>
                        <select class="form-select" name="Pages">

                            <option value="Laptop">Laptop</option>
                            <option value="Mobiles">Mobiles</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <button name="submit" class="bg-danger fs-3 fw-bold my-3 form-control text-white">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 m-auto">
                <table class="table border border-danger table-hover glass my-5">
                    <thead class="bg-dark text-white fs-5 font-monospace text-center">

                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Delete</th>

                    </thead>
                    <tbody class="text-center">
                        <?php
                        include 'Config.php';
                        $Record = mysqli_query($con, "SELECT * FROM tblproduct");
                        while ($row = mysqli_fetch_array($Record)) {
                            echo "
                            <tr>
                                
                                <td class='text-white fs-5'>$row[PName]</td>
                                <td class='text-white fs-5'>$row[PPrice]</td>
                                <td class='text-white fs-5'><img src='$row[PImage]' height='120px' width='200px'></td>
                                <td class='text-white fs-5'>$row[Pquantity]</td>
                                <td class='text-white fs-5'>$row[PCategory]</td>
                                <td class='text-white fs-5'><a href='delete.php?id=$row[Id]' class='btn btn-danger'>Delete</a></td>
                                
                                </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>