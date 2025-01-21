# Laravel Web Shop (datshop)

Welcome to datshop! This application is designed to provide a seamless shopping experience with advanced features and secure payment integration. Below you'll find a detailed overview of the technologies used, features available, and instructions for setting up and running the application.

## Technologies

-   **Laravel 11:** A robust PHP framework for web artisans.

## Features

## Screenshots

## Setup Instructions

1. **Clone the repository:**

    ```bash
    git clone https://github.com/dathuynh1710/datshop.git
    cd datshop
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Environment configuration:**
   Copy the `.env.example` file to `.env` and update the necessary environment variables.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations:**

    ```bash
    php artisan migrate
    ```

5. **Run storage:link**

    ```bash
    php artisan storage:link
    ```

6. **Run the application:**

    ```bash
    php artisan serve
    ```

For any issues or contributions, please create an issue or a pull request on the [GitHub repository](https://github.com/dathuynh1710/datshop).

Happy Coding!
