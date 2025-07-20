<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<?php require_once "php/include/head.php"; ?>

<body>
  <?php include_once "php/include/header.php"; ?>

  <main class="anmeldung-main">
    <h1>Impressum</h1>

<p>RezeptWebsite<br />
Ammerl&auml;nder Heerstra&szlig;e 114-118<br />
26129 Oldenburg</p>

<p><strong>Vertreten durch:</strong><br />
Colin Bolbas<br />
Sascha Busse<br />
Christoph Rettig</p>

<h2>Kontakt</h2>
<p>Telefon: &#91;Telefonnummer&#93;<br />
E-Mail:  info@rezeptwebsite.de</p>

<h2>Verbraucher&shy;streit&shy;beilegung/Universal&shy;schlichtungs&shy;stelle</h2>
<p>Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>

<p>Quelle: <a href="https://www.e-recht24.de">https://www.e-recht24.de</a></p>
</main>
  <?php include_once "php/include/footer.php"; ?>
</body>
</html>
