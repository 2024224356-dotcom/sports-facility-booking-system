# Sports Facility Booking Management System

A web-based Sports Facility Booking Management System developed using **Laravel 12** for the IMS564 Web Development group assignment.

---

# Project Overview

The Sports Facility Booking Management System allows students to book sports facilities online while enabling administrators to manage facilities, users, bookings, and facility information efficiently.

The system helps reduce manual booking processes by providing a centralized online platform.

---

# User Roles

## Administrator

Administrators can:

- Manage Facilities
- Manage Facility Types
- Manage Facility Features
- Manage Operating Hours
- Manage Users
- Approve Bookings
- Reject Bookings (with reason)
- Complete Bookings
- View Booking Calendar
- Update Profile

---

## Student

Students can:

- Register Account
- Login
- Book Sports Facilities
- View Booking History
- Cancel Pending Booking
- View Booking Calendar
- Update Profile
- Change Password

---

# System Features

- Secure Authentication
- Role-Based Access Control
- Facility Management
- Facility Type Management
- Facility Feature Management
- Operating Hours Management
- Booking Management
- Booking Conflict Detection
- Booking Status Tracking
- Calendar View
- User Management
- Profile Management
- Responsive User Interface

---

# Booking Workflow

Student submits booking

⬇

Booking Status = Pending

⬇

Administrator Reviews Request

⬇

Approve → Completed

or

Reject (Reason Required)

---

# Booking Conflict Validation

The system automatically prevents multiple bookings for the same facility during overlapping time slots.

Example:

Booking A

- Volleyball Court
- 24 Aug 2026
- 9:00 AM – 11:00 AM

Booking B

- Volleyball Court
- 24 Aug 2026
- 10:00 AM – 12:00 PM

Result:

❌ Booking Conflict

The second booking will be rejected with an appropriate error message.

---

# Technologies Used

- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
- Blade Template Engine
- JavaScript
- SweetAlert2
- Font Awesome

---

# Installation Guide

## 1. Clone Repository

```bash
git clone <repository-url>
```

---

## 2. Open Project Folder

```bash
cd sports-facility-booking-system
```

---

## 3. Install PHP Dependencies

```bash
composer install
```

---

## 4. Install Node Packages

```bash
npm install
```

---

## 5. Create Environment File

Copy:

```
.env.example
```

Rename it to:

```
.env
```

---

## 6. Generate Application Key

```bash
php artisan key:generate
```

---

## 7. Configure Database

Update your `.env`

```
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

---

## 8. Run Database Migration

```bash
php artisan migrate
```

If a SQL backup is provided instead, import it into MySQL using phpMyAdmin.

---

## 9. Build Frontend Assets

```bash
npm run dev
```

---

## 10. Start Laravel Server

```bash
php artisan serve
```

Open:

```
http://127.0.0.1:8000
```

---

# Project Structure

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/

artisan
composer.json
package.json
vite.config.js
```

---

# Main Modules

- Dashboard
- Facilities
- Facility Types
- Facility Features
- Operating Hours
- User Management
- Booking Management
- Booking Calendar
- Student Booking
- Profile

---

# Booking Status

- Pending
- Approved
- Rejected
- Completed
- Cancelled

---

# Authentication

Role-based authentication is implemented.

### Administrator

Full access to all management modules.

### Student

Limited access to personal bookings and profile management.

---

# Responsive Design

The system supports:

- Desktop
- Laptop
- Tablet
- Mobile Devices

---

# Testing Checklist

✔ User Registration

✔ User Login

✔ Facility CRUD

✔ Facility Type CRUD

✔ Facility Feature CRUD

✔ Operating Hours CRUD

✔ User CRUD

✔ Booking Creation

✔ Booking Conflict Detection

✔ Booking Approval

✔ Booking Rejection

✔ Booking Completion

✔ Booking Cancellation

✔ Profile Update

✔ Password Update

✔ Calendar View

---

# Developed By

IMS566 Group Assignment

Sports Facility Booking Management System

Universiti Teknologi MARA (UiTM)

---

# License

This project is developed for academic purposes only.
