<?php
include 'Config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare an SQL statement
    $stmt = $con->prepare("DELETE FROM tblproduct WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "
                <script>
                alert('Product successfully deleted.');
                window.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>