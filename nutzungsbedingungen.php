<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION["email"])) {
    echo $_SESSION["email"];
}
?>
<?php
require_once "php/include/head.php";
?>

<body>

    <?php
    include_once "php/include/header.php";
    ?>

    <main class="anmeldung-main">

  <h1>Nutzungsbedingungen</h1>

  <p><em>Stand: Juli 2025</em></p>

  <h2>1. Geltungsbereich</h2>
  <p>
    Diese Nutzungsbedingungen gelten für die Nutzung der Website „RezeptWebsite“, einem studentischen Projekt im Rahmen einer Lehrveranstaltung an der Carl von Ossietzky Universität Oldenburg. Durch die Registrierung und Nutzung dieser Website erklären Sie sich mit diesen Bedingungen einverstanden.
  </p>

  <h2>2. Registrierung und Benutzerkonto</h2>
  <p>
    Für bestimmte Funktionen ist eine Registrierung erforderlich. Die Angabe einer gültigen E-Mail-Adresse und die Zustimmung zu diesen Nutzungsbedingungen und der Datenschutzerklärung sind verpflichtend. Die Zugangsdaten sind vertraulich zu behandeln und dürfen nicht an Dritte weitergegeben werden.
  </p>

  <h2>3. Inhalte und Nutzungsrechte</h2>
  <p>
    Nutzer können eigene Inhalte (z. B. Rezepte, Kommentare, Bilder) auf der Plattform veröffentlichen. Mit dem Hochladen räumen Sie den Betreibern dieser Website ein einfaches, zeitlich unbegrenztes und nicht-exklusives Nutzungsrecht zur Darstellung und Veröffentlichung Ihrer Inhalte auf dieser Plattform ein.
  </p>
  <p>
    Sie versichern, dass Sie über die notwendigen Rechte an den bereitgestellten Inhalten verfügen und keine Rechte Dritter (z. B. Urheberrecht, Persönlichkeitsrecht) verletzen.
  </p>

  <h2>4. Verhaltensregeln</h2>
  <ul>
    <li>Es dürfen keine beleidigenden, diskriminierenden, jugendgefährdenden oder rechtswidrigen Inhalte veröffentlicht werden.</li>
    <li>Spam, Werbung oder automatisierte Inhalte sind untersagt.</li>
    <li>Verstöße gegen diese Regeln können zum Ausschluss von der Plattform führen.</li>
  </ul>

  <h2>5. Moderation und Löschung von Inhalten</h2>
  <p>
    Die Betreiber behalten sich vor, Inhalte jederzeit und ohne Angabe von Gründen zu löschen, insbesondere wenn sie gegen die genannten Regeln verstoßen oder unangemessen erscheinen.
  </p>

  <h2>6. Haftungsausschluss</h2>
  <p>
    Die Inhalte auf dieser Website wurden mit größtmöglicher Sorgfalt erstellt. Dennoch übernehmen die Betreiber keine Gewähr für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte. Die Nutzung erfolgt auf eigene Verantwortung.
  </p>

  <h2>7. Änderungen der Nutzungsbedingungen</h2>
  <p>
    Diese Nutzungsbedingungen können bei Bedarf angepasst werden. Über wesentliche Änderungen werden registrierte Nutzer per E-Mail informiert.
  </p>

  <h2>8. Kontakt</h2>
  <p>
    Bei Fragen oder Hinweisen wenden Sie sich bitte an:  
    <a href="mailto:info@rezeptwebsite.de">info@rezeptwebsite.de</a>
  </p>

  <p><em>Diese Website ist ein nicht-kommerzielles, studentisches Projekt und dient ausschließlich zu Lehrzwecken im Rahmen eines universitären Seminars.</em></p>

</main>


    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>
