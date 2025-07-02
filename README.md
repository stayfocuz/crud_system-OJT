A simple and efficient user registration system implementing full CRUD (Create, Read, Update, Delete) operations. This project was developed as part of an On-the-Job Training (OJT) program to demonstrate fundamental web development skills and database management.

🚀 Features:
User Registration: Complete user signup functionality with data validation
User Authentication: Secure login and logout system
Profile Management: View and update user profiles
User Directory: Display all registered users with search and filter capabilities
Admin Controls: Administrative functions for user management
Responsive Design: Mobile-friendly interface
Data Validation: Client-side and server-side input validation
Security: Password hashing and SQL injection protection

🛠️ Technologies Used:
Frontend:
HTML5
CSS3
JavaScript (ES6+)
Bootstrap 5 (for responsive design)

Backend:
PHP 8.0+
MySQL 8.0+

Development Tools:
XAMPP/WAMP (Local development environment)
phpMyAdmin (Database management)
Git (Version control)

📋 Prerequisites:
Before running this project, make sure you have the following installed:
PHP (version 8.0 or higher)
MySQL (version 8.0 or higher)
Apache Server (XAMPP, WAMP, or LAMP)
Git (for version control)
Web Browser (Chrome, Firefox, Safari, or Edge)

🔧 Installation:
1. Clone the Repository
bashgit clone https://github.com/stayfocuz/crud_system-OJT.git
cd crud_system-OJT
2. Database Setup
Start your Apache and MySQL services (via XAMPP/WAMP)
Open phpMyAdmin in your browser (http://localhost/phpmyadmin)
Create a new database named user_registration_db
Import the database schema:
sql-- Run the SQL commands from database/schema.sql
-- Or import the database/user_registration_db.sql file
3. Configuration
Rename config/config.example.php to config/config.php
Update the database connection settings:
php<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'user_registration_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
?>
4. Web Server Setup
Move the project folder to your web server directory:
XAMPP: htdocs/crud_system-OJT
WAMP: www/crud_system-OJT
LAMP: /var/www/html/crud_system-OJT

Access the application in your browser:
http://localhost/crud_system-OJT

📁 Project Structure:
crud_system-OJT/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── config/
│   └── config.php
├── database/
│   ├── connection.php
│   └── schema.sql
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
├── pages/
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── profile.php
│   └── users.php
├── handlers/
│   ├── auth_handler.php
│   ├── user_handler.php
│   └── crud_operations.php
├── index.php
├── README.md
└── .gitignore

🎯 Usage:
User Registration
Navigate to the registration page (/pages/register.php)
Fill in the required information:
Full Name
Email Address
Password
Confirm Password
Click "Register" to create your account

User Login:
Go to the login page (/pages/login.php)
Enter your email and password
Click "Login" to access your dashboard

CRUD Operations:
Create (Register New User)
Access the registration form
Fill in user details
Submit to create a new user record

Read (View Users)
Dashboard displays user information
User directory shows all registered users
Search and filter functionality available

Update (Edit Profile)
Access profile page from dashboard
Modify user information
Save changes to update the database

Delete (Remove User)
Admin can delete user accounts
Confirmation dialog prevents accidental deletion
Soft delete option available for data integrity

🔐 Security Features:
Password Hashing: Uses PHP's password_hash() function
SQL Injection Protection: Prepared statements for all database queries
Input Validation: Both client-side and server-side validation
Session Management: Secure session handling for user authentication
CSRF Protection: Cross-Site Request Forgery prevention
XSS Prevention: Output sanitization to prevent cross-site scripting

🎨 Screenshots:
Registration Page
Screenshot of the user registration form
Dashboard
Screenshot of the user dashboard
User Management
Screenshot of the admin user management interface

🧪 Testing:
Manual Testing
Test user registration with valid data
Test login with correct credentials
Test profile update functionality
Test user deletion (admin function)
Test input validation with invalid data

Test Cases
Valid user registration
Duplicate email registration (should fail)
Login with incorrect credentials
Profile update with valid data
SQL injection attempts (should be blocked)

🤝 Contributing:
Contributions are welcome! Please follow these steps:

Fork the project
Create a feature branch (git checkout -b feature/AmazingFeature)
Commit your changes (git commit -m 'Add some AmazingFeature')
Push to the branch (git push origin feature/AmazingFeature)
Open a Pull Request

Development Guidelines
Follow PSR-12 coding standards for PHP
Use meaningful variable and function names
Comment your code where necessary
Test your changes before submitting

📝 To-Do List:
 Add email verification for registration
 Implement password reset functionality
 Add user role management (admin/user)
 Implement API endpoints for mobile app integration
 Add export functionality for user data
 Implement advanced search filters
 Add user activity logging
 Create unit tests

🐛 Known Issues:
Profile image upload feature is not yet implemented
Bulk user operations need optimization for large datasets
Email notifications are not configured

📄 License:
This project is licensed under the MIT License - see the LICENSE file for details.

👥 Authors:
stayfocuz - Initial work - GitHub Profile

🙏 Acknowledgments:
Thanks to the OJT program supervisors for guidance
OJT team for the effective collaboration
PHP online resources
ai tools when encountered an error

📞 Support:
If you encounter any issues or have questions:
Check the Issues page
Create a new issue if your problem isn't already reported
Provide detailed information about the problem
Include steps to reproduce the issue

🔄 Version History:
v1.0.0 - Initial release with basic CRUD functionality
v1.1.0 - Added user authentication and session management
v1.2.0 - Implemented responsive design and improved security


Note: This project is part of an On-the-Job Training program and serves as a learning exercise in web development and database management. It implements fundamental CRUD operations and demonstrates best practices in user management systems.
