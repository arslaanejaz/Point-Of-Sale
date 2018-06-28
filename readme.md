<h2>Pre-requisites and Dependencies:</h2>

<p>This project is developed in Laravel 5.1.9 so system requirements are,</p>

<ul>
<li>PHP >= 5.6.4</li>
<li>OpenSSL PHP Extension</li>
<li>PDO PHP Extension</li>
<li>Mbstring PHP Extension</li>
<li>Tokenizer PHP Extension</li>
<li>XML PHP Extension
Database is used: Mysql
Other Libraries: angularjs and google maps.</li>
</ul>

<h2>Installation Instructions:</h2>

<p>
1) First check if xampp, wamp , lamp running on your local machine.
2) Get Pull from git repository.
3) Create database pos<em>db. (or whatever but sync with .env file.) 
4) You can change MAIL</em>DRIVER accordingly from .env file for mails.
5) When the database is set you can use cmd to go to the root of the folder and where you pasted the project files. And run following commands:

<p>After taking pull from git run these commands:</p>
<code>composer install</code>

</p>
<p>Create the database tables.</p>
<code>php artisan migrate</code> 

<p>Add dummy data: </p>
<code>php artisan db:seed</code>

<p>This will start the project</p>
<code>php artisan serve</code>

<h2>Credentials</h2>
<p>Default Credentials are given below but any one can change them in db seed</p>
<code>username: admin and password: admin </code>


<p>I set up this working project on AWS server http://34.208.197.201:8082</p>


