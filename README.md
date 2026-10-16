# Hindbærsnitten Child Theme

Et child-theme til **Twenty Twenty-Five** med farver inspireret af en hindbærsnitte. Indeholder:
- `theme.json` med farver, typografi og blokstile
- Skabeloner for forside, arkiv og enkeltvisning
- Skabeloner (hvis du har CPT'en `anmeldelse`)
- Mønstre (patterns): hero og anmeldelseskort
- Simpel CSS til badges, kort mm.

## Installation
1. Sørg for at temaet **Twenty Twenty-Five** er installeret og aktiverbart.
2. Upload mappen `hindbaersnitten-child` til `/wp-content/themes/`.
3. Aktiver **Hindbærsnitten (Child of Twenty Twenty-Five)** i WordPress.
4. Gå til **Udseende → Editor** for at justere skabeloner og stilarter.

## Sider
- Forsiden bruger mønstret *Forsidehero* og lister seneste indlæg.
- `Kort over anmeldelser`-skabelonen (page-kort.html) har en placeholder til et shortcode `[hindkort]`.

## Noter
- Badge for karakter viser shortcode `[krymmel]` – udskift/implementér i dit plugin.
- Farver: Raspberry(#b10f3a), Jam(#d81b60), Shortbread(#f5e6cc), Icing(#fff8f4), Chocolate(#4e342e), Mint(#6fcf97).