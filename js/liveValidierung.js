const passwortFeld = document.getElementById("passwort");
const wdhPasswortFeld = document.getElementById("passwortWDH");

function validateWdhPasswortFeld() {
  const pwWDH = wdhPasswortFeld.value;
  const pw = passwortFeld.value;

  wdhPasswortFeld.classList.remove("input-valid", "input-invalid");

  if (pwWDH === "") {
    // Noch nichts eingegeben, keine Klasse setzen
    return;
  }
  if (pwWDH === pw) {
    wdhPasswortFeld.classList.add("input-valid");
  } else {
    wdhPasswortFeld.classList.add("input-invalid");
  }
}

passwortFeld.addEventListener("input", function () {
  const pw = this.value;
  this.classList.remove("input-valid", "input-invalid");

  if (pw.length < 8) {
    this.classList.add("input-invalid");
  } else {
    this.classList.add("input-valid");
  }

  // Wdh-Passwortfeld sofort mitprüfen!
  validateWdhPasswortFeld();
});

wdhPasswortFeld.addEventListener("input", validateWdhPasswortFeld);
