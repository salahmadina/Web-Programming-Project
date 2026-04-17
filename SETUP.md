# SparkleWash — Setup Guide

## Step 1: Install XAMPP
Download from https://www.apachefriends.org and install.
Make sure **Apache** and **MySQL** are checked during installation.

## Step 2: Copy Project Files
Copy the entire `Web-Programming-Project` folder into:
```
C:\xampp\htdocs\Web-Programming-Project\
```

## Step 3: Start Apache & MySQL
Open **XAMPP Control Panel** → click **Start** for both **Apache** and **MySQL**.

## Step 4: Create the Database
1. Open your browser → go to `http://localhost/phpmyadmin`
2. Click **New** in the left sidebar
3. Database name: `carwash_db` → click **Create**

## Step 5: Import Tables & Sample Data
1. Select `carwash_db` in the left sidebar
2. Click the **SQL** tab
3. Open `database.sql` from this project folder
4. Copy ALL its contents and paste into the SQL box → click **Go**

You should now see 3 tables: `users`, `car_washes`, `bookings`
And 6 sample car wash entries will be inserted automatically.

## Step 6: Verify Database Connection
Open `php/db.php`. Default settings:
```php
DB_HOST = 'localhost'
DB_USER = 'root'
DB_PASS = ''          // Leave blank for default XAMPP
DB_NAME = 'carwash_db'
```
If you set a MySQL password in XAMPP, update `DB_PASS`.

## Step 7: Open the Project in Browser
Go to:
```
http://localhost/Web-Programming-Project/html/index.html
```

## Project Flow
1. Landing page → Sign Up → creates account
2. Login → redirected to Car Washes listing
3. Click "Book Now" on any card → Booking form
4. Fill date (today/tomorrow) + time → Confirm
5. View bookings at "My Bookings"
6. Cancel pending bookings if needed

---

## Team Division

| File Group | Student |
|---|---|
| index, about, contact, login, signup (HTML+CSS+PHP) + auth.js | **Student 1** |
| carwashes, carwash-detail, search, gallery, faq (HTML+CSS+PHP) + listing.js | **Student 2** |
| booking, booking-confirm, booking-cancel, my-bookings, profile (HTML+CSS+PHP) + booking.js | **Student 3** |

---

## Notes
- Passwords stored with `password_hash()` — secure by default
- Sessions handled via `php/session.php`
- Booking date limited to today/tomorrow (enforced in both JS and PHP)
- 10-minute arrival policy displayed on booking + confirmation pages
