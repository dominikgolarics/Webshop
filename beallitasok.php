<?php
    $sql = "SELECT * FROM felhasznalo WHERE id = '".$_SESSION["user_id"]."'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
?>

<div id="beallitasok-tartalom">
    <label for="name">Név</label>
    <input type="text" id="nev" value='<?php echo htmlspecialchars($user['nev']); ?>'>
    <label for="name">Irányítószám</label>
    <input type="text" id="irszam" value='<?php echo htmlspecialchars($user['iranyitoszam']); ?>'>
    <label for="name">Cím</label>
    <input type="text" id="cim" value='<?php echo htmlspecialchars($user['cim']); ?>'>
    <label for="name">Város</label>
    <input type="text" id="varos" value='<?php echo htmlspecialchars($user['varos']); ?>'>
    <label for="name">Email cím</label>
    <input type="email" id="email" value='<?php echo htmlspecialchars($user['email']); ?>'>
    <label for="name">Telefonszám</label>
    <input type="text" id="telefon" value='<?php echo htmlspecialchars($user['telefonszam']); ?>'>
    <br>
    <button id="mentes" name="mentes">Adatok mentése</button>

    <script src="/script.js"></script>
</div>

