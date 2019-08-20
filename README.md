# Music Production Forum
A forum/article site built with Laravel 5.7 and Vue.js for Plymouth University's PRCO304 module.

## Functionality
### Guest Users 
- browse/view articles, threads, categories, featured songs, tags, and the account pages of verified users
### Authenticated Users
- browse/view articles, threads, categories, featured songs, tags, and the account pages of verified users
- access their own account home page 
- create and delete their own threads on the forum 
- create and delete their own posts, and like and dislike posts by other users
- submit songs to the admins via the track submission form in the navbar 
- receive notifications if:
    - a user comments on one of their threads,
    - a user likes one of their posts,
    - one of their submitted songs gets featured on the site 
### Admins
- Access the admin area, along with the content management system
- Create, edit, and delete site data through the CMS

## Built with
- [Laravel 5.7](https://laravel.com/) 
    - [Model](app), [View](resources/views), [Controller](app/Http/Controllers) creation
    - [Route](routes/web.php) management, and middleware/authentication
    - database [Factories](database/factories), [Seeders](database/seeds), and [Migrations](database/migrations)
    - [Testing](tests) with [PHPUnit](https://github.com/sebastianbergmann/phpunit)
- [Vue.js](https://vuejs.org/v2/guide/) - chart, user, and audio player [Components](resources/js/components)
- [XAMPP](https://www.apachefriends.org/index.html) - database creation/management
- [Chart.js](https://www.chartjs.org/) - displays site data to the admins
- [JavaScript Web Audio API](https://developer.mozilla.org/en-US/docs/Web/API/Web_Audio_API) - used (with Vue) to create the [audio player](resources/js/components/WaveformComponent.vue)
- [Bootstrap](https://getbootstrap.com/) - styling
## Installing
- 1 - Create a local copy of the project with git, or by downloading the .zip file
- 2 - Open the project in an IDE and run 'composer install' in a terminal to install the Composer dependencies
- 3 - Run 'npm install' to install the Node.js dependences and run ‘npm audit fix’ to fix dependency errors/issues if prompted
- 4 - Create a copy of ‘.env.example’  and name it ‘.env’
- 5 - Run ‘php artisan key:generate' to create a new environment key, this key will be unique for each system
### Database Creation, Migration, and Seeding
- 1 - Create a new relational database with a tool like [XAMPP](https://www.apachefriends.org/index.html)
- 2 - Open .env and replace the value stored in 'DB_DATABASE' with the name of the new database
- 3 - Remove 'secret' from 'DB_PASSWORD' ('DB_PASSWORD' should be empty) 
- 4 - Run ‘php artisan migrate’ in a terminal to migrate the tables to the database. In the event this causes an error with the unique constraint update migrations, run ‘php artisan   migrate:fresh’
- 5 - Run ‘php artisan db:seed’ to add test data to the database
- 6 - Finally, run ‘php artisan serve’ to run the project

## Testing
- Run 'vendor\bin\phpunit' in a terminal to run the full test suite
- Alternatively, run 'vendor\bin\phpunit tests\feature' to run the feature tests
- Or run 'vendor\bin\phpunit tests\unit' to run the unit tests
