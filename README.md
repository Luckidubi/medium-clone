# Medium Clone

A Medium.com-inspired blogging platform built with Laravel.

## Features

- User authentication (register, login, logout)
- Create, edit, and delete articles
- Publish and unpublish articles
- Article listing and detail views
- User profiles
- Responsive design

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or PostgreSQL

### Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/YOUR_USERNAME/medium-clone.git
   cd medium-clone
   ```

2. **Install dependencies:**

   ```sh
   composer install
   npm install
   npm run build
   ```

3. **Copy `.env` file and set up environment variables:**

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env` and set your database credentials.

4. **Run migrations:**

   ```sh
   php artisan migrate
   ```

5. **Start the development server:**

   ```sh
   php artisan serve
   ```

   Visit [http://localhost:8000](http://localhost:8000).



---

**Made with Laravel ❤️**