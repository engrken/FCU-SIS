<?php
require_once __DIR__ . '/security.php';
fcusis_start_session();

if (($_SESSION['legacy_site_access_until'] ?? 0) <= time()) {
    header('Location: login.php');
    exit;
}
