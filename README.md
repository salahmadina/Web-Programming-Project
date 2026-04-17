# 🚗 SparkleWash — Car Wash Booking System

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

A full-stack car wash booking web application built with PHP, MySQL, HTML, CSS, and JavaScript. Users can browse car wash locations, choose a service type, and book a time slot — all from the browser.

---

## ✨ Features

- 🔐 User registration and login (session-based auth)
- 🏪 Browse multiple car wash places, each with Basic / Premium / Full Service options
- 📅 Book a time slot (today or tomorrow only)
- 🚫 One active booking per user — must cancel before booking again
- ❌ Cancel pending bookings
- 📍 Location button per place (Google Maps link)
- 🖼️ Photo slot per place (ready for images)
- 📋 View full booking history in "My Bookings"

---

## 🖥️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Backend | PHP 8.x |
| Database | MySQL / MariaDB (via XAMPP) |
| Server | Apache (via XAMPP) |

---

## ⚙️ Setup & Installation

### Prerequisites
- [XAMPP](https://www.apachefriends.org) installed (Apache + MySQL)
- A browser (Chrome, Firefox, Edge)

---

### Step 1 — Clone the Repository

```bash
git clone https://github.com/YOUR_USERNAME/Web-Programming-Project.git
```

Then move (or copy) the project folder into your XAMPP `htdocs` directory:

| OS | Path |
|----|------|
| Windows | `C:\xampp\htdocs\` or `D:\xampp\htdocs\` |
| macOS | `/Applications/XAMPP/htdocs/` |
| Linux | `/opt/lampp/htdocs/` |

The final path should look like:
```
xampp/htdocs/Web-Programming-Project/
```

---

### Step 2 — Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Click **Start** next to **Apache**
3. Click **Start** next to **MySQL**

Both should show green status indicators.

---

### Step 3 — Create the Database

1. Open your browser and go to:
   ```
   http://localhost/phpmyadmin
   ```
2. Click **New** in the left sidebar
3. Enter database name: `carwash_db`
4. Click **Create**

---

### Step 4 — Import Tables & Sample Data

1. Select `carwash_db` from the left sidebar in phpMyAdmin
2. Click the **SQL** tab at the top
3. Open the file `database.sql` from the project root
4. Copy **all** its contents and paste them into the SQL input box
5. Click **Go**

This creates 4 tables (`users`, `car_wash_places`, `wash_services`, `bookings`) and inserts 4 sample car wash locations with 3 service types each.

---

### Step 5 — Verify Database Connection

Open `php/db.php` and confirm the settings match your XAMPP setup:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');          // Leave blank — default XAMPP has no password
define('DB_NAME', 'carwash_db');
```

If you set a MySQL root password in XAMPP, update `DB_PASS` accordingly.

---

### Step 6 — Open the Project

Go to:
```
http://localhost/Web-Programming-Project/html/index.html
```

---

## 🗺️ User Flow

```
Landing Page (index.html)
    ↓
Sign Up  →  Login
    ↓
Car Wash Places  (carwashes.php)
    ↓
Choose a place + service type  →  Book Now
    ↓
Booking Form  (booking.html)
    ↓  select date & time
Booking Confirmed  (booking-confirm.php)
    ↓
My Bookings  (my-bookings.php)
    ↓
Cancel if needed  (booking-cancel.php)
```

---

## 📁 Project Structure

```
Web-Programming-Project/
├── html/
│   ├── index.html          # Landing page
│   ├── login.html          # Login form
│   ├── signup.html         # Registration form
│   ├── booking.html        # Booking form
│   ├── booking-cancel.html # Cancel confirmation
│   └── booking-confirm.html
│
├── php/
│   ├── db.php              # Database connection
│   ├── session.php         # Session helpers
│   ├── login.php           # Auth handler
│   ├── signup.php          # Registration handler
│   ├── logout.php          # Logout
│   ├── carwashes.php       # Places listing page
│   ├── booking.php         # Booking form handler
│   ├── booking-confirm.php # Confirmation page
│   ├── booking-cancel.php  # Cancel handler
│   └── my-bookings.php     # User booking history
│
├── css/                    # Stylesheets per page
├── js/
│   ├── auth.js             # Login/signup JS
│   ├── booking.js          # Booking form JS
│   └── listing.js          # Listing page JS
│
├── images/                 # Place photos (add your own)
├── database.sql            # Full DB schema + sample data
└── README.md
```

---

## 🗄️ Database Schema

```
users               car_wash_places
─────────           ───────────────────
id (PK)             id (PK)
name                name
email               description
password            image_path
created_at          location_url

wash_services       bookings
─────────────       ────────────────────
id (PK)             id (PK)
place_id (FK)       user_id (FK)
type                service_id (FK)
price               date
                    time_slot
                    status
                    created_at
```

---

## 📸 Adding Place Photos

1. Add your image files to the `images/` folder (e.g. `images/sparklewash.jpg`)
2. In phpMyAdmin, update the `image_path` column in `car_wash_places`:
   ```sql
   UPDATE car_wash_places SET image_path = '../images/sparklewash.jpg' WHERE id = 1;
   ```

## 📍 Adding Real Locations

Update the `location_url` column with a real Google Maps link:
```sql
UPDATE car_wash_places SET location_url = 'https://maps.google.com/?q=YOUR+ADDRESS' WHERE id = 1;
```

---

## 👥 Team

| Student | Responsible Files |
|---------|------------------|
| Student 1 | `index`, `about`, `contact`, `login`, `signup` (HTML + CSS + PHP) · `auth.js` |
| Student 2 | `carwashes`, `carwash-detail`, `search`, `gallery`, `faq` (HTML + CSS + PHP) · `listing.js` |
| Student 3 | `booking`, `booking-confirm`, `booking-cancel`, `my-bookings`, `profile` (HTML + CSS + PHP) · `booking.js` |

---

## 📝 License

This project is for educational purposes. MIT License.
