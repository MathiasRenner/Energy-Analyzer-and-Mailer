# MCM-Mailer
A tool that takes energy consumption data as input and visualizes the data in a way that motivates the user to reduce his energy consumption.

## Setup with Docker
- `Git clone` this repo
- Install Docker
- Navigate into repository folder and run `docker run -p 80:80  -d -v $(pwd)/src:/var/www/html php:5.6-apache`
- Check `localhost:80` with your browser. You should see a PHP info page.

## Setup with XAMPP
- `Git clone` this repo
- Install XAMPP
- Create a symbolic link from this repo/src to .../XAMPP/htdocs
- In GUI of YAMPP, start webserver
- Check `localhost:80` with your browser. You should see a PHP info page.
