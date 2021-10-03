## Build a REST API in PHP for a code challenge

This example shows how to build a simple REST API in core PHP.

**Prerequisites:** PHP, Composer, MySQL


### Getting Started

Clone this project using the following commands:

```
git clone https://github.com/dilannet777/report_tool_api.git
cd report_tool_api
```

### Configure the application

Create the database and user for the project:

```
mysql -u root -p
CREATE DATABASE otrium_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'otrium_user'@'localhost' identified by 'otrium_password';
GRANT ALL on otrium_db.* to 'otrium_user'@'localhost';
quit
```

Copy and edit the `.env` file and enter your database details and Tax rate there:

```
cp .env.example .env
```

Install the project dependencies and start the PHP server:

```
composer install
php -S 127.0.0.1:8000 -t public
```

Loading [127.0.0.1:8000/api/reports/turnover](http://127.0.0.1:8000/api/reports/turnover) should return a 404 Not fund response now.



### Run the apis via curl

Report - 7 Days Turnover Per Brand
```
curl --location --request POST 'http://127.0.0.1:8000/api/reports/turnover' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{"type":"brand"}'
```
Report - 7 Days Turnover Per Day
```
curl --location --request POST 'http://127.0.0.1:8000/api/reports/turnover' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{"type":"day"}'
```

After that, you should see the client app execute some API requests and dump the output.

### Testing
```
./vendor/bin/phpunit
```

### Front-end Code

GitHub URL : [Click Here](https://github.com/dilannet777/report_tool_react_app)

