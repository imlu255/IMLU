<?php
session_start();
require_once "auth.php";

if (!is_logged_in()) {
    header("Location: index.html");
    exit;
}

if (!has_role("admin")) {
    echo "You do not have permission to access this page";
    exit;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Imamia Mission London UK</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            @media only screen and (min-width: 1480px) and (max-width: 1548px) {
                .navbar-nav {
                    margin-left: 700px;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Imamia Mission London UK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./View_ECM.php">Committee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./View_Jaloos.php">Jaloos Volunteers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./View_Contact.php">Contact Responses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container my-5">
            <h2>Contact Form Responses</h2>
            <br>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Timestamp</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <?php
                    $servername = "db5016063673.hosting-data.io";
                    $username = "dbu2377863";
                    $password = "YaAliMadad51214";
                    $dbname = "dbs13085114";
                    // $servername = "localhost";
                    // $username = "root";
                    // $password = "J@ww@d13";
                    // $dbname = "IMLU";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection Failed: " . $conn->connect_error);
                    }

                    $sql = "select * from Contact_Form_Responses";
                    $result = $conn->query($sql);

                    if(!$result) {
                        die("Invalid Query: ". $conn->error);
                    }

                    $submission_count = 0;

                    while($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>$row[timestamp]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[message]</td>
                                <td>
                                    <a class='btn btn-danger btn-sm' href='CDelete.php?id=$row[id]'>Delete</a>
                                </td>
                            </tr>
                        ";
                        $submission_count++;
                    }
                ?>
            </table>
            <p><strong>Total Submissions: <?php echo $submission_count; ?></strong></p>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>