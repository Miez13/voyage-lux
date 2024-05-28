<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database Connection</title>
    </head>

    <body>
        <?php
            $servername = "localhost:3308"; // Your server name (usually 'localhost')
            $username = "root"; // Your MySQL username
            $password = ""; // Your MySQL password (usually empty for local development)
            $database = "voyagelux"; // Your database name

        $conn = new mysqli($servername, $username, $password, $database);
        ?>
    </body>
</html>
