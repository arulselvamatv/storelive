<?php
session_start();
unset($_SESSION['sid']);
session_destroy();


header("Location: index.php");



//echo "<script type='text/javascript'>document.location.href='index.php';</script> ";

?>