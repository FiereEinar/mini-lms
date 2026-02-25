# Mini Library Management System (Laravel)

A lightweight library management system built with **Laravel 12**, **Tailwind CSS**, and **Laravel Breeze** for authentication. This system allows administrators to manage students, authors, books, borrowing, and returns while automatically calculating overdue fines.

---

## Features

### Authentication

- Built using **Laravel Breeze**.
- Admin users can log in and change passwords.
- No role-based access control (RBAC).

### Students Module

- CRUD operations for students.
- Students can borrow multiple books.
- Overdue fines: ₱10 per day per book.
- Partial returns supported.

### Authors Module

- CRUD operations for authors.
- Books can be associated with multiple authors (many-to-many relationship).

### Books Module

- CRUD operations for books.
- Tracks total and available copies.
- Displays all authors per book.
- Borrowing availability automatically updated.

### Borrowing & Returning System

- Admin can create borrow records for students and select multiple books.
- Partial or full return supported.
- Return date can be recorded manually; defaults to today if not provided.
- Fine is automatically calculated as:
  `Fine = ₱10 × number of overdue days × number of books`
- Book inventory is updated upon return.
- Borrow status updates when all items are returned.

### Dashboard

- Displays borrow records with students, books, borrow/due dates, status, and total fines.
- Highlights overdue items and fines.

### Design

- Uses **Tailwind CSS** for responsive and clean UI.
- Layout is organized and suitable for library management purposes.

---

## Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd mini-library
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node dependencies and build assets:

```bash
npm install
npm run dev
```

4. Set up environment:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure `.env` with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_lms
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations:

```bash
php artisan migrate
```

7. Start the development server:

```bash
php artisan serve
```

Access the app at `http://localhost:8000`.

---

## Usage

- Log in using an administrator account.
- Manage students, authors, and books via the sidebar menu.
- Create borrow records for students.
- Process returns and fines through the return workflow.
- View total fines and overdue books on the dashboard.

---

## Technologies Used

- **Backend:** Laravel 12, PHP 8.4
- **Frontend:** Tailwind CSS, Blade templates
- **Authentication:** Laravel Breeze
- **Database:** MySQL
- **Pagination & Data Management:** Eloquent ORM

---

## Notes

- Partial returns are supported for individual books in a borrow record.
- Fine computation updates automatically based on return date and due date.
- The system assumes a single role (administrator) and does not implement multi-role access control.
