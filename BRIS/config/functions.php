<?php

// Start a session when one is not already active.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Safely escape values before displaying them in HTML.
function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

// Create or return the current form security token.
function token()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

// Reject form submissions with an invalid security token.
function verify_token()
{
    $submittedToken = $_POST['csrf'] ?? '';

    if (!hash_equals(token(), $submittedToken)) {
        http_response_code(403);
        exit('Invalid form token. Go back and try again.');
    }
}

// Store a message to show after a redirect.
function flash($message, $type = 'success')
{
    $_SESSION['flash'] = [$message, $type];
}

// Display and clear the saved message.
function show_flash()
{
    if (empty($_SESSION['flash'])) {
        return;
    }

    [$message, $type] = $_SESSION['flash'];

    echo '<div class="alert ' . e($type) . '">';
    echo e($message);
    echo '</div>';

    unset($_SESSION['flash']);
}

// Display the shared site navigation.
function nav()
{
    ?>
    <header>
        <div class="wrap nav">
            <a class="brand" href="index.php">
                <b>B</b>
                <span>
                    BRIS
                    <small>Barangay Resident Information System</small>
                </span>
            </a>

            <nav>
                <a href="index.php">Home</a>
                <a href="officials.php">Officials</a>
                <a href="residents.php">Residents</a>
                <a href="resident_form.php">Registration</a>
                <a href="households.php">Households</a>
                <a href="reports.php">Reports</a>
            </nav>
        </div>
    </header>
    <?php
}

// Open the HTML page and include shared styles/navigation.
function start_page($title)
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= e($title) ?> | BRIS</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
    <?php

    nav();
}

// Close the page with the shared footer.
function end_page()
{
    ?>
    <footer>
        <div class="wrap">BRIS · Student project demonstration</div>
    </footer>
    </body>
    </html>
    <?php
}
