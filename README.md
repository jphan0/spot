# Spot

This project tends to investigate the Spotify API as well as the lightweight Alpine.js framework. Featured in this project is the Laravel-Spotify package, a Spotify Web API wrapper for Laravel which provides straight forward methods for each endpoint and a fluent interface for optional parameters. Song previews are also available for select tracks which are available upon search.

You can see it in action [here](https://spot.jphan.info/)

![Screenshot of Spot](https://github.com/jphan0/spot/blob/main/ss.png)

## To do

- [x] Re-style to provide more of an offline/90s vibe
- [x] Implement YouTube API and add download song option
- [x] Add in Spotify playlist search
- [x] Implement YouTube playlist download
- [x] Reduce number of YouTube API calls
- [ ] Add Queues to prevent timeout on playlist download
- [ ] Add animation to show download in progress
- [ ] Add in scheduled task to remove temporary files every X minutes

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

# Prepare the environment:
Add your Spotify and YouTube API keys to your env file
SPOTIFY_CLIENT_ID=
SPOTIFY_CLIENT_SECRET=
YOUTUBE_API_KEY= 

# Run your server
php artisan serve

```

### Project made possible thanks to:

- [Alpine.js](https://alpinejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Laravel](https://laravel.com/docs/8.x)
- [Laravel-Spotify](https://github.com/aerni/laravel-spotify)

