Food Ordering System Documentation
Introduction
The Food Ordering System is a web-based application designed to streamline the process of ordering food online. It provides an intuitive user interface for customers to browse food categories, search for items, place orders, and contact the restaurant. Additionally, the system includes an admin panel for managing menu items, orders, and categories.

Key Features
Customer Features:
Search and browse food items.
Place orders with a streamlined checkout process.
Contact the restaurant for inquiries.
Admin Panel:
Manage food categories.
Add, update, or delete menu items.
View and process customer orders.
Table of Contents
Installation
Usage
Project Structure
Features
Admin Panel Guide
Database Configuration
Contributing
License
Contact
Installation
Prerequisites
Web server (e.g., Apache or Nginx)
PHP 7.4 or higher
MySQL database
A web browser for accessing the system
Steps
Clone the repository or download it as a ZIP file.

bash
Copy code
git clone https://github.com/KitIsCooked/food_ordering_system.git
Copy the project files to your web server's root directory.

Configure the database connection:

Navigate to the config folder and update the database credentials in the config.php file.
Import the database schema:

Use the SQL file provided in the repository to set up the necessary tables.
Access the system:

Open your browser and navigate to http://localhost/food_ordering_system.
Usage
Customer Interface
Home Page (index.php): Displays food categories and featured items.
Search (food-search.php): Allows users to search for specific food items.
Order (order.php): Provides an order form for customers to place their orders.
Admin Panel
Access the admin panel through adminpanel. This interface allows authorized users to manage the system's backend.

Project Structure
Here’s an overview of the project files and their purposes:

index.php: Main landing page for users.
categories.php: Lists food categories.
category-foods.php: Displays foods under a selected category.
food-search.php: Search functionality for finding specific foods.
order.php: Handles customer order submissions.
contact.php: Contact form for customer inquiries.
adminpanel: Admin dashboard for managing the application.
config: Configuration files, including database connection.
css: Stylesheets for the website.
images: Contains images used across the site.
partials-front: Reusable components like headers and footers.
Admin Panel Guide
Features
Dashboard: Overview of the system's key metrics.
Manage Categories: Add, edit, or delete food categories.
Manage Foods: CRUD operations for food items.
Manage Orders: View and update customer orders.
Database Configuration
The system uses a MySQL database for storing data. Ensure you configure the database in config/config.php:

php
Copy code
<?php
    $conn = mysqli_connect('localhost', 'username', 'password', 'database_name') or die(mysqli_error());
?>
Contributing
We welcome contributions to improve this system. To contribute:

Fork the repository.
Create a feature branch:
bash
Copy code
git checkout -b feature/your-feature
Commit your changes:
bash
Copy code
git commit -m "Add your feature"
Push to your branch and submit a pull request.
