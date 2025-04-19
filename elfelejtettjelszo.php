<?php

if(isset($_SESSION['user_id'])){
    header("Location: /");
}

?>

<div class="jelszocsomag">
    <form method="post" action="jelszovaltoztatas-kuldes.php">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <button>Send</button>
    </form>
</div>