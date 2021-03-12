<?php
return array(
	'^reg$'				=>	'auth/signup',
	'^auth$'			=>	'auth/signin',
	'^done$'			=>	'auth/done',
	'^logout$'			=>	'auth/logout',

	'^user/([0-9]+)$'	=>	'user/user/$1',
	'^lk$'				=>	'user/person',

	'^theme/([0-9]+)$'	=>	'themes/msg/$1',	// ThemesController	=>	actionMsg($1)
	'^themes/([0-9]+)$'	=>	'themes/themes/$1',
	'^create$'			=>	'themes/create',
	'^search$'			=>	'themes/search',
	'^themes$'			=>	'themes/themes',

	'^'					=>	'main/index',		// MainController	=>	actionIndex() 
);
