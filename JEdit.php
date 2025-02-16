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

    $first_name = "";
    $last_name = "";
    $phone_no = "";
    $profession = "";
    $age = "";
    $gender = "";
    $fat = "";

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Get method: Show the data of the client

        if(!isset($_GET["id"])) {
            header("Location: View_Jaloos.php");
            exit;
        }

        $id = $_GET["id"];

        $sql = "SELECT * FROM Jaloos_Form_Responses WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if(!$row) {
            header("Location: View_Jaloos1.php");
            exit;
        }

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone_no = $row['phone_no'];
        $profession = $row['profession'];
        $age = $row['age'];
        $gender = $row['gender'];
        $fat = $row['fat'];
    } else {
        // POST method: Update the data of the client

        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_no = $_POST['tel'];
        $profession = $_POST['profession'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $fat = $_POST['fat'];

        do {
            if ( empty($id) || empty($first_name) || empty($last_name) || empty($phone_no) || empty($profession) || empty($age) || empty($gender) || empty($fat) ) {
                $errorMessage = "All the fields are required";
                break;
            }

            $sql = "UPDATE Jaloos_Form_Responses SET first_name = ?, last_name = ?, phone_no = ?, profession = ?, age = ?, gender = ?, fat = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $first_name, $last_name, $phone_no, $profession, $age, $gender, $fat, $id);
            $stmt->execute();
            if(!$stmt) {
                $errorMessage = "Invalid Query: " . $conn->error;
                break;
            }

            $successMessage = "Updated successfully";

            header("Location: View_Jaloos.php");
            exit;

        } while (false);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="Images/Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imamia Mission London UK</title>
    <link rel="stylesheet" href="Volunteer-for-the-jaloos.css">
    <script src="https://kit.fontawesome.com/3bf10b99f3.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="scroll">
        <section class="welcome">

            <?php
                if (!empty($errorMessage)) {
                    echo "<script>alert('$errorMessage')</script>";
                }
            ?>

            <form class="modal-content animate" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="imgcontainer">
                    <img src="./Images/logo1.png" alt="Avatar" class="avatar1">
                </div>
                <div class="container">
                    <h1 class="membership-title" style="color: #258d14;">Jaloos Application Form</h1>
                    <label><b>First Name</b></label>
                    <input type="text" name="first_name" placeholder="Enter Name" value="<?php echo $first_name ?>" required><br><br>
                    <label><b>Last Name</b></label>
                    <input type="text" name="last_name" placeholder="Enter Name" value="<?php echo $last_name ?>" required><br><br>
                    <label><b>Phone Number</b></label>
                    <input type="tel" name="tel" placeholder="Enter Phone Number" value="<?php echo $phone_no ?>" required><br><br>
                    <label><b>Profession</b></label>
                    <input type="text" name="profession" placeholder="Enter Profession" value="<?php echo $profession ?>" required><br><br>
                    <label><b>Age</b></label>
                    <input type="number" name="age" placeholder="Enter Age" value="<?php echo $age ?>" required><br><br>
                    <label><b>Gender</b></label><br>
                    <input type="radio" name="gender" value="Male" <?php if($gender == "Male") echo "checked"; ?>> Male<br>
                    <input type="radio" name="gender" value="Female" <?php if($gender == "Female") echo "checked"; ?>> Female<br><br>
                    <label><b>Are you First Aid Qualified? Yes or No</b></label>
                    <input type="text" name="fat" placeholder="Are you trained for First Aid" value="<?php echo $fat ?>" required><br><br>

                    <?php
                        if(!empty($successMessage)) {
                            echo "<script>alert('$successMessage')</script>";
                        }
                    ?>

                    <button type="submit">Volunteer</button>
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn"><a href="View_Jaloos.php" style="text-decoration: none; color: white">Cancel</a></button>
                </div>
            </form>
        </section>
    </section>
    <script src="script.js"></script>
</body>
</html>