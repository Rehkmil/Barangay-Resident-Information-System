<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function e($v) { return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8'); }
function token() { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_token() { if (!hash_equals(token(), $_POST['csrf'] ?? '')) { http_response_code(403); exit('Invalid form token. Go back and try again.'); } }
function flash($message, $type='success') { $_SESSION['flash'] = [$message, $type]; }
function show_flash() { if (!empty($_SESSION['flash'])) { [$m,$t] = $_SESSION['flash']; echo '<div class="alert '.e($t).'">'.e($m).'</div>'; unset($_SESSION['flash']); } }
function nav() { echo '<header><div class="wrap nav"><a class="brand" href="index.php"><b>B</b><span>BRIS<small>Barangay Resident Information System</small></span></a><nav><a href="index.php">Home</a><a href="officials.php">Officials</a><a href="residents.php">Residents</a><a href="resident_form.php">Registration</a><a href="households.php">Households</a><a href="reports.php">Reports</a></nav></div></header>'; }
function start_page($title) { echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($title).' | BRIS</title><link rel="stylesheet" href="assets/style.css"></head><body>'; nav(); }
function end_page() { echo '<footer><div class="wrap">BRIS · Student project demonstration</div></footer></body></html>'; }
