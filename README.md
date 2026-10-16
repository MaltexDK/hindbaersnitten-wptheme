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
3. Opret et tilsvarende stabilt tag, fx `git tag v1.0.1`, og push det med `git push origin v1.0.1`.
4. Workflowet afviser uoverensstemmelse mellem tag og version, bygger ZIP,
   uploader den til en draft release og publicerer derefter releasen.

Workflowet bruger repositoryets `GITHUB_TOKEN` med `contents: write` til release-jobbet.
GitHub Actions skal være aktiveret. Installér den navngivne ZIP, ikke GitHubs
“Source code”-arkiv. ZIP-filen indeholder ikke tests, workflows, backups eller `desktop.ini`.

Byg lokalt: `python3 scripts/build-release.py --tag v1.0.1`.
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
