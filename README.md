<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Zarinpal Sandbox Test

### Project Description
- The following project is **a Zarinpal Sandbox Boilerplate** that allows user to register, login and create test transactions through Zarinpal Sandbox.
- I have developed an internal package in order to isolate payment environment; the package needs a lot of improvement of course, but it is dynamic enough to change drivers and payment methods and write new gateways drivers for it easily.

### Installation
- Create `.env` file using `.env.example`
- Install dependencies
```
composer install
```
- Run Migrations and Seeders to create dummy data
```
php artisan migrate --seed
```
- Install npm dependencies & get a build
```
npm install && npm run dev
```
- Run the project
```
php artisan serve
```
- You can run the project in your browser, register and use the project.
- You can use this command to run 1 Million records seeder (invoices table)
```
php artisan insert:test
```

### Built With
* [laravel/laravel](https://github.com/laravel/laravel)
* This [Package](https://github.com/shetabit/payment) by Mahdi Khanzadi was a great inspiration to create a clean structure.
* [maatwebsite/excel](https://github.com/Maatwebsite/Laravel-Excel)

### Further Information 
- I created a dynamic structure to handle services, invoices & transactions, as good as my short time and brain let me :)   
