<?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: index.php"); // nur eingeloggte user können auf diese seite
  exit;
}
// Aufbereitung der Daten fuer die Ausgabe (View)
$titel = isset($_SESSION["titel"]) ? $_SESSION["titel"] : "";
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";

$kurzbeschreibung = isset($_SESSION["kurzbeschreibung"]) ? $_SESSION["kurzbeschreibung"] : ""; //prüfung ob es die veriable bereits gibt, wenn nein wird sie auf einen leeren string gesetzt
$dauer = isset($_SESSION["dauer"]) ? $_SESSION["dauer"] : "";
$schwierigkeit = isset($_SESSION["schwierigkeit"]) ? $_SESSION["schwierigkeit"] : "";
$preis = isset($_SESSION["preis"]) ? $_SESSION["preis"] : "";
$zutaten = isset($_SESSION["zutaten"]) ? $_SESSION["zutaten"] : "";
$menge = isset($_SESSION["menge"]) ? $_SESSION["menge"] : "";
$anleitung = isset($_SESSION["anleitung"]) ? $_SESSION["anleitung"] : "";
$bild = isset($_SESSION["bild"]) ? $_SESSION["bild"] : "";

unset($_SESSION["titel"]);
//unset($_SESSION["email"]);

unset($_SESSION["kurzbeschreibung"]);
unset($_SESSION["dauer"]);
unset($_SESSION["schwierigkeit"]);
unset($_SESSION["preis"]);
unset($_SESSION["zutaten"]);
unset($_SESSION["menge"]);
unset($_SESSION["anleitung"]);
unset($_SESSION["bild"]);

//************************************************************************************
// TODO: Die variaben von oben mit werten belegen, damit man die createEntry funktion aufrufen kann
//************************************************************************************
?>



<?php
require_once "php/include/head.php";
?>

<body>

  <?php
  include_once "php/include/header.php";
  ?>

  <main class="rezeptErstellen">
    <form action="eintrag-eintragen.php" method="post" enctype="multipart/form-data">
      <h1>Rezept erstellen</h1>

      <div class="form-row">
        <label for="titel">Rezepttitel</label>
        <input type="text" id="titel" name="titel" required />
      </div>

      <div class="form-row">
        <label for="bild">Bild hochladen</label>
        <input type="file" id="bild" name="bild" accept="image/*" />
        <img id="bild-vorschau" src="#" alt="Bildvorschau" style="display: none; max-width: 300px; margin-top: 10px;" />
      </div>

      <div class="form-row">
        <label for="zutaten">Zutaten</label>
        <div id="zutaten-container">
          <div class="zutat-eintrag">
            <select id="zutaten" name="zutaten[]" required>
              <option value="" disabled selected>-- Zutat wählen --</option>
              <option value="Mehl">Mehl</option>
              <option value="Zucker">Zucker</option>
              <option value="Eier">Eier</option>
              <option value="Milch">Milch</option>
              <option value="Butter">Butter</option>
              <option value="Salz">Salz</option>
              <option value="Pfeffer">Pfeffer</option>
              <option value="Olivenöl">Olivenöl</option>
              <option value="Sahne">Sahne</option>
              <option value="Hefe">Hefe</option>
              <option value="Backpulver">Backpulver</option>
              <option value="Vanillezucker">Vanillezucker</option>
              <option value="Zimt">Zimt</option>
            </select>
            <label for="menge" class="visually-hidden">Menge</label>
            <input type="text" id="menge" name="menge[]" placeholder="Menge (z. B. 200g)" required>
          </div>
        </div>
      </div>

      <button class="addZutat-button" type="button" onclick="addZutat()">Weitere Zutat hinzufügen</button>

      <div class="form-row">
        <label for="anleitung">Zubereitung</label>
        <textarea id="anleitung" name="anleitung" rows="6" required></textarea>
      </div>

      <div class="form-row">
        <label for="kurzbeschreibung">Kurzbeschreibung</label>
        <textarea id="kurzbeschreibung" name="kurzbeschreibung" rows="3"></textarea>
      </div>

      <div class="form-row">
        <label for="dauer">Dauer (in Minuten)</label>
        <input type="number" id="dauer" name="dauer" min="1" max="180" required />
      </div>

      <div class="form-row">
        <label for="schwierigkeit">Schwierigkeit</label>
        <select id="schwierigkeit" name="schwierigkeit" required>
          <option value="" disabled selected>-- Schwierigkeit wählen --</option>
          <option value="leicht">leicht</option>
          <option value="mittel">mittel</option>
          <option value="schwer">schwer</option>
        </select>
      </div>

      <div class="form-row">
        <label for="preis">Preis angeben (max 50€):</label>
        <input type="number" id="preis" name="preis" min="0" max="50" step="1" required />
      </div>

      <!--um die email des autors mit zu übergeben -->
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />

      <input type="submit" value="Rezept speichern" />
    </form>

  </main>


  <?php
  include_once "php/include/footer.php"
  ?>

  <script>
    document.getElementById('bild').addEventListener('change', function (event) {
      const file = event.target.files[0];
      const preview = document.getElementById('bild-vorschau');

      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
      } else {
        preview.src = '#';
        preview.style.display = 'none';
      }
    });
  </script>

  <script>
    // Funktion fügt zusätzliche Zutaten hinzu
    function addZutat() {
      const container = document.getElementById('zutaten-container');
      const index = container.children.length;

      // Neues Zutaten/Mengen-Paar als HTML
      const div = document.createElement('div');
      div.className = 'zutat-eintrag';
      div.innerHTML = `
    <select id="zutaten" name="zutaten[]" required>
      <option value="" disabled selected>-- Zutat wählen --</option>
      <option value="Mehl">Mehl</option>
      <option value="Zucker">Zucker</option>
      <option value="Eier">Eier</option>
      <option value="Milch">Milch</option>
      <option value="Butter">Butter</option>
      <option value="Salz">Salz</option>
      <option value="Pfeffer">Pfeffer</option>
      <option value="Olivenöl">Olivenöl</option>
      <option value="Sahne">Sahne</option>
      <option value="Hefe">Hefe</option>
      <option value="Backpulver">Backpulver</option>
      <option value="Vanillezucker">Vanillezucker</option>
      <option value="Zimt">Zimt</option>
    </select>
    <input type="text" name="menge[]" placeholder="Menge (z. B. 200g)" required>
    <button class="removeZutat-button" type="button" onclick="this.parentNode.remove()">Zutat entfernen</button>
  `;
      container.appendChild(div);
    }
  </script>
</body>

</html>