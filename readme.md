# Scanifly

[![Test Suite](https://github.com/eliosfund/scanifly-php-sdk/actions/workflows/test.yml/badge.svg)](https://github.com/eliosfund/scanifly-php-sdk/actions/workflows/test.yml)
![Downloads](https://img.shields.io/packagist/dm/eliosfund/scanifly-php-sdk)
![Packagist Version](https://img.shields.io/packagist/v/eliosfund/scanifly-php-sdk)
![GitHub License](https://img.shields.io/github/license/eliosfund/scanifly-php-sdk)
[![codecov](https://codecov.io/gh/eliosfund/scanifly-php-sdk/graph/badge.svg?token=Kl42g7GBRz)](https://codecov.io/gh/eliosfund/scanifly-php-sdk)

Scanifly SDK for Laravel.

## Installation

Install the package via Composer:

```bash
composer require eliosfund/scanifly-php-sdk
```

Publish the config file:

```bash
php artisan vendor:publish --tag=scanifly-config
```

## Usage

```php
use Scanifly\Facades\Scanifly;
```
