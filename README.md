# 🧾 Mhay Points – Laravel QR-Based Loyalty App

Mhay Points is a modern, minimalist **QR code-based loyalty points system** built with **Laravel 12**, **Tailwind CSS**, and **Alpine.js**. Perfect for sari-sari stores or small businesses looking to reward loyal customers with a fast, easy-to-use digital rewards platform.

---

## ✨ Features

- 🎁 **Earn & Redeem Points**
  - ₱50 = 1 Mhay Point (Earn)
  - 1 Mhay Point = ₱1 (Redeem)
- 📱 **QR Code Scanning**
  - Customers scan to earn/redeem
  - Admin scans to check customer points
- 🧑‍💼 **Admin Dashboard**
  - Total customers, points issued/redeemed
  - Quick redeem/earn via modals
  - View full transaction history
  - Adjust point settings (₱ per point)
- 👤 **Customer Dashboard**
  - Current balance
  - Transaction history
  - Last redemption
  - Printable QR card
- ⚙️ **Dynamic Settings Panel**
  - Editable via database and UI
  - Seeded via `SettingsSeeder`
- 📦 Docker-ready with **Laravel Sail**

---

## 🚀 Tech Stack

- **Laravel 12**
- **Tailwind CSS**
- **Alpine.js**
- **Laravel Sail (Docker)**
- **Html5-Qrcode.js**
- **MySQL**

---

## 📸 Screenshots

> _Add screenshots of your admin dashboard, QR scanner, and customer view here if available._

---

## 🔧 Installation (Laravel Sail)

```bash
git clone https://github.com/your-username/mhay-points.git
cd mhay-points

cp .env.example .env
# Update your DB and APP settings in .env

composer install
npm install && npm run dev

./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
