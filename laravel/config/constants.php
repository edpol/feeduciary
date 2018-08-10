<?php
defined('DS')            		? null : define('DS',            DIRECTORY_SEPARATOR);
defined('LIB_PATH')     		? null : define('LIB_PATH',      __DIR__);
defined('SITE_ROOT')		    ? null : define('SITE_ROOT',     dirname(LIB_PATH));
defined('ROWS_PER_PAGE') 		? null : define('ROWS_PER_PAGE', 10);
defined('COOKIE_NAME') 			? null : define('COOKIE_NAME', 'signup');
defined('HEX_HIGHLIGHT_COLOR')	? null : define('HEX_HIGHLIGHT_COLOR','FBFF3A');