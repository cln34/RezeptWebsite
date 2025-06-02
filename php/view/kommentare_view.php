<?php
require_once "php/include/head.php";
?>

<body>
  <?php
  include_once "php/include/header.php";
  ?>

  <main>
    <h1>Kommentare</h1>

    <section class="kommentar-container">
      <?php if (empty($comments)): ?>
        Keine Kommentare vorhanden.
        <?php else:
        foreach ($comments as $comment): ?>
          <div class="kommentar-card">
            <h2><?= htmlspecialchars($comment->getEmail()) ?> <span class="kommentar-datum">(Datum einfügen)</span></h2>
            <div class="sterne-anzeige"><?= htmlspecialchars($comment->getSterneBewertung()) ?> Sterne</div>
            <p><?= htmlspecialchars($comment->getInhalt()) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

    <form action="kommentar-eintragen.php" method="post" class="kommentar-form">
      <label for="bewertung">Bewertung:</label>
      <label for="NameBewerter" class="visually-hidden">Name</label>
      <input type="text" id="NameBewerter" placeholder="Name des Bewerters" name="email">
       <?php //TODO: die folgende zeile einfügen wenn Problem mit Sessions behoben wurde, damit automatisch die email des loggedin users übergeben wird: <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>"> ?>
      <input type="hidden" name="rezept_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>"> <!--id des rezepts wird übergeben, damit kommentar diesselbe id bekommt-->
      <div class="sterne-bewertung">
        <fieldset class="sterne-bewertung">
          <legend>Bewertung abgeben</legend>
          <input type="radio" name="sterneBewertung" id="stern5" value="5" required><label for="stern5">★</label>
          <input type="radio" name="sterneBewertung" id="stern4" value="4"><label for="stern4">★</label>
          <input type="radio" name="sterneBewertung" id="stern3" value="3"><label for="stern3">★</label>
          <input type="radio" name="sterneBewertung" id="stern2" value="2"><label for="stern2">★</label>
          <input type="radio" name="sterneBewertung" id="stern1" value="1"><label for="stern1">★</label>
        </fieldset>
      </div>

      <label for="kommentar" class="visually-hidden">Kommentar</label>
      <textarea id="kommentar" placeholder="Kommentar eingeben" name="inhalt" required></textarea>
      <input type="submit" value="Kommentar absenden" class="button">
    </form>
  </main>

  <?php
  include_once "php/include/footer.php"
  ?>
</body>

</html>