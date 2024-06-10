<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'db_connect.php';

        $sql = "SELECT * FROM invoice";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "InvoiceID: " . $row["InvoiceID"]. " - Amount: " . $row["Amount"]. "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>

    
</body>
</html>