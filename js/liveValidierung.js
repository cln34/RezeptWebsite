const passwortFeld = document.getElementById("passwort");
const wdhPasswortFeld = document.getElementById("passwortWDH");
const passwortError = document.getElementById("passwort-error");
const passwortWDHError = document.getElementById("passwortWDH-error");

function validatePasswortFeld() {
  const pw = passwortFeld.value;
  passwortFeld.classList.remove("input-valid", "input-invalid");
  passwortError.textContent = "";

  if (pw.length < 8) {
    passwortFeld.classList.add("input-invalid");
    passwortError.textContent = "Das Passwort muss mindestens 8 Zeichen lang sein.";
  } else {
    passwortFeld.classList.add("input-valid");
  }

  // Wdh-Passwortfeld sofort mitprüfen!
  validateWdhPasswortFeld();
}

function validateWdhPasswortFeld() {
  const pwWDH = wdhPasswortFeld.value;
  const pw = passwortFeld.value;
  wdhPasswortFeld.classList.remove("input-valid", "input-invalid");
  passwortWDHError.textContent = "";

  if (pwWDH === "") {
    return;
  }
  if (pwWDH === pw && pw.length >= 8) {
    wdhPasswortFeld.classList.add("input-valid");
  } else {
    wdhPasswortFeld.classList.add("input-invalid");
    passwortWDHError.textContent = "Die Passwörter stimmen nicht überein!";
  }
}

passwortFeld.addEventListener("input", validatePasswortFeld);
wdhPasswortFeld.addEventListener("input", validateWdhPasswortFeld);
