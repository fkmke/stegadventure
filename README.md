# StegAdventure

This is a project for a serious game on the topic of steganography.

### Maintainers

-   Femke Weijsenfeld

## About this project

This project has a Vue frontend and a Laravel backend. The text in the game can be adjusted in `resources/data/dialogue.xlsx` and then `python convert_to_json.py` must be run in the same folder.

The backgrounds used in the game can be found in `public/backgrounds`. They are named as called in the `dialogue.xlsx` file. The characters and their text boxes can be found in `public/characters`.

The game itself can be found in `resources/js/views/Game.vue`.

### Prerequisites

The installation commands are for Linux. Consider downloading [Windows Subsystem for Linux (WSL)](https://learn.microsoft.com/en-us/windows/wsl/install) if you use Windows. You can then type `wsl` in cmd to use it.

In order to develop this website, you must have php installed. You can do that with the following command:

```
sudo apt install php
```

Check your version with `php -v`. If you have trouble installing a php version 8.2 or higher, you might try running the following commands (individually):

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php
# Select the right version if default is not updated (check with php -v if it is good already or not)
sudo update-alternatives --config php
```

You also need `composer` for this project. The installation instructions can be found [here](https://getcomposer.org/download/). Be sure to move the `composer.phar` too, like described.

Install `Node.js` for Linux using `nvm` with the instructions found [here](https://nodejs.org/en/download/package-manager). Use `sudo apt install curl` if you have not installed `curl` yet.

In addition, install the following dependencies:

```
sudo apt install php-xml php-mysql php-curl
```

When you open this project for the first time, be sure to run `composer install` and `npm install` to install the dependencies.

#### For local development

These steps are only needed to be peformed once.

Make a copy of `.env.example` and call it `.env`.

Use `php artisan key:generate` to generate your own application key.

Install and start a MySQL server:

```
sudo apt install mysql-server
sudo systemctl start mysql.service
```

Use `php artisan migrate` to generate your own database. Select 'yes' to create it. Create a user with enough permissions for the database in the `mysql` interface.

Also, update the username and password of that in the `.env`.

Now, everything is ready to be run.

### Run the project

To run the project, run the following two commands (possibly in two terminals):

```
php artisan serve
npm run dev
```

## Project structure

### Routing

Frontend: Extra visible pages can be added to `resources/js/plugins/router.js` so that the user can access it. Here, you can link a Vue component with a routing path.

Backend: First a match is tried to be found in `routes/web.php`. It is usually the case that only `json` is returned here. If no match is found, the request is forwarded to the frontend (`router.js`), which tries to find a match again.

### Webpages and components

The webpage is a single-page application and its main component is initialised in `resources/js/App.vue`. The global CSS used on Vuetify components can be found there. In addition, it makes use of `resources/css/app.css`.

The visible webpages can be found under `resources/js/views`. The name corresponds to its path, for clarity. These webpages may use either Vuetify components or self-created components. The self-created components can be found in `resources/js/components`.

Most components have scoped CSS in them, that only holds for that specific component.

### Database

Data is send to the mySQL database.

## Frameworks used

### Laravel

Laravel documentation can be found [here](https://laravel.com/docs).

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

### Vue

Vue documentation can be found [here](https://vuejs.org/guide/).

In this project, Vue is extended with Vuetify, so pre-made Vuetify components can be used. All Vuetify components can be found [here](https://vuetifyjs.com/en/components/all/).
