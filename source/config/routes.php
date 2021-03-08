<?php
return array(
	'^lk' => 'user/person',
	'^reg$' => 'auth/signup',
	'^auth$' => 'auth/signin',
	'^done$' => 'auth/done',
	'^logout$' => 'auth/logout',
	'^theme/([0-9]+)' => 'themes/msg/$1',
	'^themes/([0-9]+)' => 'themes/themes/$1',
	'^search$' => 'themes/search',
	'^themes$' => 'themes/themes',
	'^ajax/([\w]+)' => 'ajax/$1',
	//'^([a-zA-Z0-9]+)' => 'main/error', //actionError s MainController
	'^' => 'main/index',	//actionIndex s MainController
);