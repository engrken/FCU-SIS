# FCU Student Information System

> **Retired.** FCU-SIS is no longer maintained or intended for deployment.

Legacy PHP implementation for FCU student records.

## Historical deployment notes

Use HTTPS with PHP 8.2 or later and the mysqli and GD extensions. Set `FCU_SIS_DB_HOST`, `FCU_SIS_DB_USER`, `FCU_SIS_DB_PASSWORD`, `FCU_SIS_DB_NAME`, and `FCU_SIS_ACCESS_PASSWORD_HASH` in the server environment. Generate the access hash with PHP's `password_hash` and a unique password. The SQL file contains the schema. Contact the school administrator for account recovery.
