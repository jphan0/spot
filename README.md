# Vacay Tunes

Vacay Tunes searches Spotify for your favourite songs and playlists and locates the closest matching YouTube video, it then extracts the audio and provides you with an M4A file to download and take on the road for your next vacay!

This project makes use of both the Spotify and YouTube APIs and tools such as Alpine.js, Tailwind CSS, Laravel Livewire, and youtube-dl.
You can see it in action [here](https://spot.jphan.info/)

![Screenshot of Spot](https://github.com/jphan0/spot/blob/main/ss.png)

## To do

- [x] Implement Spotify API and add song search
- [x] Add Alpine.js and provide song previews
- [x] Add playlist search
- [x] Implement YouTube API and add download song option
- [x] Reduce number of YouTube API calls
- [x] Add Queues to prevent timeout on large files and playlist download
- [x] Use Livewire to update content dynamically
- [x] Add in cron/scheduled task to remove temporary files periodically
- [ ] Implement Spotify playlist download

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
mysql -u root -p
create database [DB name]; 
use [DB name];
exit

# Add API keys
Add your Spotify and YouTube API keys to your env file
SPOTIFY_CLIENT_ID=
SPOTIFY_CLIENT_SECRET=
YOUTUBE_API_KEY= 

# Set up queueing
Update the QUEUE_CONNECTION from 'sync' to 'database' to enable queueing
php artisan queue:table
php artisan migrate

# Install youtube-dl
sudo curl -L https://yt-dl.org/downloads/latest/youtube-dl -o /usr/local/bin/youtube-dl
sudo chmod a+rx /usr/local/bin/youtube-dl
OR for windows
sudo -H pip install --upgrade youtube-dl

# Run your server
php artisan serve

```

### Project made possible thanks to:

- [Alpine.js](https://alpinejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Laravel](https://laravel.com/docs/8.x)
- [Laravel Livewire](https://laravel-livewire.com/)
- [Laravel-Spotify](https://github.com/aerni/laravel-spotify)
- [Youtube](https://github.com/alaouy/Youtube)

