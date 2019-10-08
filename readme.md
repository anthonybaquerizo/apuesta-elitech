# Apuesta Elitech

Betting application for the company [elitech](https://elitechsudamerica.com/apuestas/#/). 

## About APP

This application was created by the need that the company had to place its internal bets.
Check the following:

- Registration of participants.
- Session login to ensure participant identity.
- Registration of the bet through the participant and the match enabled.
- Match registration and its management as: Create, Edit, Delete, Reports, Searches, etc.
- There are only 3 types of status for the match: Finished, Public and Draft.

This project is accessible to all public to share basic concepts of the use of Laravel and Vue technology.

## Contributing

This project is something personal if you want to contribute to improve it is appreciated. My name is [Anthony Baquerizo](http://anthonybaquerizo.com).

## Technology application
- Laravel 5.5.8
- Vue 2.6.10
- Vuex
- Vue-router
- Webpack
- Laravel Mix
- Sass

## Requirements
- PHP 7.0.0 or later
- Mysql 5.6 or later
- composer （download link：[https://getcomposer.org/download/](https://getcomposer.org/download/)）
- nodejs （download link：[http://nodejs.cn/download/](http://nodejs.cn/download/)）
- npm （New version of the nedejs has include it）

## Install
1.  Clone the source code or create new project.
```bash
git clone https://github.com/anthonybaquerizo/apuesta-elitech.git
```
2. Set the basic config
```bash
cp .env.example .env
```
3. Create laravel app_key and create database
```bash
php artisan key:generate
php artisan migrate:refresh --seed （must be set database config）
```
2. Install the extended package dependency
```bash
composer install
npm install
```
Now you can use it, thanks for your reading!

## License

Is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
