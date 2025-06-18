document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("rezeptSuche");
    let rezeptListe = document.getElementById("rezeptListe");
    const sortSelect = document.getElementById("sortierung");

    if (!input || !rezeptListe) return;

    function ladeRezepte() {
        const query = input.value.trim();
        const sortierung = sortSelect ? sortSelect.value : 'datum_desc';
        const params = new URLSearchParams();
        if (query.length >= 2) params.append('query', query);
        params.append('sortierung', sortierung);

        fetch(`live-suche.php?${params.toString()}`)
            .then(response => response.text())
            .then(html => {
                // Ersetze das gesamte Rezept-Listen-Element
                const temp = document.createElement('div');
                temp.innerHTML = html;
                const newListe = temp.querySelector('#rezeptListe');
                if (newListe) {
                    rezeptListe.replaceWith(newListe);
                    rezeptListe = newListe; // Referenz aktualisieren
                }
            });
    }

    input.addEventListener("input", ladeRezepte);

    // Rezepte auch bei Sortierung ändern
    if (sortSelect) {
        sortSelect.addEventListener("change", ladeRezepte);
    }
});