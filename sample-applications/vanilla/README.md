# vanilla

vanilla is a skeleton user-based web application. It's built with PHP/MySQL and cityphp. It comes with remember me login, forgot password, account email verification, optional account email, edit account info and delete account.

## Installation

Upload the cityphp directory to your web server. Create a MySQL database for your application. Set these variables in deploy/constants.php:

- CITYPHP - an absolute path pointing to the cityphp directory
- VANILLA - an absolute path pointing to the vanilla directory
- SITE - set this to http plus the domain name with no trailing slash. For example, `https://mysite.com`
- ROOT - an absolute path pointing to your web application root. For example, if the application is at `https://mysite.com/` then ROOT is `/`. As another example, if the application is at `https://mysite.com/myapp/` then ROOT is `/myapp/`.
- DATABASE_HOST - the MySQL database host
- DATABASE_USERNAME - the MySQL database username
- DATABASE_PASSWORD - the MySQL database password
- DATABASE_NAME - the MySQL database name
- SESSION_NAME - if you have multiple instances of vanilla running on the same server, then this value must be different for each instance.
- EMAIL_FROM - the administrative email used to send users things such as email verification and password reset
- BCRYPT_COST - the bcrypt hash cost. Must be between 4-31 inclusive. It's recommended you use something between 10-12.

Upload all the files in the deploy directory to the web application root on your web server. Using a web browser visit install.php. If the installation is successful, then you'll see a link to the home page. Delete install.php from your web server.

## Other Notes

If you're using vanilla for a live website then you need to get an SSL certificate and use https for everything. It is okay to test using only http.

Execute prune-tokens.php once a day or once a week depending on the number of users.