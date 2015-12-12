## README

this page has information about the common configurable options for PHP related to cookie or session

## cookie 

### cookie header

server  can send http header to set cookie at client side


Set-Cookie: NAME = VALUE; [expires=DATE;] [path=PATH;]
	[domain=DOMAIN_NAME;] [secure]


### SET COOKIE in php

bool setcookie(string name [, string vlaue [, int expire [, string path [, int secure]]]])

e.g. 


setcookie('mycookie', 'value')



### use cookie in session


session_set_cookie_params($lifetme, $path, $domain [, $secure])




## sesssoin 

### use cookie or URL
configurable via 'session.use_trans_sid' value is 'on' or 'off';


to pass a SID manually you can do the following


<A HREF="link.php?<?php echo strip_tags(SID); ?>">

### configure session 

name                                   default
session.auto_start 					0
session.cache_expire				180
session.cookie_domain				none
session.cookie_lifetime				0
session.cookie_path					/
session.name 						PHPSESSID
session.save_handler				files
session.save_path					""
session.use_cookie					1
session.cookie_secure				0
session.hash_function				0 (MD5)				"0" for MD5 (128), "1" for SHA-1