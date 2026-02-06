# 🎬 Cinema Management System

## 👥 Team Members (Group 14)
- **Nguyen Que Bac** – Student ID: 23010574  
- **Hoang Tuan Kiet** – Student ID: 23010517  
- **Do Bao Long** – Student ID: 23010561  


## 📖 Overview
The **Cinema Management System** is a web-based application developed using **Laravel (Monolithic MVC architecture)**.  
It supports essential cinema operations such as movie browsing, seat selection, ticket booking, and administrative reporting.

The system is designed for **small to medium-sized cinemas**, focusing on simplicity, transactional integrity, and a cohesive monolithic structure.

---

## 🚀 Features

### 👤 User Module
- User registration and authentication
- Browse movies and showtimes
- Seat selection and ticket booking
- Simulated payment processing
- View booking confirmation and booking history

### 🛠️ Admin Module
- Manage movies, showtimes, rooms, and seats
- Manage registered users
- Generate booking and sales reports
- Monitor seat occupancy status

---

## 🏗️ Architecture
The application follows a **Layered Monolithic Architecture**:

- **Presentation Layer**
  - Web Browser (UI)
  - Blade Templates
  - Laravel Controllers

- **Business Layer**
  - Application logic in Controllers and Models
  - Payment simulation logic

- **Database Layer**
  - MySQL Database
  - Eloquent ORM Models
