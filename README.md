# url-shortener-in-php

Url shortener which can shorten a single long url as well as multiple long urls at once as well.
It also maintains a count of the no of times a short url is clicked to access the original long url.

Code Explanation-First of all you can provide one url or can add more url fields through the add more button and after submitting form is sent to shorten.php.So, In shorten.php file it makes a new instance of Shortener class which is in a Shortener.php file in classes folder which is doing the actual work. So next the makeCode method is called which first validate the url if it is not a valid url it throws an error , otherwise it then checks whether the given url already exists in the database or not. If it is present, it will again throw an error and return otherwise it will insert the url and date created in the database , then it will call the generateCode method which will generate an unique code using the base_convert method which is converting the base of the id of the inserted url in the db from 10 to 36 and that will be the shortened Url. If it is successful, Im sending a http response code of 200 to the index page and setting a session variable if any error exist.TO redirect the pages, I have used .htaccess file to rewrite a rule of sending all the shortened urls to the redirect.php page which will further redirect to the original long url and update the count of no of times the url is accessed. The frontend is designed in bootstrap 4 and I have used Javascript for DOM manipulation.



Requirements:
Mysql ,
Xampp Server, 
PHP 5.2 or above

To run the code just import the sql file in your mysql database named url and change the connections in the index.php and classes/Shortener.php to your mysql connection credentials and copy all the files and folders in the htdocs folder in your xampp folder.
