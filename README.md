# Library System (Full CRUD Website)

Welcome to the **Library System**! This project is a fully functional CRUD (Create, Read, Update, Delete) website designed for managing a library. Built using **PHP**, **JavaScript**, **CSS**, and **HTML**, it offers a variety of features for both users and administrators.

## Features

### General Pages
- **Home Page**: Introduction to the library system.
- **Search**: Search for books by title, author, or category.
- **About Us**: Learn more about the library and its mission.
- **Contact Us**: Get in touch with the library team.

### User Features
- **Profile Page**: View and edit user profile information.
- **Cart**: Manage borrowed or reserved books.
- **Login/Logout**: Secure user authentication system.

### Admin Features
- **Admin Page**: Manage books, categories, users, and overall system settings.

### Other Features
- **Category Search**: Browse books by specific categories.

## Requirements

- **XAMPP**: The project is designed to run on XAMPP, which includes Apache and MySQL.
- **MySQL Database**: Used for storing library data.

## Installation

### Step 1: Download and Install XAMPP
1. [Download XAMPP](https://www.apachefriends.org/index.html).
2. Install XAMPP on your system and ensure **Apache** and **MySQL** are running.

### Step 2: Clone the Repository
```bash
git clone <repository-url>
```

### Step 3: Place the Files in the XAMPP Directory
1. Copy the project files into the `htdocs` folder in your XAMPP installation directory.

### Step 4: Import the Database
1. Open phpMyAdmin via [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Create a new database (e.g., `library_system`).
3. Import the provided SQL file (`database.sql`) into the newly created database.

### Step 5: Configure the Database Connection
1. Edit the `config.php` file in the project root.
2. Update the database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library_system');
```

### Step 6: Start the Application
1. Open your browser and navigate to:

```
http://localhost/<project-folder-name>
```

## Screenshots

### Home Page
![Home Page Screenshot](https://github.com/user-attachments/assets/b98eb727-fdf4-40f1-a6cd-5285a5dbcbc4)

### Search Page
![Search Page Screenshot](https://github.com/user-attachments/assets/75fb6a0e-cf4a-4e6a-b779-a6085032072b)

### Admin Dashboard
![Admin Dashboard Screenshot](https://github.com/user-attachments/assets/b5176f4a-8f3d-4534-9dcb-4b74db134251)

### Profile Page
![Profile Page Screenshot](https://github.com/user-attachments/assets/8e41fa74-3598-41f8-98fb-b43ca597705d)

## Contributing
Contributions are welcome! If you'd like to contribute:
1. Fork the repository.
2. Create a new branch (`feature/your-feature-name`).
3. Commit your changes.
4. Push to the branch.
5. Open a Pull Request.

## License
This project is licensed under the [MIT License](LICENSE).

---

Thank you for using the Library System! If you have any questions or suggestions, feel free to open an issue.
