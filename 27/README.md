## README

introduction on how to set up and run the book mark management system


## database setup 

1. run the following command to setup database table schemas.

mysql -u root -P < bookmarks.sql


2. you will need first to register new user as the username 

localhost/27/register_new.php

3. or  you will need to do the following

use bookmarks;

insert into user (username, passwd, email) values('testuser', sha1('password'), 'testuser@example.coom'),
														('user', sha1('password'), 'redalert2c@live.com');