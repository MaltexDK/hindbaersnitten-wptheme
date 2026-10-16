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
- Forsiden viser indholdet fra siden valgt under **Indstillinger → Læsning → En statisk side**. Tilføj overskrift, tekst, billeder og Snitter-blokke på selve siden.
- `Kort over anmeldelser`-skabelonen (page-kort.html) har en placeholder til et shortcode `[hindkort]`.

## Noter
- Badge for karakter viser shortcode `[krymmel]` – udskift/implementér i dit plugin.
- Farver: Raspberry(#b10f3a), Jam(#d81b60), Shortbread(#f5e6cc), Icing(#fff8f4), Chocolate(#4e342e), Mint(#6fcf97).

## GitHub-opdateringer

Plugin Update Checker **5.6** er inkluderet i `lib/plugin-update-checker`
(MIT; uændret upstream-kode fra tag `v5.6` hos
[YahnisElsts/plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker)).
WordPress kontrollerer normalt opdateringer cirka hver 12. time. Kun den seneste
publicerede, stabile GitHub Release med filen **`hindbaersnitten-child.zip`** bruges.
Tags, prereleases og almindelige pushes tilbydes ikke som opdateringer.
Der kræves ingen GitHub-token på WordPress-serveren for dette offentlige repository.
Serveren skal kunne kontakte `api.github.com`, `github.com`, `raw.githubusercontent.com`
og GitHubs download-domæner over HTTPS. GitHubs grænser for anonyme API-kald gælder.

### Første installation og automatiske opdateringer

Installer ZIP-filen fra GitHub Releases manuelt første gang, og erstat den gamle
version gennem WordPress. Bevar mappen `hindbaersnitten-child`.
Aktivér derefter automatiske opdateringer for temaet under Udseende → Temaer.
WordPress styrer, om og hvornår opdateringen installeres; updateren ændrer ikke
administratorens valg. WP-Cron og skriveadgang til installationsmappen skal virke.
Temaet kræver Twenty Twenty-Five og skal være aktivt, for at den indbyggede updater kører.
Filer i installationsmappen erstattes ved opdatering. Gem egne kodeændringer
uden for pakken. Tag backup før første opdatering.

### Udgiv en ny version

1. Opdatér `Version` i `style.css`.
2. Commit og push ændringerne. Workflowet kontrollerer PHP-syntaks og bygger ZIP på branches og pull requests.
3. Opret et tilsvarende stabilt tag, fx `git tag v1.2.0`, og push det med `git push origin v1.2.0`.
4. Workflowet afviser uoverensstemmelse mellem tag og version, bygger ZIP,
   uploader den til en draft release og publicerer derefter releasen.

Workflowet bruger repositoryets `GITHUB_TOKEN` med `contents: write` til release-jobbet.
GitHub Actions skal være aktiveret. Installér den navngivne ZIP, ikke GitHubs
“Source code”-arkiv. ZIP-filen indeholder ikke tests, workflows, backups eller `desktop.ini`.

Byg lokalt: `python3 scripts/build-release.py --tag v1.2.0`.
Output er `dist/hindbaersnitten-child.zip` (ikke committed).

### Kontrol før første udgivelse

Test på en skrivbar WordPress-testinstallation med en ældre updater-version:
kontrollér opdateringsbesked, manuel opdatering og derefter en ny udgave via
WordPress' automatiske opdateringer. Kontrollér versionsnummer, aktivering og
bevarede indstillinger. Test begge komponenter aktive samtidigt.
Det lokale cloud-miljø har skrivebeskyttede repository-mounts og kan derfor
ikke bruges til selve filudskiftningen uden separate skrivbare testkopier.

Integrationstest (med begge komponenter aktive):
`php tests/github-updates.php /path/to/wordpress/wp-load.php`.
Testen simulerer GitHub-svar og kontrollerer stabile releases, drafts,
prereleases, manglende eller forkerte ZIP-filer og manglende releases.


## Design i version 1.1.0

Varm glasurfarvet baggrund, kagefarvede sektioner og hindbærrøde accenter.
Fraunces bruges til overskrifter og Manrope til tekst og navigation; begge
skrifter er inkluderet lokalt som WOFF2 med SIL OFL-licenser i `assets/fonts`.
Temaet sender ingen forespørgsler til eksterne skrifttjenester.

Fælles afstandsskala, 720 px læsebredde og op til 1180 px til brede oversigter.
Indlægskort står i tre kolonner på pc, to på tablet og én på mobil.
Menu, knapper og afstande tilpasses mindre skærme. Fokusmarkeringer og
reduceret bevægelse understøttes. Anmeldelsespluginets flader følger temaets farver.
Sideindhold og API-data ændres ikke ved temaopdateringen.

WordPress kan have gemt ændringer i skabeloner, header/footer eller globale
stilarter gennem webstedseditoren. Sådanne ændringer har forrang over temafilerne
og overskrives ikke automatisk. Hvis det nye layout ikke ses, skal de pågældende
tilpasninger gennemgås under Udseende → Editor. Gem en kopi af egne tilpasninger,
før de eventuelt nulstilles. Genanvendte mønstre i eksisterende indhold opdateres
heller ikke automatisk, hvis de blev indsat som almindelige blokke.

Lokale kontroller:
`php tests/theme-config.php /path/to/wordpress/wp-load.php` og
`python3 scripts/build-release.py --tag v1.2.0`.

`screenshot.png` viser det nye tema med eksempeltekst; eksemplerne tilføjes ikke til hjemmesidens indhold.


## Header i version 1.2.0

På skærme over 1024 px står logoet over en indrammet, kagefarvet menulinje.
Ved 1024 px og derunder står logo og burgermenu ved siden af hinanden.
Menuen har tydelig hover-/fokusmarkering, hindbærrød markering af den aktuelle
side og indrammede undermenuer. Lange menuer kan stå over to rækker på pc.

WordPress' valgte webstedslogo bruges. Er intet logo valgt, viser temaet det
medfølgende `assets/images/hindbaersnitten-logo.png`. Logo og menupunkter kan
fortsat redigeres med de almindelige Webstedslogo- og Navigation-blokke.
Der oprettes ikke en ny menu, og eksisterende menuer ændres ikke.

### Hvis du har redigeret headeren i WordPress

En gemt header i webstedseditoren har forrang over `parts/header.html`.
Åbn **Udseende → Editor**, find din header under **Mønstre → Skabelondele**,
og gem eventuelt en kopi af den før ændring. Erstat dens layout med mønstret
**Header – logo og menulinje** fra temaets mønstre, eller nulstil headeren til
temaets udgave, hvis du ønsker at fjerne egne headertilpasninger.
Vælg din eksisterende menu i Navigation-blokken og det ønskede logo i
Webstedslogo-blokken. Gem ændringerne. De præcise menunavne kan variere med
WordPress-version og sprog. Opdateringen nulstiller ikke dine tilpasninger automatisk.

## Statisk forside fra version 1.2.1

Forsideskabelonen indeholder Indlægsindhold mellem header og footer. Den indsætter
ikke længere et fast introafsnit eller en indlægsliste. Rediger din valgte side
under Sider for at ændre indholdet, inklusive eventuel hovedoverskrift.
Hvis en tidligere Forside-skabelon er gemt i webstedseditoren, har den forrang.
Gem en kopi af egne tilpasninger og nulstil Forside under Udseende → Editor →
Skabeloner, eller erstat manuelt det faste indhold med blokken Indlægsindhold.
