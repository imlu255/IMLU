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

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Membership(timestamp, name, family_members, dob, address, postcode, tele, tel, terms) VALUES (current_timestamp(), ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $head_name, $numInputs, $dob, $address, $postcode, $tele, $tel, $agree_terms);

    // Set parameters and execute
    $head_name = $_POST['head_name'];
    $numInputs = $_POST['numInputs'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $tele = $_POST['tele'];
    $tel = $_POST['tel'];

    // Check if the 'agree_terms' checkbox is checked
    $agree_terms = isset($_POST['agree_terms']) ? 1 : 0;

    // Execute the statement
    $stmt->execute();

    echo "New record created successfully";

    $stmt->close();
    $conn->close();

    // Redirect to a thank you page or back to the form
    header("Location: index.html");
    exit();
?>
