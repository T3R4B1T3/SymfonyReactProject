# SymfonyReactProject

Full-stack application combining **Symfony 6.2** (PHP) as backend and **React** (via Vite) as frontend.

## 🧰 Technologies Used

- **Backend:** Symfony 6.2, PHP 8.1+
- **Frontend:** React (Vite)
- **Database:** Doctrine ORM
- **Templating:** Twig
- **Authentication & Security:** Symfony Security Bundle
- **Mailing & Notifications:** Symfony Mailer & Notifier
- **Testing:** PHPUnit, Symfony Test Components

## 🚀 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/T3R4B1T3/SymfonyReactProject.git
cd SymfonyReactProject
```

---

### 2. Backend Setup (Symfony)

```bash
composer install
cp .env.example .env
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
symfony server:start
```

> Make sure your database credentials are correctly set in `.env`

---

### 3. Frontend Setup (React)

```bash
npm install
npm run dev
```

---

## ⚙️ Features

- Secure Symfony backend (authentication, forms, validation)
- REST endpoints (built manually or via annotations)
- Integrated React frontend (fetching backend data via Axios or fetch)
- Doctrine ORM + migrations
- Debugging via Web Profiler
- PHPUnit tests

---

## 🔐 CORS Support

If your frontend and backend are hosted on different ports during development, enable CORS using:

```bash
composer require nelmio/cors-bundle
```

Then configure it in `config/packages/nelmio_cors.yaml`.

---
