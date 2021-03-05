<?php
return array(
	'^reg' => 'auth/signup',
	'^auth' => 'auth/signin',
	'^theme/([0-9]+)' => 'themes/msg/$1',
	'^themes/([0-9]+)' => 'themes/themes/$1',
	'^themes' => 'themes/themes',
	'^([a-zA-Z0-9]+)' => 'main/error', //actionError s MainController
	'' => 'main/index',	//actionIndex s MainController
);