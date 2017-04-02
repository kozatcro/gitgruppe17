<html>

<body>

<?php
$servername = "localhost";
$benutzer = "root";
$passwort = "root";
$db = "bank";

$con = new mysqli($servername, $benutzer, $passwort, $db);

if ($con->connect_error) {
    die("dead" . $con->connect_error);
}

$sql = "SELECT * FROM Konto";

$res = $con->query($sql);

while ($i = $res->fetch_assoc()) {
    echo "Konto: " . $i["kontonummer"] . "<br>";
    echo "Guthaben: " . $i["betrag"] . " €<br><br>";
}

if (isset($_POST["bank"])) {
    $kontonummer = $_POST["bank"]["kontonummer"];
    $einzahlen = $_POST["bank"]["einzahlen"];
    $abheben = $_POST["bank"]["abheben"];

    $aktuellerKontostandSQL = $con->prepare("SELECT betrag,kontonummer from Konto WHERE kontonummer=?");
    $aktuellerKontostandSQL->bind_param("i", $kontonummer);
    $aktuellerKontostandSQL->execute();
    $aktuellerKontostandSQL->bind_result($res_kontostand, $res_kontonummer);
    $aktuellerKontostandSQL->fetch();
    $neuerKontostand = $res_kontostand + $einzahlen - $abheben;

    $aktuellerKontostandSQL->close();

    $sqlKontostandAktualisierung = $con->prepare("UPDATE Konto set betrag=? WHERE kontonummer=?");
    $sqlKontostandAktualisierung->bind_param("ii", $neuerKontostand, $kontonummer);
    $sqlKontostandAktualisierung->execute();
    $sqlKontostandAktualisierung->close();
    header("Refresh:0");
}
?>
<hr>

<form action="bank.php" method="post">
    <table>
        <tr>
            <td>Kontonummer:</td>
            <td><input type="text" name="bank[kontonummer]"></td>
        </tr>
        <tr>
            <td>einzahlen:</td>
            <td><input type="text" name="bank[einzahlen]"></td>
        </tr>
        <tr>
            <td>abheben:</td>
            <td><input type="text" name="bank[abheben]"></td>
        </tr>
    </table>
    <button type="submit">Ausführen</button>
    <button type="reset">Reset</button>
</form>

</body>
</html>