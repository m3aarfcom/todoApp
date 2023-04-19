todo app using laravel 
we used structure of onion (repository and service with interface and controller) design


you can use docker to run the project on port 9000 and phpmyadmin on port 9001
you will find two roles manager and emplyee with their permissions all in DatabaseSeeder
just run this commands


# docker compose up -d --build
# docker compose exec php php artisan migrate --seed



