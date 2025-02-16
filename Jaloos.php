<?php
    // Database credentials
    $servername = "db5016063673.hosting-data.io";
    $username = "dbu2377863";
    $password = "YaAliMadad51214";
    $dbname = "dbs13085114";
    // $servername = "localhost";
    // $username = "root";
    // $password = "J@ww@d13";
    // $dbname = "IMLU";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process the form data if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_no = $_POST['tel'];
        $profession = $_POST['profession'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $fat = $_POST['fat'];

        // Debugging: Print received values
        error_log("Received values: first_name=$first_name, last_name=$last_name, phone_no=$phone_no, profession=$profession, age=$age, gender=$gender, fat=$fat");

        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO Jaloos_Form_Responses (timestamp, first_name, last_name, phone_no, profession, age, gender, fat) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $first_name, $last_name, $phone_no, $profession, $age, $gender, $fat);

        // Execute the statement and check for success

        if (!$stmt->execute()) {
            echo "Error: ". $stmt->error;
        } else {
            header("Location: index.html?submitted=true");
            exit();
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>