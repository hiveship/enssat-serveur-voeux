
###################
Installation guide
###################


*******************
Server requirements
*******************

PHP version 5.4 or newer is recommended. It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance issues, as well as missing features.

Your browser needs to accept JavaScript.

This project has only been tested using an Apache Server and a MySQL database.

*********
Installation
*********

1. Download the project or clone the git repository.
2. Copy the file misc/config.php in the application/config folder.
3. Edit this file to complete the base url parameter (URL to access the project folder on your web server) 
 $config ['base_url'] = 'YOUR URL HERE'

4. Set up your the database on your server by creating a database and then running the SQL script (misc/voeux_DUMP_current) on it

5. Edit the application/config/database.php file
 'hostname' => 'IP:port adress to connect to your database'
 
 'username' => 'username to connect to your database'
 
 'password' => 'password to connect to your database'
 
 'database' => 'name of the database (default is 'voeux')'

6. Congrats ! The application should now be available on your browser !
 
*********
Sample users
*********

You can use the following account to test our application:

 Compte inactif : 
  Login : ganais
  Mot de passe : 1234
  
 Enseignant actif :
  Login : rantoine
  Mot de passe : 1234
  
 Administrateur actif : login // mdp
  Login : mnantel
  Mot de passe : 1234
  
  
*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_ for the Code Igniter licence.

Our application is free under the terms of the aGPLv3 licence.

*********
Contributions
*********

Do not hesitate to send a pull request.

For contributors, it is appreciated to use the Eclips code formater (misc/eclipse_php_formatter.xml). 
