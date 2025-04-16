<?php
session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['kijelentkezes_sikeres'] = true;
header("location: /");
exit;
?> 