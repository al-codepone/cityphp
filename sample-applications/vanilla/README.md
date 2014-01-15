# vanilla

`vanilla` is a skeleton user-based web application. It's built with PHP, MySQL and [cityphp](https://github.com/al-codepone/cityphp). It comes with remember me login, forgot password, account email verification, optional account email, edit account info and delete account.

## Installation

`vanilla` uses [composer](http://getcomposer.org) for installation. Run `composer install` in the `deploy` directory. Create a MySQL database for your application. Set these constants in `deploy/const.php`:

- `SITE` - set this to http plus the domain name with no trailing slash. For example, `https://mysite.com`
- `ROOT` - an absolute path pointing to your web application root. For example, if the application is at `https://mysite.com/` then `ROOT` is `/`. As another example, if the application is at `https://mysite.com/myapp/` then `ROOT` is `/myapp/`.
- `MYSQL_HOST` - the MySQL database host
- `MYSQL_USERNAME` - the MySQL database username
- `MYSQL_PASSWORD` - the MySQL database password
- `MYSQL_NAME` - the MySQL database name
- `SESSION_NAME` - if you have multiple instances of `vanilla` running on the same server, then this value must be different for each instance.
- `EMAIL_FROM` - the email address used to send users automated emails such as email verification and password reset
- `EMAIL_IS_SEND` - if `false` then automated emails will not be sent to users
- `EMAIL_IS_LOG` - if `true` then automated emails will be logged to the file specified by `EMAIL_LOG_FILE`
- `EMAIL_LOG_FILE` - if `EMAIL_IS_LOG` is `true` then automated emails will be logged to the file specified by this constant
- `BCRYPT_COST` - the bcrypt hash cost. Must be between 4-31 inclusive. As of the year 2014 it's recommended you use something between 10-12.

Upload all the files in the `deploy` directory to the web application root on your web server. Using a web browser visit `install.php`. If the installation is successful, then you'll see a link to the home page. Delete `install.php` from your web server.

## Other Notes

If you're using `vanilla` for a live website then you need to get an SSL certificate and use https for everything. It is okay to test using only http.

Execute `prune-tokens.php` once a day.