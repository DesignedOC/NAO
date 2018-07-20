# NAO ![CI status](https://img.shields.io/badge/build-passing-brightgreen.svg)

NAO is a web application for an ornithology association. As a web interface, it allows users to post bird observations and search for them on Google map. The website also implements rewards for activities such as badges, tournaments, profiles and a memory game.


#### Technologies used in this repo
* [Symfony 4](https://symfony.com/4)
* HTML5, JS, CSS and SaSS
* [JQuery & Ajax](https://jquery.com/)
* [WebPack Encore](https://www.npmjs.com/package/@symfony/webpack-encore)
* [NodeJS](https://nodejs.org/en/)
* [Yarn 1.7](https://yarnpkg.com/fr/)
* [Google Map API V3](https://cloud.google.com/maps-platform/?hl=fr)

## Getting started

### Requirements
* PHP 7.2
* NodeJS 8.11.x+
* Yarn 1.7
* MySQL 
* Composer

### Initial setup and install

```php
$ git clone git://github.com/DesignedOC/NAO.git
$ cd NAO

$ composer install

$ php bin/console doctrine:database:create
$ php bin/console make:migration ( development )
$ php bin/console doctrine:migrations:migrate

$ php bin/console server:run

```

#### WebPack Encore

Javascript dependencies are necessary to integrate and generate files to render the website. You can choose between render the dev file and the minified production file. Read the documentation to get more information about [WebPack Encore](https://symfony.com/doc/current/frontend.html)

```javascript
$ yarn install
$ yarn encore dev --watch
$ yarn encore production
```

## Fixtures

In case that you would like to get content in your dev project, you can use the provided dataFixtures. We implemented some users, observations and the  necessary database to get birds.

```php
$ php bin/console doctrine:fixtures:load
```

## Contributing
Pull requests are not open at this moment. For major changes, please open an issue first to discuss what you would like to change in the future.

## License
All the graphics sources are under copyright protection. [MIT](https://choosealicense.com/licenses/mit/)
