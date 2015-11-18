-- first you need to create one user for bookorama
-- the user name 'bookorama'
-- run this command 
-- 	CREATE USER 'bookorama'@'localhost' IDENTIFIED BY 'bookorama123'


-- if you want to change password, do this:
--    mysqladmin -u bookorama password bookorama123


-- to login with bookorama, do this
--    mysql -u bookorama -p


-- create the database if it does not exist
create database books;


use books;



-- grant permission to the books
grant select, insert, delete, update 
on books.*
to bookorama identified by 'bookorama123';



grant select, insert, update, delete, index, alter, create, drop
on books.*
to bookorama identified by 'bookorama123';


--  you can use the following command to grant permission to bookorama, e.g.
-- 
-- mysql -h host -u bookorama -D books -p < bookorama.sql