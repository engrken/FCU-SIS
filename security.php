<?php
function fcusis_start_session() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function fcusis_html($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function fcusis_post($key) {
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

function fcusis_csrf_token() {
    if (empty($_SESSION['fcusis_csrf'])) {
        $_SESSION['fcusis_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['fcusis_csrf'];
}

function fcusis_require_csrf() {
    if (!hash_equals(fcusis_csrf_token(), fcusis_post('csrf'))) {
        http_response_code(403);
        exit('Invalid request.');
    }
}
