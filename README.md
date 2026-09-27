# Color_picker
This is a color picking webapp designed for COP4331. It consists of a login page allowing users to 
login with a username and password and a color picking page with allows users to store and select 
a color by name. 

It was designed implemented and tested on a LAMP architecture, that is using Linux Ubuntu specifically 
as the base OS with Apache as the webserver, MySQL as the database management system, and php as the 
main coding language. 

To setup the app once a server, ip, and hostname have been acquired requires four directories in /var/www/html 
/LAMPAPI, /css, /images, /js, as well as index.html. Once the directories are created files should be placed as 
they are in the repo, that is in the same directory. 

IMPORTANT the API is written with place holder database credentials these must be replaced with the actual names of 
both the database user and the database as well as the password. These replacements must be made in all the php files.
There is also a place holder URL in code.js that must be replaced with the URL to your webserver.

After this is done the application should be running and navigating to the URL should display the login screen, upon login 
you should be directed to the color picker screen if the login is valid, if the login is invalid you should be informed of such,
if nothing is happening make sure all place holder values were properly changed.
