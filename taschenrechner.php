<html>
<head>
</head>

<body>

<div>Ergebnis:
    <?php
    if (isset($_GET["rechner"]))
        switch ($_GET["rechner"]["operation"]) {
            case "plus":
                echo $_GET["rechner"]["zahl1"] + $_GET["rechner"]["zahl2"];
                break;
            case "minus":
                echo $_GET["rechner"]["zahl1"] - $_GET["rechner"]["zahl2"];
                break;
            case "mal":
                echo $_GET["rechner"]["zahl1"] * $_GET["rechner"]["zahl2"];
                break;
            case "geteilt":
                echo $_GET["rechner"]["zahl1"] / $_GET["rechner"]["zahl2"];
                break;
        }
    ?>
</div>

<form action="taschenrechner.php" method="get">
    <p>Zahl1: <input type="text" name="rechner[zahl1]" size=40 maxlength=40></p>
    <p>Zahl2: <input type="text" name="rechner[zahl2]" size=40 maxlength=40></p>

    <p><input type="radio" name="rechner[operation]" value="plus" checked>PLUS</p>
    <p><input type="radio" name="rechner[operation]" value="minus">MINUS</p>
    <p><input type="radio" name="rechner[operation]" value="mal">MAL</p>
    <p><input type="radio" name="rechner[operation]" value="geteilt">GETEILT</p>

    <button type="submit">Berechne</button>
    <button type="reset">Reset</button>
</form>


</body>
</html>