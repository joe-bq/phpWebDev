-- 
-- when you create a user account then grant priviledge to it later remove form it, you may need flush privileges; 

msyql> create user 'webauth'@'localhost' identified by 'webauth';

msyql> delete from user where User='webauth';

flush privileges;

msyql> create user 'webauth'@'localhost' identified by 'webauth';