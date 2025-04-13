<?php
    session_destroy(); // Destroy all session data
    header("Location: ../login.php");
?>