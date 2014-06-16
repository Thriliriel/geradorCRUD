<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-12-28 16:02:34 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.CLA_MOVIMENTO' in 'field list' [ SELECT `u`.*, `c`.`CLA_NOME`, `c`.`CLA_MOVIMENTO` FROM `UNIDADES` AS `u` JOIN `CLASSES` AS `c` ON (`c`.`CLA_ID` = `u`.`CLA_ID`) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-12-28 16:02:34 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'c.CLA_MOVIMENTO' in 'field list' [ SELECT `u`.*, `c`.`CLA_NOME`, `c`.`CLA_MOVIMENTO` FROM `UNIDADES` AS `u` JOIN `CLASSES` AS `c` ON (`c`.`CLA_ID` = `u`.`CLA_ID`) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT `u`.*, `...', false, Array)
#1 /var/www/paulo/application/classes/controller/index.php(48): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}