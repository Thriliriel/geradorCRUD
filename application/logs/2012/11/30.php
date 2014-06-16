<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-11-30 08:48:54 --- ERROR: Database_Exception [ 1146 ]: Table 'DME.EMPRESA' doesn't exist [ SELECT `EMP_TEXTO` FROM `EMPRESA` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-11-30 08:48:54 --- STRACE: Database_Exception [ 1146 ]: Table 'DME.EMPRESA' doesn't exist [ SELECT `EMP_TEXTO` FROM `EMPRESA` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/dme/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT `EMP_TEX...', false, Array)
#1 /var/www/dme/application/classes/controller/index.php(32): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->before()
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Index))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}