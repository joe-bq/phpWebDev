# Basic syntax to create a function

delimiter //

create function add_tax (price float) returns float
  return price*1.1;

//

delimiter ;



-- how to call the stored procedure
declare 