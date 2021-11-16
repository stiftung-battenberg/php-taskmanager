<?php 
// Login credentials for admin user
define('DEFAULT_ADMIN_USER', 'admin');
define('DEFAULT_ADMIN_PASS', 'Admlocal1');

// DB credentials 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'taskmanager');

// SMTP credentials 
define('SMTP_USER', 'taskmanager-igv@battenberg.ch');
define('SMTP_PASS', 'f^Wag1@XQc');
define('SMTP_HOST', 'outlook.office365.com');
define('SMTP_PORT', 25);
define('SMTP_SECU', "starttls");

//Default mail message
define('DEFAULT_MAIL', "Vous devez /name le /date.\r\n Visitez http://task-manager pour avoir accès à la planification complète \r\n \r\n");