# Spot

The purpose of this project is exploitation of the Spotify API as well as to avoid the use of jQuery by replacing it with Alpine.js. Featured in this project is the Laravel-Spotify package, a Spotify Web API wrapper for Laravel which provides straight forward methods for each endpoint and a fluent interface for optional parameters. Song previews are also available for select tracks available upon search.

![Screenshot of Spot](https://github.com/jphan0/spot/blob/main/ss.png)

## Requirements

- Laravel installer
- Composer
- Npm installer

## Installation

```
# Clone the repository from GitHub and open the directory:
git clone https://github.com/jphan0/spot.git

# cd into your project directory
cd spot

#install composer and npm packages
composer install
npm install && npm run dev

# Start prepare the environment:
There are no database requirements for this project

# Run your server
php artisan serve

```

### Project made possible thanks to:

- [Alpine.js](https://alpinejs.dev/)
- [Laravel](https://laravel.com/docs/8.x)
- [Tailwind CSS](https://tailwindcss.com/)
