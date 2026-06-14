<div align="center">

# 🚀 Laravel 13 Portfolio — by Bhargav Kapadiya

**A personal portfolio built from scratch with Laravel 13**
Clean architecture · REST API · Admin Dashboard · Production Ready

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-00758F?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

![Dashboard Preview](public/images/dashboard-banner.png)

</div>

---

## 📖 About This Project

Hi, I'm **Bhargav Kapadiya** — a web developer based in **Ahmedabad, Gujarat, India**.

This is my personal portfolio built entirely from scratch using **Laravel 13**. It showcases my skills, projects, and passion for clean, production-ready code. Every feature included has a purpose — no bloat, no unnecessary code.

---

## ✨ Features

- 🔐 **Authentication** — Login, Register, Forgot Password
- 👤 **User Management** — Full CRUD with roles & permissions
- 🛡️ **Roles & Permissions** — Powered by Spatie Permission
- 📝 **Blog Management** — Create, edit, publish blog posts
- ❓ **FAQs** — Manage frequently asked questions
- 📂 **Categories** — Organize content with categories
- 📬 **Enquiries** — Contact form with admin panel inbox
- 📧 **Email Templates** — Manage and customize email templates
- ⚙️ **Settings** — Global app settings management
- 🌐 **Landing Page** — Professional public-facing portfolio page
- 📮 **Postman Collection** — All API endpoints ready to import
- 🌙 **Dark / Light Mode** — Toggle theme support
- 📱 **Fully Responsive** — Works on all screen sizes

---

## 🛠️ Tech Stack

| Technology            | Purpose                     |
| --------------------- | --------------------------- |
| **Laravel 13**        | PHP Framework               |
| **PHP 8.3**           | Backend Language            |
| **MySQL**             | Database                    |
| **Bootstrap & CSS**   | Frontend Styling            |
| **Spatie Permission** | Roles & Permissions         |
| **Postman**           | API Testing & Documentation |
| **Git & GitHub**      | Version Control             |

---

## ⚡ Quick Start

### Requirements

- PHP >= 8.3
- Composer
- MySQL
- Node.js & NPM

### Installation

**Option 1 — Using install.sh (Recommended)**

```bash
git clone https://github.com/yourusername/laravel13-portfolio.git
cd laravel13-portfolio
chmod +x install.sh
./install.sh
```

**Option 2 — Manual Setup**

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/laravel13-portfolio.git
cd laravel13-portfolio

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install && npm run build

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your database in .env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 7. Run migrations and seeders
php artisan migrate --seed

# 8. Start the development server
php artisan serve
```

Visit: **http://localhost:8000**

---

## 🔑 Default Login Credentials

| Role      | Email             | Password |
| --------- | ----------------- | -------- |
| **Admin** | admin@example.com | password |

> ⚠️ Please change these credentials after first login.

---

## 📮 Postman Collection

All API endpoints are documented and ready to use.

1. Open **Postman**
2. Click **Import**
3. Select `postman_collection.json` from the project root
4. Start testing instantly — no setup needed

---

## 📁 Project Structure

```
laravel13-portfolio/
├── app/
│   ├── Http/Controllers/     # All controllers
│   ├── Models/               # Eloquent models
│   └── Policies/             # Authorization policies
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   └── views/                # Blade templates
├── routes/
│   ├── web.php               # Web routes
│   └── api.php               # API routes
├── public/
│   └── images/               # Public assets
├── postman_collection.json   # API collection
├── install.sh                # Quick install script
└── README.md                 # You are here
```

---

## 🔄 Updates

**Free updates with every new Laravel release.**

When a new Laravel version drops — I update this project. No extra cost, no hassle. Just pull and deploy.

```bash
git pull origin main
composer update
php artisan migrate
```

---

## 📬 Contact & Support

No bots, no tickets. Have a question? Contact me directly.

- 📧 **Email:** bhargavkapadiya80@gmail.com
- 📍 **Location:** Ahmedabad, Gujarat, India
- 💼 **LinkedIn:** [linkedin.com/in/bhargav-kapadiya-1685471b2](https://www.linkedin.com/in/bhargav-kapadiya-1685471b2)
- 🐙 **GitHub:** [github.com/BhargavKapadiya](https://github.com/BhargavKapadiya)

---

## 📜 License

This project is personal portfolio work by **Bhargav Kapadiya**. You may view and reference the code, but you may not copy, reproduce, or claim it as your own without permission.

---

<div align="center">

© 2026 **Bhargav Kapadiya** — Made with ❤️ in Ahmedabad, Gujarat, India

⭐ **If you like this project, give it a star on GitHub!** ⭐

</div>
