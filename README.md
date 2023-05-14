# Q Symfony Client
Client for connecting to Q Symfony Skeleton API (QSS)

## Installation
Installing Q Symfony Client is simple and doesn't require any custom install settings.
It's sufficient to upload the index.php to the desired location on server.

## Usage
Once you access index.php file through a browser, login form with e-mail and password fields will appear.
After successful login, access token will be retrieved and stored into session variable. 
The session expires after three hours of inactivity and you will have to login again. 
Also, after closing a browser, the session will be destroyed.
