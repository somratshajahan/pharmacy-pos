# Pharmacy POS Demo System

A modern Laravel-based Pharmacy POS (Point of Sale) demo platform built for real pharmacy workflows in Bangladesh.

This project showcases a clean SaaS-style pharmacy management experience including sales processing, invoice generation, inventory tracking, customer due management, and reporting.

> ⚠️ This repository contains the **demo/portfolio edition** of the platform.  
> The complete commercial version includes advanced enterprise features and private business modules.

---

# Purpose

This project was built to simulate real-world pharmacy operations and demonstrate Laravel-based SaaS/POS architecture, inventory management workflows, customer due systems, and invoice/report generation.

---

# 🔗 Commercial Version

The complete commercial version includes advanced enterprise features and is currently private.

👉 Private commercial build available on request

---

# Demo Features

## 🛒 POS / Sales
- Fast medicine search
- Add to cart workflow
- Real-time total calculation
- Paid / due / return money logic
- Walk-in customer support
- Invoice generation
- Stock validation

---

## Inventory Management
- Medicine database
- Generic name & brand tracking
- Barcode-ready architecture
- Real-time stock updates
- Active/inactive medicine control

---

## 👥 Customer Management
- Customer accounts
- Due tracking
- Payment history
- Ledger system

---

## 🧾 Invoice System
- Professional invoice view
- PDF invoice generation
- Auto invoice numbering

---

## Dashboard & Reports
- Today's sales
- Revenue overview
- Invoice statistics
- Due summary
- Low stock alerts

---

# Full Commercial Version Includes

The paid/full product additionally includes:

- Batch-wise stock system
- Expiry tracking
- Supplier management
- Purchase module
- Role-based authentication
- Thermal invoice printing
- Advanced reporting
- SaaS-ready architecture
- Barcode-first POS workflow
- Enhanced UI/UX system
- Near-expiry alerts
- Opening stock synchronization
- Business analytics

---


# 🛠️ Tech Stack

- **Framework:** [Laravel 10](https://laravel.com/)
- **Frontend Bundler:** [Vite](https://vitejs.dev/)
- **PDF Engine:** [Laravel-DomPDF](https://github.com/barryvdh/laravel-dompdf)
- **Frontend:** Blade Templates + Custom SaaS-style UI
- **HTTP Client:** Axios

---

# 📋 Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or any supported SQL database

---

# ⚙️ Installation

## 1️⃣ Clone the Repository

```bash
git clone https://github.com/faysalmahmudprem/pharmacy-pos-demo.git
cd pharmacy-pos-demo
```

---

## 2️⃣ Install PHP Dependencies

```bash
composer install
```

---

## 3️⃣ Install Frontend Dependencies

```bash
npm install
```

---

## 4️⃣ Setup Environment

```bash
cp .env.example .env
```

Configure your database credentials inside the `.env` file.

---

## 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

# 🗄️ MySQL Database Setup

## Create Database

Open MySQL or phpMyAdmin and create a database:

```sql
CREATE DATABASE pharmacy_pos;
```

---

## Update `.env`

Open the `.env` file and configure database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacy_pos
DB_USERNAME=root
DB_PASSWORD=
```

Update:
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

according to your local MySQL setup.

---

## 6️⃣ Run Migrations & Seeders

```bash
php artisan migrate --seed
```

This will:
- create all database tables
- seed demo medicines
- seed demo users
- prepare the application for use

---

## 7️⃣ Compile Frontend Assets

### Development

```bash
npm run dev
```

### Production

```bash
npm run build
```

---

## 8️⃣ Start Development Server

```bash
php artisan serve
```

Visit:

```text
http://127.0.0.1:8000
```

---

# 📂 Project Structure

| Directory | Purpose |
|---|---|
| `app/Http/Controllers` | Application business logic |
| `app/Models` | Eloquent database models |
| `database/migrations` | Database schema |
| `database/seeders` | Demo medicines & user data |
| `resources/views` | Blade UI templates |
| `routes/web.php` | Application routes |
| `tests/Feature` | Feature & flow testing |

---

# Running Tests

```bash
php artisan test
```

---

# Key Workflows

## POS Flow
- Medicine search
- Cart management
- Stock validation
- Paid/due handling
- Invoice generation
- Automatic stock deduction

---

## Customer Due Flow
- Due sales
- Payment collection
- Ledger tracking
- Due reduction

---

## Inventory Workflow
- Medicine CRUD
- Stock synchronization
- Barcode-ready architecture
- Opening stock management

---

# Screenshots

_Add project screenshots here_

Suggested screenshots:
- Dashboard
- POS screen
- Invoice page
- Customer ledger
- Reports page

---

## 👤 Author

**Faysal Mahmud Prem**  
(CSE Graduate | Software Engineer | ML Enthusiast)  

- 🌐 Portfolio: [faysalmahmudprem.com](https://faysalmahmudprem.netlify.app)  
- 💻 GitHub: [@faysalmahmudprem](https://github.com/faysalmahmudprem)

---


# 📄 License

This repository is intended for:
- Educational purposes
- Portfolio showcase
- Demonstration purposes

Commercial/private modules are not included in this public repository.

---

# Project Status

✅ Demo Ready  
✅ Portfolio Ready  
✅ Recruiter Showcase Ready  
🚧 Commercial SaaS Version In Progress
