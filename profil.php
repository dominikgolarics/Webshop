<?php
    session_start();    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["uname"]); ?></b>.</h1>
    <p>
        <a href="" class="btn btn-warning">Jelszó helyreállítás</a>
        <a href="logout.php" class="btn btn-danger ml-3">Kijelentkezés</a>
    </p>
</body>
</html>