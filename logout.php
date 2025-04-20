<?php
session_start();
session_unset(); //ürít
session_destroy(); //töröl

session_start();
$_SESSION['kijelentkezes_sikeres'] = true;
header("location: /");
exit;
?> 