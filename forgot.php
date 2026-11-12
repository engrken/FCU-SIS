<?php
http_response_code(410);
header('Cache-Control: no-store');
exit('Contact your school administrator to recover access to this legacy account.');
