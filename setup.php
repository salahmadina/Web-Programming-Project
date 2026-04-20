<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS sparkwash CHARACTER SET utf8 COLLATE utf8_general_ci");
    $pdo->exec("USE sparkwash");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id         INT AUTO_INCREMENT PRIMARY KEY,
            fullname   VARCHAR(100) NOT NULL,
            age        TINYINT UNSIGNED NOT NULL,
            phone      VARCHAR(20)  NOT NULL,
            email      VARCHAR(150) NOT NULL UNIQUE,
            username   VARCHAR(50)  NOT NULL UNIQUE,
            password   VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS packages (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            name        VARCHAR(80)  NOT NULL,
            description TEXT,
            price       DECIMAL(6,2) NOT NULL
        )
    ");

    $pdo->exec("
        INSERT IGNORE INTO packages (id, name, description, price) VALUES
        (1, 'Basic Wash',     'Exterior rinse, soap & rinse, air dry', 5.00),
        (2, 'Full Wash',      'Exterior wash, interior vacuum, window cleaning, tire shine', 10.00),
        (3, 'Premium Detail', 'Full wash + wax & polish, interior wipe-down, air freshener', 20.00)
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS bookings (
            id           INT AUTO_INCREMENT PRIMARY KEY,
            user_id      INT NOT NULL,
            package_id   INT NOT NULL,
            booking_date DATE NOT NULL,
            time_slot    TIME NOT NULL,
            status       ENUM('pending','in_progress','done','cancelled') DEFAULT 'pending',
            notes        TEXT,
            created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id)    REFERENCES users(id)    ON DELETE CASCADE,
            FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE RESTRICT
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contacts (
            id         INT AUTO_INCREMENT PRIMARY KEY,
            name       VARCHAR(100) NOT NULL,
            email      VARCHAR(150) NOT NULL,
            subject    VARCHAR(200) NOT NULL,
            message    TEXT         NOT NULL,
            sent_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS reviews (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            user_id     INT NOT NULL,
            booking_id  INT NOT NULL,
            rating      TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
            comment     TEXT,
            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id)    REFERENCES users(id)    ON DELETE CASCADE,
            FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
        )
    ");

    echo '<div style="font-family:sans-serif;max-width:500px;margin:60px auto;text-align:center;">';
    echo '<h2 style="color:green;">&#10003; SparkWash database created!</h2>';
    echo '<p>Tables created: <strong>users, packages, bookings, contacts, reviews</strong></p>';
    echo '<p style="margin-top:16px;"><a href="signup.html">Sign Up</a> &nbsp;|&nbsp; <a href="signin.html">Sign In</a></p>';
    echo '<p style="color:red;margin-top:20px;font-size:0.9rem;"><strong>Delete setup.php now for security.</strong></p>';
    echo '</div>';

} catch (PDOException $e) {
    echo '<h2 style="font-family:sans-serif;color:red;">Error: ' . $e->getMessage() . '</h2>';
}
