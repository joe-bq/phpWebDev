use books;

-- the following statement can be written as 
insert into customers values
  (NULL, "Julie Smith", "25 Oak Street", "Airport West"),
  (NULL, "Alan Wong", "1/47 Haines Avenue", "Box Hill"),
  (NULL, "Michelle Arthur", "357 North Road", "Yarraville");

-- equivalent to above
insert into customers (customerid, name, address, city) values
  (NULL, "Julie Smith", "25 Oak Street", "Airport West"),
  (NULL, "Alan Wong", "1/47 Haines Avenue", "Box Hill"),
  (NULL, "Michelle Arthur", "357 North Road", "Yarraville");


-- which means you can insert records to field which has meaningful fields
insert into customers (name, address, city) values
  ("Julie Smith", "25 Oak Street", "Airport West"),
  ("Alan Wong", "1/47 Haines Avenue", "Box Hill"),
  ("Michelle Arthur", "357 North Road", "Yarraville");

-- or, alternatively, you can do this for a single record
insert into customers
set name = 'Michael Archer',
  address = '12 Adderley Avenue',
  city = 'Leet6on';


insert into orders values
  (NULL, 3, 69.98, "2000-04-02"),
  (NULL, 1, 49.99, "2000-04-15"),
  (NULL, 2, 74.98, "2000-04-19"),
  (NULL, 3, 24.99, "2000-05-01");

insert into books values
  ("0-672-31697-8", "Michael Morgan", "Java 2 for Professional Developers", 34.99),
  ("0-672-31745-1", "Thomas Down", "Installing Debian GNU/Linux", 24.99),
  ("0-672-31509-2", "Pruitt, et al.", "Teach Yourself GIMP in 24 Hours", 24.99),
  ("0-672-31769-9", "Thomas Schenk", "Caldera OpenLinux System Administration Unleashed", 49.99);

insert into order_items values
  (1, "0-672-31697-8", 2),
  (2, "0-672-31769-9", 1),
  (3, "0-672-31769-9", 1),
  (3, "0-672-31509-2", 1),
  (4, "0-672-31745-1", 3);

insert into book_reviews values
  ("0-672-31697-8", "Morgan's book is clearly written and goes well beyond 
                     most of the basic Java books out there.");


-- to verify the data has been successfully insert into the table, do the following verification
select name, city from customers;



-- a query format
-- SELECT [options] order_items
-- [INTO file_details]
-- FROM tables
-- [WHERE conditions]
-- [GROUP BY group_type]
-- [HAVING where_condition]
-- [ORDER BY order_type]
-- [LIMIT limit_criteria]
-- [PROCEDURE proc_name(arguments)]
-- [lock_options]
-- ;



-- conditions supported in the WHERE conditions
-- =
-- >
-- <
-- >=
-- <=
-- ! OR <>
-- IS NOT NULL
-- IS NULL
-- BETWEEN
-- IN
-- NOT IN
-- LIKE    _ SINGEL CHARACTER, % WILDCARDS
-- NOT LIKE
-- REGEXP OR RLIKE

-- where condition cAN BE 'AND' OR 'OR' together.
-- AND
-- OR


-- table joins example
select orders.orderid, orders.amount, orders.date
from customers, orders
where customers.name = 'Julie Smith'
and customers.customerid = orders.customerid;

select customers.name 
from customers, orders, order_items, books
where customers.customerid = orders.customerid
and orders.orderid = order_items.orderid
and order_items.isbn = books.isbn
and books.title like '%Java%';

-- table left joins
select customers.customerid, customers.name, orders.orderid
from customers left join orders
on customers.customerid = orders.customerid;

-- example to look up customers who made no purchases with LEFT JOIN and IS NULL check
-- the using statement specify equi-join conditions, the same as customers.customerid == orders.customerid
select customers.customerid, customers.name, orders.orderid
from customers left join orders
using (customerid)
where orders.orderid is null;


-- table alias
select c.name 
from customers as c, orders as o, order_items as oi, books as b
where c.customerid = o.customerid
and o.orderid = oi.orderid
and oi.isbn = b.isbn
and b.title like '%Java%';


-- table alias can be useful when you do a self-join
-- example to look up customers from the same city 
select c1.name, c2.name, c1.city
from customers as c1, customers as c2
where c1.city = c2.city 
and c1.name != c2.name;

-- summary on the types of join supported by MySql

-- Cartesian  join : select xxx from a,b
-- complete join == Cartesian  join : select xxx from a,b
-- cross join  : 1. selct xx from a cross join b OR  2. select xxx from a,b 
-- inner join :  select xx from a, b where ...
-- equi join : select xx from a, b where a.prop = b.prop
-- left join : select xx form a left join b on  ...

-- orders , get return in specified orders
select name, address
from customers
order by name;


select name, address
from customers
order by name desc;


-- grouping and aggregate

-- AVG
-- COUNT
-- meaningfulMAX
-- supportedSTDDEV
-- SUM

-- e.g. 
select avg(amount)
from orders;

-- with group by
select customerid, avg(amount)
from orders
group by customerid;


--having works on group

select customerid, avg(amount)
from orders
group by customerid
having avg(amount) > 50;

-- limit, range operator supported by MySql
-- starting from 2 (starting from 0), return 3 rows 
select name
from customers
limit 2,3;

-- sub-query
-- basic sub-query

select customerid, amount
from orders
where amount = (select max(amount) from orders);

-- can be achieved by following, however, may not be supported in other RMDBs. it is more effecient in mysql
select customerid, amount
from orders
limit 1;

-- sub-query conditions
-- ANY
-- IN
-- SOME
-- ALL

-- SUB-QUERY
-- sub-query association
--     find all books which is not sold
select isbn, title
from books
where not exists (select * from order_items where order_items.isbn == book.isbn);


-- line sub-query conditions
select c1, c2, c3 
from t1
where (c1, c2, c3) in (select c1, c2, c3 from t2);

-- sub-query as temporary table
select * from 
(select customerid, name from customers where city = 'Box Hill') 
as box_hill_customers;


-- 
-- update 

-- UPDATE [LOW_PRIORITY] [IGNORE] tablename
-- SET column1=expression1, column2=expression2,....
-- [WHERE condition]
-- [ORDER BY order_criteria]
-- [LIMIT number]


-- example, price up 10%
update books
set pirce = price * 1.1;

update customers
set address = '250 Olsens Road'
where customerid = 4;


--
-- modify table
ALTER TABLE [IGNORE] tablename alternation [, alternation ...]


-- conditions that we can use
ADD [COLUMN] column_description [FIRST | AFTER column ]
ADD [COLUMN] (column_description, column_description, ...)
ADD [INDEX] [index] (column, ...)
ADD [CONSTRAINT] [symbol] PRIMARY KEY (column, ...)
ADD UNIQUE [CONSTRAINT CONSTRAINT[symbol]] [index](column,...)
ADD [CONSTRAINT[symbol]] FOREIGN KEY [index](index_col,...) [reference_definition]
ALTER [COLUMN] column {SET DEFAULT value | DROP DEFAULT}
CHANGE[COLUMN] column_description
MODIFY[COLUMN] column_description
DROP [COLUMN] column
DROP PRIMARY KEY
DROP INDEX index
DROP FOREIGN KEY key
DISABLE KEYS
ENABLE KEYS
RENAME [AS] new_table_name
ORDER BY col_name
CONVERT TO CHARACTER SET customers COLLATE c
[DEFAULT] CHARACTER SET cs COLLATE c
DISCARD TABLESPACE
table_options


-- e.g.

alter table customers
modify name char(70) not null;

alter table order_items
add tax float(6,2) after amount;

alter table orders
drop tax;

--
-- delete records

DELETE [LOW_PRIORITY] [QUICK] [IGNORE] FROM table
[WHERE condition]
[ORDER BY order_cols]
[LIMIT number]

-- 
--  drop table
DROP TABLE table;

-- 
-- drop database
DROP DATABASE database;