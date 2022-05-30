## Warehouse

Warehouse is a web application that offers products and their quantity based on inventory and maximum profit.

## Prerequisites

- A web server like [Apache](https://httpd.apache.org) or [Nginx](https://www.nginx.com).
- [PHP](https://www.php.net).
- [Composer](https://getcomposer.org).

## Install

1. Clone the project using `git clone https://github.com/mjpakzad/warehouse` commend.
2. Go to the folder application using `cd` command on your terminal or cmd (command line).
3. Run `composer install` command on your terminal or cmd.
4. Copy `.env.example` file to `.env` on the root folder. You do this by running `copy .env.example .env` command if using command prompt Windows or `cp .env.example .env` if using terminal, linux.
5. Run `php artisan key:generate` command.
6. Run `php artisan serve` command.
7. Go to [http://127.0.0.1:8000](http://127.0.0.1:8000)
