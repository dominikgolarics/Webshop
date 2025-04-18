<?php
    $sql = "SELECT * FROM felhasznalo WHERE id = '".$_SESSION["user_id"]."'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
?>

<div id="beallitasok-tartalom">
    <label>Név</label>
    <input type="text" id="nev" value='<?php echo htmlspecialchars($user['nev']); ?>'>
    <label>Irányítószám</label>
    <input type="text" id="irszam" value='<?php echo htmlspecialchars($user['iranyitoszam']); ?>'>
    <label>Cím</label>
    <input type="text" id="cim" value='<?php echo htmlspecialchars($user['cim']); ?>'>
    <label>Város</label>
    <input type="text" id="varos" value='<?php echo htmlspecialchars($user['varos']); ?>'>
    <label>Email cím</label>
    <input type="email" id="email" value='<?php echo htmlspecialchars($user['email']); ?>'>
    <label>Telefonszám</label>
    <input type="text" id="telefon" value='<?php echo htmlspecialchars($user['telefonszam']); ?>'>
    <br>
    <button id="mentes" name="mentes">Adatok mentése</button>

    <script src="/script.js"></script>
</div>

