<?php
require "database/db_connect.php";
$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 10);

$sql = "UPDATE felhasznalo
        SET token = ?,
            token_lejarat = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($conn->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@nile.hu");
    $mail->addAddress($email);
    $mail->Subject = "Elfelejtett jelszó";
    $mail->Body = <<<END

    Kattints <a href="http://nile.loc/jelszovaltoztatas.php?token=$token">ide</a>, hogy megváltoztasd a jelszavad.<br>
    <b>FIGYELEM!!!</b><br>A link 10 percig érvényes, utána lejár.

    END;

    try {
        $mail->send();

        echo "<div style='text-align:center; margin-top:50px; font-size:20px;'>
        Az email elküldve a megadott címre. Hamarosan visszairányítunk a főoldalra...
        </div>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = '/';
                }, 3000);
            </script>";
        exit;

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}

header('Location: /');