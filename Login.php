<?php
// Start session
session_start();

$conn = mysqli_connect("db5016063673.hosting-data.io", "dbu2377863", password: "YaAliMadad51214", database: "dbs13085114");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["u_name"];
    $password = $_POST["pwd_name"];

    // Query database for user credentials
    $query = "SELECT * FROM admin_login WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Directly compare plaintext password
        if ($password === $row["password"]) {
            // Login successful, set session variables
            $_SESSION["name"] = $name;
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row["role"];
            header("Location: admin.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}

// Close database connection
mysqli_close($conn);
?>