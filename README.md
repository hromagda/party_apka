# 🎉 Apka Oslava

**Webová aplikace pro narozeninovou oslavu**, vytvořená v Laravelu. Umožňuje návštěvníkům:

- přát písničku s uvedením interpreta a jména hosta
- napsat vzkaz oslavenci
- nahrát fotku z oslavy
- a to vše bez nutnosti přihlášení

Aplikace je navíc dostupná jako **PWA** (Progressive Web App), takže si ji uživatelé mohou nainstalovat na plochu mobilu nebo počítače a používat ji i offline.

---

## ✨ Funkce

- ✅ Odeslání přání písničky (interpret, název, jméno hosta)
- ✅ Zobrazení seznamu přání pod formulářem
- ✅ Psání vzkazů pro oslavence
- ✅ Nahrávání a zobrazování fotek
- ✅ PWA podpora – instalace, offline režim, vlastní ikona 🎈
- ✅ Autentifikace přes Laravel Breeze (admin & DJ)
- ✅ Role a oprávnění přes Spatie Laravel Permission
- ✅ Stylování pomocí SCSS a Bootstrapu
- ✅ Mobile-first přístup + responzivní design

---

## ⚙️ Technologie

| Kategorie         | Použité nástroje                                 |
|------------------|--------------------------------------------------|
| Backend          | Laravel 12                                       |
| Frontend         | Vite, Blade, Bootstrap 5, vlastní SCSS           |
| Autentifikace    | Laravel Breeze                                   |
| Role & oprávnění | Spatie Laravel Permission                        |
| Styl & fonty     | Bootstrap + vlastní barvy (#e3f2fd, #ba68c8), písmo Dancing Script |
| PWA              | `manifest.json`, `service-worker.js`, vlastní ikony |
| Databáze         | MySQL (migrace + seedování připravené)           |

---

## 🚀 Instalace (lokálně)

1. Naklonuj repozitář:
```bash
git clone https://github.com/tvoje-uzivatelske-jmeno/apka-oslava.git
cd apka-oslava
```

2. Nainstaluj závislosti a připrav aplikaci:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

3. Spusť projekt:
```bash
npm run dev
php artisan serve
```

---

## 📱 Jak funguje PWA

- aplikace má manifest (`manifest.json`) s názvem, barvou a ikonami
- používá `service-worker.js` pro kešování souborů a offline režim
- lze ji **přidat na plochu** jako mobilní aplikaci
- funguje i bez připojení k internetu

---

## 🔒 Role a přístupy

- **Hosté** mohou přidávat písničky, vzkazy a fotky bez přihlášení
- **Admin a DJ** mají přístup k moderaci obsahu a správě uživatelů (po přihlášení)

---

## 🎨 Styl

Aplikace je navržená mobile-first s barevným stylem:
- světle modré a fialové pozadí (#e3f2fd a #ba68c8)
- elegantní písmo **Dancing Script**
- příjemné zaoblené karty a tlačítka
- rozvržení optimalizované pro menší obrazovky

---

## 📁 Struktura repozitáře

- `resources/views` – Blade šablony
- `public/` – veřejné soubory včetně ikon a service workeru
- `routes/web.php` – webové routy
- `app/Http/Controllers/` – kontrolery
- `database/migrations` – databázové migrace
- `scss/` – vlastní styly (přes Vite)
- `manifest.json` a `service-worker.js` – součást PWA

---

## 💡 Další rozvoj (to-do)

- [ ] Admin rozhraní pro schvalování příspěvků
- [ ] Možnost mazání fotek a přání pro DJ/Admina
- [ ] Statistika přání / oblíbené písničky
- [ ] Animace a přechody (Framer Motion / GSAP)

---

## 👩‍💻 Autor

Vytvořeno jako osobní projekt pro výuku Laravelu, PWA a responzivního designu.  
Mým cílem bylo nejen aplikaci naprogramovat, ale i pochopit její fungování a zpřístupnit ji reálným uživatelům.

---

> Děkuji, že jste se podívali na moji Apku Oslava 🎂 Pokud chcete vidět ukázku v chodu, dejte vědět!
