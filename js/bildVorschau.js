document.getElementById("bild").addEventListener("change", function (event) {
  const file = event.target.files[0];
  const preview = document.getElementById("bild-vorschau");
  const overlay = document.getElementById("bild-overlay");
  const gross = document.getElementById("bild-gross");

  if (file && file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = "block";
      gross.src = e.target.result;
    };

    reader.readAsDataURL(file);
  } else {
    preview.src = "#";
    preview.style.display = "none";
    gross.src = "#";
  }
});

// Klick auf Vorschau öffnet Overlay
document.getElementById("bild-vorschau").addEventListener("click", function () {
  const overlay = document.getElementById("bild-overlay");
  if (this.src && this.style.display !== "none") {
    overlay.style.display = "flex";
  }
});

// Klick auf Overlay schließt es wieder
document.getElementById("bild-overlay").addEventListener("click", function () {
  this.style.display = "none";
});
