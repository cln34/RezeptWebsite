// Zeigt alle Elemente mit der Klasse .js-only an, sobald JS aktiv ist
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".js-only").forEach(function (el) {
    el.style.display = "inline-block"; // Alternativ: 'block' oder Flex, je nach Layout
  });

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
  const index = container.children.length;

  // Neues Zutaten/Mengen-Paar als HTML
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
  </select>
  <input type="text" name="menge[]" placeholder="Menge (z. B. 200g)" required>
  <button class="removeZutat-button" type="button" onclick="this.parentNode.remove()">Zutat entfernen</button>
`;
  container.appendChild(div);
}

function addAnleitung() {
  const container = document.getElementById("anleitungen");
  const index = container.children.length;

  // Neues Anleitungsschritt-Element als HTML
  const div = document.createElement("div");
  div.className = "anleitung-eintrag";
  div.innerHTML = `
    <textarea id="anleitung-${index}" name="anleitung[]" rows="4" required placeholder="Schritt ${
    index + 1
  }"></textarea>
    <button class="removeZutat-button js-only" type="button" onclick="this.parentNode.remove()">Entfernen</button>
  `;
  container.appendChild(div);

  // Entfernen-Buttons anzeigen/nicht anzeigen
  const eintraege = container.querySelectorAll(".anleitung-eintrag");
  eintraege.forEach((eintrag, i) => {
    const btn = eintrag.querySelector(".removeZutat-button");
    if (btn) {
      btn.style.display = i === 0 ? "none" : "inline-block";
    }
    const textarea = eintrag.querySelector("textarea");
    if (textarea) {
      textarea.placeholder = `Schritt ${i + 1}`;
      textarea.id = `anleitung-${i}`;
    }
  });
}
