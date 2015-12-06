-- readme.sql
-- this is a readme.sql which shows some important facts about the use of the MySQL Database


-- InnoDB transaction
-- you can use the InnoDB transaction...



-- set commit mode / turn off autom-commit
set autocommit=0;

-- then you need to manually start a transaction
start transaction;

-- then you can commit after you have done the transaction
commit;


-- and if you want to rollback
rollback;


-- change one table to innodb
alter table orders type=innodb;
alter table order_items type=innodb;



-- turn off autocommit
set autocommit=0;

-- start transaction

start transaction;

-- commit a transaction
commit;


-- to rollback
rollback;