<?php
require_once "php/include/head.php";
?>

<body>
  <?php
  include_once "php/include/header.php";
  ?>

  <main>
    <?php
    require_once "php/include/header.php";
    ?>
    <main>
      <?php if (isset($_SESSION["message"]) && $_SESSION["message"] == "invalid_entry_id"): ?>
        <p>
          Der Kommentar kann leider nicht gefunden werden.
        </p>
      <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "internal_error"): ?>
        <p>
          Es ist ein interner Fehler aufgetreten.
          Bitte versuchen Sie es erneut oder kontaktieren Sie den Administrator.
        </p>
      <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "missing_required_parameters"): ?>
        <p>
          Fehler beim Aufruf der Seite: Es fehlen notwendige Parameter!
        </p>
      <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "new_comment"): ?>
        <p>
          Neuer Kommentar wurde hinzugefügt!
        </p>
      <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "delete_comment"): ?>
        <p>
          Kommentar wurde gelöscht!
        </p>
      <?php elseif (isset($_SESSION["message"]) && $_SESSION["message"] == "no_entry_found"): ?>
        <p>
          Es wurde kein Kommentar zu deiner Suche gefunden!
        </p>

      <?php endif; ?>
      <?php
      unset($_SESSION["message"]);
      ?>
      <h1>Kommentare</h1>

      <section class="kommentar-container">
        <?php if (empty($comments)): ?>
          Keine Kommentare vorhanden.
          <?php else:
          foreach ($comments as $comment): ?>
            <div class="kommentar-card">
              <h2>
                <?= htmlspecialchars($comment->getEmail()) ?>
                <span class="kommentar-datum">
                  <?php
                  $date = new DateTime($comment->getDatum());
                  echo '(' . $date->format('d.m.Y') . ')';
                  ?>
                </span>
              </h2>
              <div class="sterne-anzeige">
                <?php
                $sterne = intval($comment->getSterneBewertung());
                for ($i = 1; $i <= 5; $i++) {
                  if ($i <= $sterne) {
                    echo '<span class="star-gold">&#9733;</span>'; // Gefüllter Stern
                  }
                }
                ?>
              </div>
              <p><?= htmlspecialchars($comment->getInhalt()) ?></p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>

      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) { ?>
        <form action="kommentar-eintragen.php" method="post" class="kommentar-form">
          <label for="bewertung">Bewertung:</label>
          <input type="hidden" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
          <input type="hidden" name="rezept_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>"> <!--id des rezepts wird übergeben, damit kommentar diesselbe id bekommt-->
          <div class="sterne-bewertung">
            <fieldset class="sterne-bewertung">
              <legend>Bewertung abgeben</legend>
              <input type="radio" name="sterneBewertung" id="stern5" value="5"><label for="stern5">★</label>
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
      <?php } ?>
    </main>

    <?php
    include_once "php/include/footer.php"
    ?>
</body>

</html>