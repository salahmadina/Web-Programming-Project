-- ============================================
--  Car Wash Booking System — Database Setup
--  Run this in phpMyAdmin > SQL tab
-- ============================================

CREATE DATABASE IF NOT EXISTS carwash_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE carwash_db;

-- ── Users ────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100)  NOT NULL,
  email      VARCHAR(100)  NOT NULL UNIQUE,
  password   VARCHAR(255)  NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── Car Wash Places (physical locations) ─────
-- image_path : relative path to photo, e.g. ../images/sparklewash.jpg
--              Leave NULL until you add the photo file
-- location_url: Google Maps link for this place
--               e.g. https://maps.google.com/?q=SparkleWash+Riyadh
CREATE TABLE IF NOT EXISTS car_wash_places (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(100)  NOT NULL,
  description  TEXT,
  image_path   VARCHAR(500)  DEFAULT NULL,
  location_url VARCHAR(500)  DEFAULT NULL
);

-- ── Wash Services (per place) ─────────────────
-- Each place can offer Basic, Premium, and/or Full Service
CREATE TABLE IF NOT EXISTS wash_services (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  place_id INT NOT NULL,
  type     ENUM('Basic','Premium','Full Service') NOT NULL,
  price    DECIMAL(8,2) NOT NULL,
  FOREIGN KEY (place_id) REFERENCES car_wash_places(id) ON DELETE CASCADE
);

-- ── Bookings ──────────────────────────────────
CREATE TABLE IF NOT EXISTS bookings (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  user_id    INT  NOT NULL,
  service_id INT  NOT NULL,
  date       DATE NOT NULL,
  time_slot  TIME NOT NULL,
  status     ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id)    REFERENCES users(id)         ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES wash_services(id) ON DELETE CASCADE
);

-- ── Sample Places ─────────────────────────────
-- TODO: Replace location_url values with real Google Maps links for each place
-- TODO: Add image files to the /images/ folder and update image_path values
INSERT INTO car_wash_places (name, description, image_path, location_url) VALUES
  ('SparkleWash',
   'A fast and friendly car wash in the heart of the city. Get your car sparkling clean in minutes.',
   NULL,
   'https://maps.google.com/?q=SparkleWash'),

  ('Crystal Clean',
   'Premium car wash facility with professional staff and top-quality products.',
   NULL,
   'https://maps.google.com/?q=CrystalClean'),

  ('ProShine Center',
   'Full-service detailing center. We handle everything from a quick rinse to deep interior cleaning.',
   NULL,
   'https://maps.google.com/?q=ProShineCenter'),

  ('GlossGarage',
   'Specialist hand-wash garage. We treat every car like our own with careful attention to detail.',
   NULL,
   'https://maps.google.com/?q=GlossGarage');

-- ── Sample Services per Place ─────────────────
-- SparkleWash (id=1)
INSERT INTO wash_services (place_id, type, price) VALUES
  (1, 'Basic',        7.99),
  (1, 'Premium',     15.99),
  (1, 'Full Service',29.99);

-- Crystal Clean (id=2)
INSERT INTO wash_services (place_id, type, price) VALUES
  (2, 'Basic',        9.99),
  (2, 'Premium',     19.99),
  (2, 'Full Service',39.99);

-- ProShine Center (id=3)
INSERT INTO wash_services (place_id, type, price) VALUES
  (3, 'Basic',        8.99),
  (3, 'Premium',     18.99),
  (3, 'Full Service',49.99);

-- GlossGarage (id=4)
INSERT INTO wash_services (place_id, type, price) VALUES
  (4, 'Basic',        6.99),
  (4, 'Premium',     22.99),
  (4, 'Full Service',44.99);
