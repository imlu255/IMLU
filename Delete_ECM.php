<?php
    // Database connection details
    $servername = "db5016063673.hosting-data.io";
    $username = "dbu2377863";
    $password = "YaAliMadad51214";
    $dbname = "dbs13085114";
    // $servername = "localhost";
    // $username = "root";
    // $password = "J@ww@d13";
    // $dbname = "IMLU";
    $id = $_POST["id"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming you have a unique identifier for the row, let's call it 'id'
    if ($row["id"] == $id) {
        $deleteQuery = "DELETE FROM ECM WHERE id = $id";

        if ($conn->query($deleteQuery) === TRUE) {
            header("Location: ./View_ECM.php");
        } else {
            echo "Error deleting row: " . $conn->error;
        }
    } else {
        echo "Error";
    }

    $conn->close();
?>
