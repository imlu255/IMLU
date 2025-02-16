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
    $table = "Jaloos_Form_Responses";   // e.g., "my_table"

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from table
$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

// Prepare CSV file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Jaloos_Volunteers.csv');
$output = fopen('php://output', 'w');

// Display field/column names as first row
$columns = $result->fetch_fields();
$headers = [];
foreach ($columns as $column) {
    $headers[] = $column->name;
}
fputcsv($output, $headers);

// Display data rows
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>