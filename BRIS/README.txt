BRIS XAMPP PROJECT

INSTALLATION
1. Extract the BRIS folder to C:\xampp\htdocs\ so the file path is C:\xampp\htdocs\BRIS\index.php
2. Open XAMPP Control Panel and start Apache and MySQL.
3. Open http://localhost/phpmyadmin/
4. Click Import, choose BRIS/database/bris.sql, then click Import/Go.
5. Open http://localhost/BRIS/

PAGES
- index.php: responsive landing page
- resident_form.php: register or edit a resident
- residents.php: search, filter by status, and edit residents
- households.php: household list and member counts
- reports.php: summary report with print support

DATABASE TABLES
- residents
- households
- barangay_officials
- resident_documents

Database connection settings are in config/database.php. A default XAMPP install commonly uses username root and a blank password.
Sample resident data is fictional. This is a school-project starter, not production-ready software. Household add/edit and barangay official/document management are not yet implemented. Before real deployment, add authentication, roles, audit logs, backups, and appropriate privacy/security controls.
