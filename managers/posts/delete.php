<?php

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include_once('database/db_connect.php');

    $sql = "DELETE FROM posts WHERE id=$id";
    $result = $conn->query($sql);
    
    if ($result) {
        ?>
        <script>
            window.location.href = "/posts.php";
        </script>
        <?php
    }
    exit;
}
?>