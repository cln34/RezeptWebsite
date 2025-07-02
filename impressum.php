<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<?php require_once "php/include/head.php"; ?>

<body>
  <?php include_once "php/include/header.php"; ?>

  <main class="anmeldung-main">
    <h2>Impressum</h2>

    <p><strong>Angaben gemäß § 5 TMG:</strong></p>

    <ul>
      <li>Colin Bolbas – <a href="mailto:colin.bolbas@uni-oldenburg.de">colin.bolbas@uni-oldenburg.de</a></li>
      <li>Sascha Busse – <a href="mailto:sascha.busse@uni-oldenburg.de">sascha.busse@uni-oldenburg.de</a></li>
      <li>Christoph Rettig – <a href="mailto:christoph.rettig@uni-oldenburg.de">christoph.rettig@uni-oldenburg.de</a></li>
    </ul>

    <p><strong>Kontakt:</strong></p>
    <p>
      E-Mail: <a href="mailto:info@rezeptwebsite.de">info@rezeptwebsite.de</a><br>
      Carl von Ossietzky Universität Oldenburg<br>
      Ammerländer Heerstraße 114–118<br>
      26129 Oldenburg
    </p>

    <p><strong>Verantwortlich im Sinne des § 5 TMG und § 55 Abs. 2 RStV:</strong></p>
    <ul>
      <li>Colin Bolbas – <a href="mailto:colin.bolbas@uni-oldenburg.de">colin.bolbas@uni-oldenburg.de</a></li>
      <li>Sascha Busse – <a href="mailto:sascha.busse@uni-oldenburg.de">sascha.busse@uni-oldenburg.de</a></li>
      <li>Christoph Rettig – <a href="mailto:christoph.rettig@uni-oldenburg.de">christoph.rettig@uni-oldenburg.de</a></li>
    </ul>

    <p><em>Dies ist ein studentisches Projekt im Rahmen einer Lehrveranstaltung und dient ausschließlich zu Lernzwecken.</em></p>
  </main>

  <?php include_once "php/include/footer.php"; ?>
</body>
</html>
