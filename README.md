# phpmvc-project

This project is part of the course in phpmvc in Blekinge Tekniska Högskola, Sweden. The website is for a fictional company called WGTOTW.

## Installation
You need Composer to install all dependencies and packages.

Start by cloning this repository with:
```
git clone https://github.com/Paikz/phpmvc-project.git
```

Navigate to the root for the framework and run the command´´´composer install --no-dev´´´
Everything you need will now install/update.

Next you will have to change some things in the files.

1. ```.htaccess``` on line 5 ```RewriteBase /~phes15/dbwebb-kurser/phpmvc/me/kmom10/``` have to be changed from my webroot to your own webroot.

2. ```app/config/config_mysql.php``` have to be changed to your own database options.

3. The last step is to setup your database with all the required tables.
   Go into the index home page on the website and enter:

  ```/Questions/setup```

  ```/Answers/setup```
  
  ```/Tags/setup```
  
  ```/QuestionTags/setup```
  
  ```/Users/setup```
  
  
##License
This code is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)
