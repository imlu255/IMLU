<?php
function is_logged_in() {
    if (isset($_SESSION["username"])) {
        return true;
    } else {
        return false;
    }
}

function has_role($required_role) {
    if (isset($_SESSION["role"]) && $_SESSION["role"] == $required_role) {
        return true;
    } else {
        return false;
    }
}
?>