# Contact Form App
お問い合わせフォームアプリ

## 環境構築

```bash
git clone https://github.com/aiwing001/Contact_form.git
cd Contact_form
docker-compose up -d --build
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## 開発環境

お問い合わせ画面 http://localhost/
ユーザー登録 http://localhost/register
管理画面 http://localhost/admin
phpMyAdmin http://localhost:8080/

## 使用技術

- PHP 8.x
- Laravel 8.x
- MySQL 8.x
- Docker
- HTML / CSS

## ER図

![ER図](contact.drawio.png)