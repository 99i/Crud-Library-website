# Library System (Full CRUD Website)

Welcome to the Library System! This project is a fully functional CRUD (Create, Read, Update, Delete) website designed for managing a library. Built using PHP, JavaScript, CSS, and HTML, it features various pages and functionalities that allow users and administrators to interact with the system effectively.

Features

General Pages:

Home Page: Introduction to the library system.

Search: Search for books by title, author, or category.

About Us: Learn more about the library and its mission.

Contact Us: Get in touch with the library team.

User Features:

Profile Page: View and edit user profile information.

Cart: Manage borrowed or reserved books.

Login/Logout: Secure user authentication system.

Admin Features:

Admin Page: Manage books, categories, users, and overall system settings.

Other Features:

Category Search: Browse books by specific categories.

Requirements

XAMPP: This project is designed to run on XAMPP, which includes Apache and MySQL.

MySQL Database: The project uses MySQL for data storage.

Installation

Download and Install XAMPP:

Download XAMPP

Install XAMPP on your system and ensure Apache and MySQL are running.

Clone the Repository:

git clone <repository-url>

Place the Files in the XAMPP Directory:

Copy the project files into the htdocs folder in your XAMPP installation directory.

Import the Database:

Open phpMyAdmin via http://localhost/phpmyadmin.

Create a new database (e.g., library_system).

Import the provided SQL file (database.sql) into the newly created database.

Configure the Database Connection:

Edit the config.php file in the project root and update the database credentials:

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library_system');

Start the Application:

Open your browser and navigate to http://localhost/<project-folder-name>.
