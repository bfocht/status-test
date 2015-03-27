status-test
===========

status test page, flip the switch to make it error 500

now supports the ability to change the url path
stores state into a mysql database
you must edit the db.php file and update with your mysql instance information

also you must edit your .htaccess file and add the following lines if you want to have support for different url paths
```
RewriteEngine on
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]
````

example site http://www.minimyn.com/github
