# 🎬 Cinema Management System

## 📖 Overview
The Cinema Management System is a web-based application built with **Laravel (Monolithic MVC)**.  
It provides functionality for movie browsing, seat selection, booking, and administrative reporting.  
The system is designed for small to medium-scale cinema operations, ensuring transactional integrity and a simple, cohesive architecture.

---

## 🚀 Features
- **User Module**
  - Register and login
  - Browse movies and showtimes
  - Select seats and book tickets
  - Simulated payment processing
  - View booking confirmation

- **Admin Module**
  - Manage movies, showtimes, rooms, and seats
  - View and manage registered users
  - Generate booking and sales reports
  - Monitor seat occupancy

---

## 🏗️ Architecture
The system follows a **Layered Monolith Architecture**:
- **Presentation Layer**: Web Browser (UI), Blade templates, Controllers  
- **Business Layer**: Application logic embedded in Controllers and Models, Payment Simulation  
- **Database Layer**: MySQL database with Eloquent ORM models  

---


## ⚙️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/nobucoldy/SA25-26_ClassN02_Group-14

2. Navigate to the project folder:
   ```bash
   cd SA25-26_ClassN02_Group-14
    ```
3. Install dependencies:
   ```bash
composer install
npm install
 ```
4. Configure environment:
Copy .env.example to .env
 ```
Set database connection (MySQL)

Run migrations:
   ```bash
php artisan migrate ```
5. Start the server:
   ```bash
php artisan serve ```
