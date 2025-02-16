<?php
    if(isset($_GET["id"])) {
        $id = $_GET["id"];

        $servername = "db5016063673.hosting-data.io";
        $username = "dbu2377863";
        $password = "YaAliMadad51214";
        $dbname = "dbs13085114";
        // $servername = "localhost";
        // $username = "root";
        // $password = "J@ww@d13";
        // $dbname = "IMLU";

        $connection = new mysqli($servername, $username, $password, $dbname);

        $sql = "DELETE FROM Contact_Form_Responses WHERE id=$id";
        $connection->query($sql);
    }

    header("Location: View_Contact.php");
    exit;
?>