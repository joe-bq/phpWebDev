
# Basic stored procedure example

delimiter //

create procedure total_orders (out total float)
begin
 select sum(amount) into total from orders;
end
//

delimiter ;


-- how to call the stored procedure
call total_orders(@t);
select @t;