<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<?php require_once "php/include/head.php"; ?>

<body>
  <?php include_once "php/include/header.php"; ?>

  <main class="anmeldung-main">
    <h1>Datenschutzerklärung</h1>

    <p><strong>1. Allgemeine Hinweise</strong></p>
    <p>Der Schutz Ihrer persönlichen Daten ist uns ein wichtiges Anliegen. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.</p>

    <p><strong>2. Verantwortliche Stelle</strong></p>
    <p>
        Verantwortlich im Sinne der Datenschutz-Grundverordnung (DSGVO) sind:<br>
        Colin Bolbas, Sascha Busse, Christoph Rettig<br>
        Carl von Ossietzky Universität Oldenburg<br>
        Ammerländer Heerstraße 114–118<br>
        26129 Oldenburg<br>
        E-Mail: <a href="mailto:info@rezeptwebsite.de">info@rezeptwebsite.de</a>
    </p>

    <p><strong>3. Art der verarbeiteten Daten</strong></p>
    <ul>
        <li>E-Mail-Adresse (zur Registrierung)</li>
        <li>Passwort (verschlüsselt gespeichert)</li>
    </ul>

    <p><strong>4. Zweck der Datenverarbeitung</strong></p>
    <p>Die Verarbeitung erfolgt ausschließlich zur Verwaltung von Benutzerkonten und zur Nutzung der Funktionen dieser Website.</p>

    <p><strong>5. Weitergabe von Daten</strong></p>
    <p>Ihre Daten werden nicht an Dritte weitergegeben. Es erfolgt keine Übermittlung in Drittländer.</p>

    <p><strong>6. Cookies und Plugins</strong></p>
    <p><em>Diese Website verwendet keine Cookies und keine externen Plugins.</em></p>

    <p><strong>7. Ihre Rechte</strong></p>
    <p>Sie haben das Recht auf Auskunft, Berichtigung, Löschung und Einschränkung der Verarbeitung Ihrer personenbezogenen Daten. Außerdem haben Sie ein Beschwerderecht bei einer Aufsichtsbehörde.</p>

    <p><strong>8. Sicherheit</strong></p>
    <p>Wir setzen technische und organisatorische Maßnahmen ein, um Ihre Daten vor Verlust oder unbefugtem Zugriff zu schützen.</p>

    <p><em>Hinweis: Diese Website ist ein studentisches Projekt im Rahmen einer Lehrveranstaltung und dient ausschließlich zu Lern- und Demonstrationszwecken.</em></p>
  </main>

  <?php include_once "php/include/footer.php"; ?>
</body>
</html>
