# Basic syntax to create a function

delimiter //

create function add_tax (price float) returns float
begin
  declare tax float default 0.10;
  return price*(1+tax);
end
//

delimiter ;


-- how to call the stored procedure
select add_tax(100);
-- why cannot I do 
--  call add_tax(100)


-- show procedure
-- to show the content of the procedure 
show create procedure total_orders;

-- or 

show create function add_tax;


-- to remove procedure 
drop procedure total_orders;


-- or 

drop procedure add_tax;

-- 
-- what does a procedure uses 
--   * flow contruct
--   * variable
--   * declare handle

