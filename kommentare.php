<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Rezeptesammlung">
    <meta name="author" content="Sascha Busse, Christoph Rettig, Colin Bolbas">
    <link rel="stylesheet" href="css/main.css" />
    <title>StudiRezepte-Einfach & Günstig</title>
</head>

<body>
    <?php
    include "php/header.php";
    ?>
    <hr />
    <main>
        <h1>Kommentare: </h1>
        <h3>Colin: (datum einfügen)</h3>
        <p>Ich finde die Pizza müsste länger im Ofen sein, ansonsten sehr lecker</p>
        <br>
        <h3>Sascha: (datum einfügen)</h3>
        <p>Einfach fabelhaft!</p>
        <br>
        <h3>Chris: (datum einfügen)</h3>
        <p>Da muss mehr Käse drauf!</p>
        <hr><br>
        <form action="">
            <textarea placeholder="Kommentar eingeben" name="Kommentar" required></textarea>
            <input type="submit" value="Kommentar absenden" id="KommentarValue">
        </form>
    </main>
    <hr><br>
    <?php
    include "php/footer.php"
    ?>
</body>

</html>