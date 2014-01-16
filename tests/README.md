# cityphp tests

These are all the cityphp tests. These tests make up all the code in the [cityphp manual](http://ikitovagn.com/t/cityphp-manual-0.4.0.html).

## Installation

The tests use [composer](http://getcomposer.org) for installation. Run `composer install` in the `tests` directory. Disable magic quotes. Set these constants in `tests/const.php`:

- `MYSQL_HOST` - the MySQL database host
- `MYSQL_USERNAME` - the MySQL database username
- `MYSQL_PASSWORD` - the MySQL database password
- `MYSQL_DBNAME` - the MySQL database name
- `PGSQL_CONN_STRING` - the PostgreSQL connection string
- `SQLITE_FILENAME` - the file for an SQLite database

## Usage

To run a test view it in a browser.
