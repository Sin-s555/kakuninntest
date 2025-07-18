# お問い合わせフォーム

## 環境構築

### Dockerビルド

1. `git clone https://github.com/Sin-s555/kakuninntest.git`
2. `docker-compose up -d --build`

> ※ MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

---

### Laravel環境構築

1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
- DB_DATABASE=laravel_db
- DB_USERNAME=laravel_user
- DB_PASSWORD=laravel_pass
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`

---

## 使用技術

- PHP 8.0
- Laravel 10.0
- MySQL 8.0

---

## ER図

![ER図](docs/er_diagram.png)

## URL


- 開発環境： [http://localhost](http://localhost)
- phpMyAdmin： [http://localhost:8081](http://localhost:8081)