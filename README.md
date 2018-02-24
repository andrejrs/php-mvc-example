# php-mvc-example

This is simple example of creating MVC framework with php.

## Structure

 - App (All classes related to the application)
   - Controllers
   - Models
   - Views
     - Page
- Config (Contains all of application's configuration files)
- database (Contains database dumps and seeds)
- logs (Contains application logs if the display of the error on the screen is turned off)
- public (Contains the front controller and assets (images, JavaScript, CSS, etc)
- src (All core classes)

## DAtabase

![alt tag](https://raw.githubusercontent.com/andrejrs/php-mvc-example/master/screenshots/db.png)

## JS libraries

The following packages were used:
* [jQuery](https://jquery.com) - JavaScript Library.
* [Bootstrap](https://getbootstrap.com) - The most popular HTML, CSS, and JS library in the world.
* [Feather](https://feathericons.com) - Simply beautiful open source icons.
* [bootstrap-datepicker](http://bootstrap-datepicker.readthedocs.io/en/latest/) - A datepicker for Bootstrap.
* [Chart.js](http://www.chartjs.org) - Simple, clean and engaging HTML5 based JavaScript charts.

## Getting Started

In order to run the application, it is necessary to create a virtual host and setup database.

Application tested on:
* PHP 7.1.14
* Nginx 1.13.8

### Prerequisites

To start this project, you need to have the following components installed:

* [PHP](http://php.net) - PHP is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.
* [MySQL](https://www.mysql.com) - MySQL is an open source relational database management system (RDBMS) based on Structured Query Language (SQL).
* [Apache](https://httpd.apache.org) or [Nginx](https://www.nginx.com) - An HTTP server.

### Installing

Transfer files to the folder that watches the web server and import the database.
The configuration parameters for the database are in /Config/Database.php.

## Database Seeding

This example includes a simple method of seeding database with test data using seed classes.

Seeders can be defined in a /database directory. Seeder needs to implement the core seeder interface.

You can run the seeder by calling the php seeder command with name of the seeder class as first parameter.
```
php seeder OrderSeeder
```

## Configuration

All configuration classes are located in the /Config directory. 
Currently, there are two configuration classes:

* Configuration parameters for connection to the database.
* Parameters related to the application (SHOW_ERRORS and DEFAULT_ROUTE).

To get the settings in any part of the application:

* use Config\Database; then for example you can get host with Database::DB_HOST.

## Namespaces and Routes

Namespaces and Routes are located in /App directory. These files return a array of data.
These files are automatically loaded by the framework.

### Routes

One method can have multiple routes. The routes consist of request method and array with url and controller@action. 

```
return [
    "GET" => [
        "/home" => "Home@index"
    ]
];
```


## Models

The model represents an abstract class that contains two attributes:

* private $db; - Represents an instance of a PDO object.
* protected $_table; - The name of the table in database that the model binds.


### Insert method

The _table attribute is very important for the insert() method. Without this information, the insert method will not work.

This method makes it easy to insert data into the database in a quick and easy way. The data set must be associative. 
Index of array represents the field in the database.

For example: [ "fist_name" => "John" ]

## Versioning
Version 1.0.0 - The first commit of application

## Screenshots
![alt tag](https://raw.githubusercontent.com/andrejrs/php-mvc-example/master/screenshots/1.png)
![alt tag](https://raw.githubusercontent.com/andrejrs/php-mvc-example/master/screenshots/2.png)
![alt tag](https://raw.githubusercontent.com/andrejrs/php-mvc-example/master/screenshots/3.png)
![alt tag](https://raw.githubusercontent.com/andrejrs/php-mvc-example/master/screenshots/4.png)

## Authors
* **Andrej** - *Initial work* - [andrejrs](github.com/andrejrs)
