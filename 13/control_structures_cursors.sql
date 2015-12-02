# Procedure to find the orderid with the largest amount
# could be done with max, but just to illustrate stored procedure principles

delimiter //

create procedure largest_order(out largest_id int) 
begin
  declare this_id int;
  declare this_amount float;
  declare l_amount float default 0.0;
  declare l_id int;

  declare done int default 0;
  declare c1 cursor for select orderid, amount from orders;
  declare continue handler for sqlstate '02000' set done = 1;
  
  
  open c1;
  repeat
    fetch c1 into this_id, this_amount;
    if not done then
      if this_amount > l_amount then
        set l_amount=this_amount;
        set l_id=this_id;
      end if;
    end if;
   until done end repeat; 
  close c1;
 
  set largest_id=l_id;

end
//

delimiter ;


-- well, here we use 'FOR NOT FOUND' to replace the mysteric '0200'
-- check syntax against http://dev.mysql.com/doc/refman/5.7/en/cursors.html
delimiter //

create procedure largest_order(out largest_id int) 
begin
  declare this_id int;
  declare this_amount float;
  declare l_id int;
  declare l_amount float default 0.0;

  declare done int default 0;
  -- cursor statement should before continue/exit handler.
  --
  declare c1 cursor for select orderid, amount from orders;
   -- we have SQLWARNING  or SQLEXCEPTION
  declare continue handler for not found set done = 1;

  open c1;

  repeat
    fetch c1 into this_id, this_amount;
    if not done then
      if this_amount > l_amount then 
        set l_amount = this_amount;
        set l_id = this_id;
      end if;
    end if;
  until done end repeat;

  close c1;

  set largest_id = l_id;
end
//

delimiter ;

-- to call the function
call largest_order(@l);
select @l;



-- if .. then construct
if condition then
   ...
   [elseif condition then]
   ...
   [else]
   ...
   end if

-- or we can use case 
case value 
   when value then statement
   [when value then statement ...]
   [else statement]
   end case