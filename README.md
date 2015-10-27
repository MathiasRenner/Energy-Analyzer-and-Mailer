# Data Analytics Emailing
A tool that takes energy consumption data as input and visualizes the data in a way that motivates the user to reduce his energy consumption.

## Setup with Docker
- Install Docker
- Navigate into repository folder and run `docker run -p 80:80  -d -v $(pwd)/src:/var/www/html php:5.6-apache`
- Check `localhost:80`. You should see a PHP info page.

## Setup with XAMPP
- Install XAMPP
- Create a symbolic link from this repo/src to .../XAMPP/htdocs
- In GUI, start webserver
