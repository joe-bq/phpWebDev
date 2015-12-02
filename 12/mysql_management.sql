-- mysql advanced management

-- 
-- use the following to inspect the tables and databases
-- you might be able to see column_priv, table_Priv and etc..

use mysql;
show tables;



--
-- describe user
-- use the command to find out what priviledge a user might be able to perform on a table

describe user;


-- 
-- db and host
-- db tells which user can access which table
-- host tell user from which host can have which access right on table


-- 
-- tables_priv, columns_priv, procs_priv
-- access right for table/column/proc level access right

-- 
-- Mysql how to use grant table
--  use:
--    1. connection authentication
--    2. request authentication

-- 1. connection authentication 
--   first check users table to see if connection allowed.
-- 2. request authorization
--    then check if for every request, if permission allowed to execute request.


--
-- to manually flush/update permission change
-- 
flush privileges;

-- or you can do 

mysqladmin flush-privileges;

-- or you can do 


mysqladmin reload



-- 
-- get more information about databases
-- 
--   

show tables;


show tables from books;

show columns from orders from books;

-- == 
show columsn from books.orders



-- 
-- show grnt permission on a table.
-- show grants on user bookorama;
--
show grants for bookorama;


-- show command
-- show commands has a full range of operations.
-- 

show database [like_or_where]
show [open] tables [frolm database] [like_or_where]
show [full] columns from table [from database] [like_or_where]
show index from table [from database]
show [global | session] status [like_or_where]
show [global|session] variables [like_or_where]
show [full] processlist
show table status [from database] [like_or_where]
show grants for user
show priviledges
show create database database
show create talbe tablename
show [storage] engines
show innodb status
show warnings [limit [offset,] row_count]
show errors [limit [offset,] row_count]


-- show create table books;

-- | Table | Create Table
-- | books | CREATE TABLE `books` (
--   `isbn` char(13) NOT NULL,
--   `author` char(50) DEFAULT NULL,
--   `title` char(100) DEFAULT NULL,
--   `price` float(4,2) DEFAULT NULL,
--   PRIMARY KEY (`isbn`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1 |


--
-- describe
-- describe is like the oracle describe
describe table [column];

-- ouptut :
-- mysql> describe books;
-- +--------+------------+------+-----+---------+-------+
-- | Field  | Type       | Null | Key | Default | Extra |
-- +--------+------------+------+-----+---------+-------+
-- | isbn   | char(13)   | NO   | PRI | NULL    |       |
-- | author | char(50)   | YES  |     | NULL    |       |
-- | title  | char(100)  | YES  |     | NULL    |       |
-- | price  | float(4,2) | YES  |     | NULL    |       |
-- +--------+------------+------+-----+---------+-------+

-- 
-- explain
explain table;

-- mysql> explain books;
-- +--------+------------+------+-----+---------+-------+
-- | Field  | Type       | Null | Key | Default | Extra |
-- +--------+------------+------+-----+---------+-------+
-- | isbn   | char(13)   | NO   | PRI | NULL    |       |
-- | author | char(50)   | YES  |     | NULL    |       |
-- | title  | char(100)  | YES  |     | NULL    |       |
-- | price  | float(4,2) | YES  |     | NULL    |       |
-- +--------+------------+------+-----+---------+-------+


-- however, explain can let you inspect how a query shall be executed.
explain select customers.name
from customers, orders, order_items, books
where customers.customerid = orders.customerid
and order_items.isbn = books.isbn
and books.title like '%java%';


-- acutally the following commands are executed to get better output


-- explain select customers.name
-- from customers, orders, order_items, books
-- where customers.customerid = orders.customerid
-- and order_items.isbn = books.isbn
-- and books.title like '%java%' \G;
-- 
-- --  the output 
-- -- 
-- mysql> explain select customers.name
--     -> from customers, orders, order_items, books
--     -> where customers.customerid = orders.customerid
--     -> and order_items.isbn = books.isbn
--     -> and books.title like '%java%' \G;
-- *************************** 1. row ***************************
--            id: 1
--   select_type: SIMPLE
--         table: customers
--          type: ALL
-- possible_keys: PRIMARY
--           key: NULL
--       key_len: NULL
--           ref: NULL
--          rows: 3
--         Extra: NULL
-- *************************** 2. row ***************************
--            id: 1
--   select_type: SIMPLE
--         table: orders
--          type: ALL
-- possible_keys: NULL
--           key: NULL
--       key_len: NULL
--           ref: NULL
--          rows: 4
--         Extra: Using where; Using join buffer (Block Nested Loop)
-- *************************** 3. row ***************************
--            id: 1
--   select_type: SIMPLE
--         table: order_items
--          type: index
-- possible_keys: NULL
--           key: PRIMARY
--       key_len: 17
--           ref: NULL
--          rows: 5
--         Extra: Using index; Using join buffer (Block Nested Loop)
-- *************************** 4. row ***************************
--            id: 1
--   select_type: SIMPLE
--         table: books
--          type: eq_ref
-- possible_keys: PRIMARY
--           key: PRIMARY
--       key_len: 13
--           ref: books.order_items.isbn
--          rows: 1
--         Extra: Using where
-- 4 rows in set (0.00 sec)
-- 
-- ERROR:
-- No query specified


--
-- analyze tables.
-- 
-- for MyISAM table you can do 
-- output as follow.

-- C:\ProgramFiles(x86)\MySQL\mysql-5.6.17-win32\data\mysql>myisamchk --analyze db.MYI
-- Checking MyISAM file: db.MYI
-- Data records:       3   Deleted blocks:       0
-- - check file-size
-- - check record delete-chain
-- - check key delete-chain
-- - check index reference
-- - check data record references index: 1
-- - check data record references index: 2

-- or innodb database, you can do the following.
--
--  analyze table customers, orders, order_items, books;
-- well, the commands does not yield very useful results.
-- 
-- mysql> analyze table customers, orders, order_items, books;
-- +-------------------+---------+----------+----------+
-- | Table             | Op      | Msg_type | Msg_text |
-- +-------------------+---------+----------+----------+
-- | books.customers   | analyze | status   | OK       |
-- | books.orders      | analyze | status   | OK       |
-- | books.order_items | analyze | status   | OK       |
-- | books.books       | analyze | status   | OK       |
-- +-------------------+---------+----------+----------+
-- 4 rows in set (0.36 sec)




-- 
-- backup tables
-- before backup, you can lock it update
lock tables table lock_type [, table lock_type ... ]


-- dump tables to a .sql file
mysqldump --opt --all-databases > all.sql

-- mysqlhotcopy
mysqlhotcopy database /path/for/backup



--
-- restore from database
-- for 1 
--    copy files back to where MySQL  resides
-- for 2
--   mysqlbinlog hostname-bin.[0-9]* | mysql


-- 
-- master/slave database
-- 
-- 
grant replication slave
on *.*
to 'rep_slave'@'%' identified by 'password'

-- more information on slave/master is ignored ...