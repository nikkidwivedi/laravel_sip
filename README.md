# 🪙 SIP Program (Laravel 12)

A simple Laravel 12 project to create and manage SIPs (Systematic Investment Plans) with fake payment simulation using cron jobs.

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## ✅ Features

* User Login & Registration
* Create SIP (Daily or Monthly)
* Automatic Invoice Creation (25 hours before due)
* Fake API Debit Simulation
* Dashboard for SIP & Invoice Overview
* Livewire + Bootstrap UI

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## 🛠 Tech Stack

* Laravel 12
* Livewire
* Bootstrap
* MySQL
* Artisan Commands (Cron Jobs)

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## 🚀 Setup Guide

### 1. Clone or Download

```bash
git clone https://github.com/nikkidwivedi/laravel_sip.git
cd laravel_sip
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run dev
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file:

```
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 6. Start Development Server

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

### 7. Test Login

```
Email:    test@example.com  
Password: password
```

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## 🔁 Cron Job (Manual Run)

```bash
php artisan sip:generate-invoices
php artisan sip:process-invoices
```

## 🕒 Auto Cron (Windows)

```bash
php artisan schedule:work
```

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## 👤 Developer

Made with ❤️ by **Nikki Dwivedi**

|----------------------------------------------------------------------------------------------------------------------------------------------------|

## 🙏 Special Thanks

This project was developed with help from [ChatGPT](https://openai.com/chatgpt) by OpenAI, for guidance on Laravel.

|----------------------------------------------------------------------------------------------------------------------------------------------------|
