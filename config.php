<?php 
// Login credentials for admin user
define('DEFAULT_ADMIN_USER', 'admin');
define('DEFAULT_ADMIN_PASS', 'Admlocal1');

// DB credentials 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'taskmanager');

// SMTP credentials mail 
define('SMTP_USER', 'ramon.odermatt.ged@gmail.com');
define('SMTP_PASS', 'ErdF[]09po');
define('SMTP_HOST', 'outlook.office365.com');
define('SMTP_PORT', 25);
define('SMTP_SECU', "starttls");

//Default mail message
define('DEFAULT_MAIL', "Aujourd'hui, le /date , vous êtes priés de réaliser la tâche suivante: /name\r\n\r\nVisitez http://task-manager pour avoir accès à la planification complète.\r\n\r\nMerci beaucoup et meilleures salutations\r\n\r\n-----------------------------------------------------------------------------------------------------------------\r\n\r\nHeute am /date sind mit der Aufgabe /name an der Reihe\r\n\r\nDie Planung koennen Sie unter http://task-manager einsehen.\r\n\r\nVielen Dank und freundliche Gruesse");