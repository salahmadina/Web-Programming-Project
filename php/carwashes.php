<?php
/* ── Car Wash Places Listing ─────────────────────────── */
require_once 'db.php';
require_once 'session.php';
requireLogin();

/* Fetch all places with their services */
$sql = '
    SELECT
        p.id           AS place_id,
        p.name         AS place_name,
        p.description,
        p.image_path,
        p.location_url,
        s.id           AS service_id,
        s.type         AS service_type,
        s.price
    FROM car_wash_places p
    LEFT JOIN wash_services s ON s.place_id = p.id
    ORDER BY p.id ASC, s.price ASC
';

$result = $conn->query($sql);
$rows   = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

/* Group services under each place */
$places = [];
foreach ($rows as $row) {
    $pid = $row['place_id'];
    if (!isset($places[$pid])) {
        $places[$pid] = [
            'id'           => $pid,
            'name'         => $row['place_name'],
            'description'  => $row['description'],
            'image_path'   => $row['image_path'],
            'location_url' => $row['location_url'],
            'services'     => [],
        ];
    }
    if ($row['service_id']) {
        $places[$pid]['services'][] = [
            'id'    => $row['service_id'],
            'type'  => $row['service_type'],
            'price' => $row['price'],
        ];
    }
}

$badge    = ['Basic' => '#10B981', 'Premium' => '#2563EB', 'Full Service' => '#7C3AED'];
$userName = currentUserName();

include '../html/carwashes.html';
