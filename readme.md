# Dotenv Loader

Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER`.

## Installation

```bash
composer require damian972/dotenv-loader
```

## Usage

```php
require 'vendor/autoload.php';

(new Damian972\DotenvLoader\Dotenv(__DIR__, fileName: '.env'))->load(); // fileName parameter is optionnal, default: .env

echo 'API_LOGIN = '.getenv('API_LOGIN').PHP_EOL;
```
