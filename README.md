# PHP Api Swagger

## Setup
Start the application by running `docker-compose up' in the root folder.
This will start 3 containers:
- `nginx` to serve the API
- `mariadb` for the database
- `php-api-swagger` which is `php:7.2-fpm` extended wit pdo_mysql to let php connect to the mariadb container

To create the database:
- Connect to the container: `docker exec -it php-api-swagger bin/bash`
- Create the database: `bin/console doctrine:database:create`

## Running the application
Run `docker-compose start` in the root folder
Point your browser to http://localhost/swagger/index.html to use the api.

## Next steps
- [ ] Add DTO's to separate view and database layer objects
- [ ] Add PATCH to update part of a server
- [ ] Move form logic to a separate service
- [ ] Redirect to new server when creating
- [ ] HATEOAS