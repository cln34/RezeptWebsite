// Zeigt alle Elemente mit der Klasse .js-only an, sobald JS aktiv ist
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".js-only").forEach(function (el) {
    el.style.display = "inline-block"; // Alternativ: 'block' oder Flex, je nach Layout
  });
  updateAnleitungNummerierung();
  updateZutatenButtons();
  const container = document.getElementById("anleitungen");
  if (container) {
    const eintraege = container.querySelectorAll(".anleitung-eintrag");
    eintraege.forEach((eintrag, i) => {
      const btn = eintrag.querySelector(".removeZutat-button");
      btn.style.display = eintraege.length > 1 ? "inline-block" : "none";
    });
  }
});

// Funktion fügt zusätzliche Zutaten hinzu
function addZutat() {
  const container = document.getElementById("zutaten-container");
  const div = document.createElement("div");
  div.className = "zutat-eintrag";
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
              <option value="Basilikum">Basilikum</option>
              <option value="Pinienkerne">Pinienkerne</option>
              <option value="Parmesan">Parmesan</option>
              <option value="Knoblauch">Knoblauch</option>
              <option value="Spaghetti">Spaghetti</option>
              <option value="Hackfleisch">Hackfleisch</option>
              <option value="Tomaten">Tomaten</option>
              <option value="Zwiebel">Zwiebel</option>
              <option value="Mozzarella">Mozzarella</option>
              <option value="Tomatensauce">Tomatensauce</option>
            </select>
  <input type="text" name="menge[]" placeholder="Menge (z. B. 200g)" required>
  <button class="removeZutat-button" type="button" onclick="this.parentNode.remove(); updateZutatenButtons();">Zutat entfernen</button>
`;
  container.appendChild(div);
  updateZutatenButtons();
}

function updateAnleitungNummerierung() {
  const container = document.getElementById("anleitungen");
  const eintraege = container.querySelectorAll(".anleitung-eintrag");
  eintraege.forEach((eintrag, i) => {
    const textarea = eintrag.querySelector("textarea");
    if (textarea) {
      textarea.placeholder = `Schritt ${i + 1}`;
      textarea.id = `anleitung-${i}`;
    }
    const btn = eintrag.querySelector(".removeZutat-button");
    if (btn) {
      btn.style.display = i === 0 ? "none" : "inline-block";
    }
  });
}

function addAnleitung() {
  const container = document.getElementById("anleitungen");
  const div = document.createElement("div");
  div.className = "anleitung-eintrag";
  div.innerHTML = `
    <textarea name="anleitung[]" rows="4" required></textarea>
    <button class="removeZutat-button js-only" type="button" onclick="this.parentNode.remove(); updateAnleitungNummerierung();">Schritt Entfernen</button>
  `;
  container.appendChild(div);
  updateAnleitungNummerierung();
}

function updateZutatenButtons() {
  const container = document.getElementById("zutaten-container");
  const eintraege = container.querySelectorAll(".zutat-eintrag");
  eintraege.forEach((eintrag, i) => {
    const btn = eintrag.querySelector(".removeZutat-button");
    if (btn) {
      btn.style.display = eintraege.length > 1 ? "inline-block" : "none";
    }
  });
}
