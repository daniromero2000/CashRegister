## Topics

1. [Introduction](#introduction)
2. [Requirements](#requirements)
3. [Installation & Configuration](#installation-and-configuration)
4. [License](#license)
5. [Security Vulnerabilities](#security-vulnerabilities)
6. [Miscellaneous](#miscellaneous)

### Introduction

Cash register is a system that will help you simulate a cash register through a REST API.

**The system offers the following services:**

1.	Load the base into the cash register.
2.	Empty cash register.
3.	Cash register status.
4.	Make a payment.
5.	View event log.
6.	View the status of the box based on a specific date and time.

### Requirements

- **OS**: Ubuntu 16.04 LTS or higher / Windows 7 or Higher (WampServer / XAMPP).
- **SERVER**: Apache 2 or NGINX.
- **RAM**: 4 GB or higher.
- **PHP**: 7.3.0 or higher.
- **Processor**: Clock Cycle 1 Ghz or higher.
- **For MySQL users**: 5.7.23 or higher.
- **For MariaDB users**: 10.2.7 or Higher.
- **Node**: 8.11.3 LTS or higher.
- **Composer**: 1.6.5 or higher.

### Installation and Configuration

**To clone and configure the cash register, run the following commands:**

```
composer install
```

1. Create a new database.
2. Copy the .env.example file content a paste it in the .env of the project.
3. Set up all project config parameters in the .env project file (database connection)
4. Run the following commands: 
```
php artisan migrate
php artisan key:generate.
```

##### Install laravel passport
```
composer require laravel/passport "~9.0"
php artisan migrate
```

```
php artisan passport:install
```

##### Steps to run the tests

configure the accesses to the database for the tests in the file .env.testing and run comand

```
vendor/bin/phpunit
```

##### Postman Collections

To configure the route collection in Postman, copy the **CashRegister.postman_collection.json** file to your computer and import it into the Postman application.

Note that you must first generate the token and replace it in the postman authorization, before you can use the endpoints
##### On local:

```
php artisan serve
```
## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security Vulnerabilities

If you discover a security vulnerability within the system, please email Daniel Romero at 123romerod@gmail.com. All security vulnerabilities will be addressed immediately. 

