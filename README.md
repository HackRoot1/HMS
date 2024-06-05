
# Hospital Management Project

## Overview

The Hospital Management Project is a web-based application developed using PHP, MySQL, HTML, CSS, and JavaScript. It aims to streamline various aspects of hospital management, including patient management, appointment scheduling, staff management, and inventory management. This project provides hospital administrators, staff, and patients with an efficient and user-friendly platform to manage hospital operations effectively.

## Features

- **Patient Management:** Allows administrators to register new patients, update patient information, and maintain patient records securely.
- **Appointment Scheduling:** Enables patients to schedule appointments online, view available time slots, and receive confirmation notifications.
- **Staff Management:** Facilitates the management of hospital staff, including doctors, nurses, and administrative personnel, by maintaining their profiles and schedules.
- **Inventory Management:** Helps in managing hospital inventory, including medicines, medical equipment, and other supplies, by tracking stock levels and generating reports.
- **Billing and Payment:** Provides functionality for generating bills, managing payments, and maintaining billing records for patients and services rendered.
- **Reporting and Analytics:** Offers reporting and analytics features to analyze hospital performance, track key metrics, and make data-driven decisions.
- **Security and Access Control:** Ensures data security and access control through authentication mechanisms, role-based access control (RBAC), and encryption techniques.

## Technologies Used

- **PHP:** Backend scripting language for server-side development.
- **MySQL:** Relational database management system (RDBMS) for data storage and management.
- **HTML/CSS:** Frontend languages for defining the structure and styling of web pages.
- **JavaScript:** Frontend scripting language for implementing dynamic and interactive features.
- **Bootstrap:** Frontend framework for building responsive and mobile-friendly web interfaces.
- **jQuery:** JavaScript library for simplifying DOM manipulation and event handling.

## Usage

Follow these steps to set up the Hospital Management Project:

1. **Install a Web Server and Database Server:**
   - Install a web server such as Apache and a database server such as MySQL on your local machine or a hosting server.

2. **Import Database Schema:**
   - Import the provided SQL database schema (`hospital_management.sql`) into your MySQL database using a tool like phpMyAdmin or MySQL command line.

3. **Upload Project Files:**
   - Upload the project files to your web server directory using FTP or by cloning the repository directly.

4. **Configure Database Connection:**
   - Navigate to the `config.php` file in the project directory and update the database connection settings (hostname, username, password, database name) according to your MySQL configuration.

5. **Access the Application:**
   - Access the application through a web browser by navigating to the project URL. For example, `http://localhost/HMS`.

## Project Structure

- **index.php:** The main entry point of the application.
- **config.php:** Configuration file for database connection and other settings.
- **/assets:** Directory for storing CSS, JavaScript, and other static assets.
- **/includes:** Directory for PHP include files containing reusable code and functions.
- **/admin:** Directory for organizing admin related tasks.
- **/doctor:** Directory for organizing doctor related tasks.
- **/nurse:** Directory for organizing nurse related tasks.
- **/patient:** Directory for organizing patient related tasks.
- **/receptionist:** Directory for organizing receptionist related tasks.

## Demo Screenshots

<!-- ![Dashboard](demo/dashboard.png) -->
*Dashboard: Overview of Hospital Management System*

<!-- ![Patient Management](demo/patient_management.png) -->
*Patient Management: Registering and Managing Patients*

<!-- ![Appointment Scheduling](demo/appointment_scheduling.png) -->
*Appointment Scheduling: Scheduling Appointments with Doctors*

<!-- ![Staff Management](demo/staff_management.png) -->
*Staff Management: Managing Hospital Staff Profiles*

<!-- ![Inventory Management](demo/inventory_management.png) -->
*Inventory Management: Tracking and Managing Hospital Inventory*

## Getting Started

To run this project locally, follow the usage instructions mentioned above. Additionally, you may need to set up a development environment with PHP, MySQL, and a web server stack (XAMPP) if you haven't already done so.

## Contributing

If you'd like to contribute to the project, feel free to fork the repository, make changes, and submit a pull request. Your feedback, suggestions, and contributions are highly appreciated and will help improve the project further.
