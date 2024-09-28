# Vehicle Parking Management System

## Opis Projekta

**Vehicle Parking Management System** je aplikacija napravljena u **Laravel framework-u** sa glavnom svrhom omogućavanja korisnicima da **rezervišu i upravljaju parking mestima**. Sistem podržava tri vrste korisnika:

- **Admin** – Upravlja celim sistemom, dodeljuje uloge i upravlja kategorijama parking mesta.
- **Manager** – Može da pregleda korisnike i upravlja njima.
- **User** – Može da rezerviše parking mesta i upravlja svojim rezervacijama.

Aplikacija koristi:

- **Laravel** za backend.
- **Bouncer** za upravljanje ulogama i dozvolama.
- **Laravel Breeze** za autentifikaciju.

## Instalacija

1. **Klonirajte projekat:**
   ```bash
   git clone https://github.com/saarrka/ParkingProject.git
2. **Uđite u direktorijum projekta:**

   ```bash
   cd ParkingProject
3. **Instalirajte zavisnosti:**

   ```bash
   composer install
   npm install
   npm run dev
   
4. **Generišite aplikacioni ključ:**

   ```bash
   php artisan key:generate

5. **Podesite bazu podataka u .env fajlu i izvršite migracije:**

   ```bash
   php artisan migrate
6. **Pokrenite seeding kako bi se kreirali admina, menadžera i 150 slobodnih parking mesta:**

   ```bash
   php artisan db:seed

## Kako koristiti

1. Registrujte novog korisnika (user) ili se prijavite sa postojećim admin ili menadžer nalozima.
2. **Admin** može da dodeli upravlja korisnicima, njihovim ulogama, kategorijama vozila, kao i samim vozilima.
3. **Korisnici** mogu rezervisati parking mesta putem korisničkog interfejsa i upravljati sopstvenim rezervacijama.
4. **Menadžeri** mogu da pregledaju listu svih korisnika.
