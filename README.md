# UNEP Skills Portal Setup

## Requirements
Have the latest PHP version
Have MySQL 5.7+
Have a Web server Nginx or Apache

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/UNEP-SKILLS-PORTAL.git
   cd unep-skills-portal
   
**Import the database**
mysql -u username -p database_name < sql/schema.sql
mysql -u username -p database_name < sql/sampledata.sql
Configure database connection:
Edit config/db.php with your MySQL credentials:

define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'unep_skills_portal');

**Start the development server:**

php -S localhost:8000

Access the application at:
http://localhost:8000

**Login Credentials**
Admin: admin@unep.org / Admin@123

Staff: staff@unep.org / Staff@123

