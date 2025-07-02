Team DI-12-B
Namen der Studierenden:
- Busse
- Rettig
- Bolbas
Abgabe zu Aufgabenblatt 6

Hinweise:
Umgesetzt (Aufgabenblatt 6):
-Sicherheit (SQL-Injection, XSS, CSRF)
-Ein paar Verbesserungsvorschläge von Blatt 5 eingebaut
-Registrierung mit datenschutzkonformem Opt-In-Verfahren
-Zustimmung zu Datenschutz & Nutzungsbedingungen via Checkbox
-Impressum, Datenschutzerklärung, Nutzungsbedingungen integriert


Nicht umgesetzt (Aufgabenblatt 6):
-Nutzung von Diensten: WebServices und APIs -> Wir haben keine sinnvolle Möglichkeit gefunden WebServices oder APIs einzubauen und da sie bspw. bei Google oder Facebook Diensten auch datenschutzrechtliche Probleme mit sich ziehen
-Wenn man bei der Demo-Email auf den Anmelden Knopf drückt, könnte man den neuen Tab schließen und wieder den aktuellen auf die Anmeldung.php schicken (mit JavaScript)


Umgesetzt (mit Sessions):
- Rezepte erstellen, bearbeiten, löschen
- Rezepte suchen (Index und Favouriten)
- User registrieren, anmelden und abmelden 
- Userliste ansehen

Umgesetzt mit Datenbank:
- Rezepte erstellen, bearbeiten, löschen (Nur für Ersteller eines Rezeptes oder für Admins)
- Rezepte suchen (Index und Favoriten)
- User registrieren, anmelden und abmelden 
- Userliste ansehen und User löschen (Nur für Admin)
- Mehrere Zutaten und Mengen können in der Datenbank gespeichert werden
- Favoriten speichern, abrufen und entfernen
- User können bei Rezepten Bilder hochladen und diese werden in der Datenbank gespeichert 
- Kommentare schreiben und anzeigen (mit Datum und Email des Autors)

Umgesetzt mit JavaScript:
- Bei Rezept erstellen und Rezpt bearbeiten kann man mehrere Zutaten und Mengen hinzufügen oder wieder entfernen
- Sortierfunktion auf Indexseite und Favoritenseite
- Vorschaubild bei Rezepterstellen, wenn Bild hochgeladen ist 
- Passwordvalidierung bei Registrierung (hat ein Passwort passend viele Zeichen und Stimmen Passwörter überein)
- LiveSuche auf Indexseite (mind. zwei Zeichen) - AJAX-Technologie


Noch nicht umgesetzt:
- User bearbeiten (Situation noch nicht vorhanden, vielleicht bei Passwort vergessen)
- Bessere Sicherheit bei Nutzereingaben
- Teilweise Responsives Design für größere Bildschirme verbessern (aktuell noch viel freie Fläche)
- Mehrere Anleitungsschritte hinzufügen 
- Kommentare mit Sessions
