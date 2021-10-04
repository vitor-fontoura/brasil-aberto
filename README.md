## Instructions

Clone the repository

    git clone https://github.com/vitor-fontoura/brasil-aberto.git

Create the .env by copying the .env.example file

    cp .env.example .env

Then change the values accordingly to your environment

    DB_DATABASE=<database_name>
    DB_USERNAME=<database_user>
    DB_PASSWORD=<database_password>
    MYSQL_ROOT_PASSWORD=<database_root_password>

Download the dependencies for building the app for the first time

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs

Run the Laravel Sail containers

    docker-compose up -d

Then download and compile the front-end dependencies and the project migrations

    docker exec brasil-aberto_laravel.test_1 bash -c "npm clean-install; npm run dev; php artisan migrate; php artisan key:generate"
