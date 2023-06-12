<?php
    $s = "SELECT * FROM reg WHERE id='$_SESSION[id]'";
    $qu = mysqli_query($conn, $s);
?>