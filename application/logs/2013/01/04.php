<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-01-04 14:29:42 --- ERROR: Database_Exception [ 1054 ]: Unknown column 't.UNC_ID' in 'on clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNC_ID` = `u`.`UNC_ID`) WHERE `u`.`UNC_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-04 14:29:42 --- STRACE: Database_Exception [ 1054 ]: Unknown column 't.UNC_ID' in 'on clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNC_ID` = `u`.`UNC_ID`) WHERE `u`.`UNC_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT `u`.*, `...', false, Array)
#1 /var/www/paulo/application/classes/controller/index.php(77): Kohana_Database_Query->execute()
#2 /var/www/paulo/application/views/index.php(29): Controller_Index::levelUP('1')
#3 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#4 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#5 /var/www/paulo/system/classes/kohana/view.php(228): Kohana_View->render()
#6 /var/www/paulo/application/views/template.php(71): Kohana_View->__toString()
#7 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#8 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#9 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#10 [internal function]: Kohana_Controller_Template->after()
#11 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Controller_Index))
#12 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#14 /var/www/paulo/index.php(109): Kohana_Request->execute()
#15 {main}
2013-01-04 14:30:46 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'u.UNI_ID' in 'where clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNI_ID` = `u`.`UNI_ID`) WHERE `u`.`UNI_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-04 14:30:46 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'u.UNI_ID' in 'where clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNI_ID` = `u`.`UNI_ID`) WHERE `u`.`UNI_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT `u`.*, `...', false, Array)
#1 /var/www/paulo/application/classes/controller/index.php(77): Kohana_Database_Query->execute()
#2 /var/www/paulo/application/views/index.php(29): Controller_Index::levelUP('1')
#3 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#4 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#5 /var/www/paulo/system/classes/kohana/view.php(228): Kohana_View->render()
#6 /var/www/paulo/application/views/template.php(71): Kohana_View->__toString()
#7 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#8 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#9 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#10 [internal function]: Kohana_Controller_Template->after()
#11 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Controller_Index))
#12 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#14 /var/www/paulo/index.php(109): Kohana_Request->execute()
#15 {main}
2013-01-04 14:31:38 --- ERROR: ErrorException [ 8 ]: Undefined index:  UNC_NOME ~ APPPATH/views/index.php [ 7 ]
2013-01-04 14:31:38 --- STRACE: ErrorException [ 8 ]: Undefined index:  UNC_NOME ~ APPPATH/views/index.php [ 7 ]
--
#0 /var/www/paulo/application/views/index.php(7): Kohana_Core::error_handler('/var/www/paulo/...', Array)
#1 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#2 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/paulo/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /var/www/paulo/application/views/template.php(71): Kohana_View->__toString('/var/www/paulo/...', Array)
#5 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#6 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture()
#7 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after(Object(Controller_Index))
#9 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#10 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#12 /var/www/paulo/index.php(109): Kohana_Request->execute()
#13 {main}
2013-01-04 14:31:45 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'u.UNI_ID' in 'where clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNI_ID` = `u`.`UNI_ID`) WHERE `u`.`UNI_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-04 14:31:45 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'u.UNI_ID' in 'where clause' [ SELECT `u`.*, `t`.* FROM `UNIDADE_CLIENTE` AS `u` JOIN `TAXA_EVOLUCAO` AS `t` ON (`t`.`UNI_ID` = `u`.`UNI_ID`) WHERE `u`.`UNI_ID` = '1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT `u`.*, `...', false, Array)
#1 /var/www/paulo/application/classes/controller/index.php(77): Kohana_Database_Query->execute()
#2 /var/www/paulo/application/views/index.php(29): Controller_Index::levelUP('1')
#3 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#4 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#5 /var/www/paulo/system/classes/kohana/view.php(228): Kohana_View->render()
#6 /var/www/paulo/application/views/template.php(71): Kohana_View->__toString()
#7 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#8 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/paulo/...', Array)
#9 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#10 [internal function]: Kohana_Controller_Template->after()
#11 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Controller_Index))
#12 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#13 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#14 /var/www/paulo/index.php(109): Kohana_Request->execute()
#15 {main}
2013-01-04 16:11:00 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL email was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2013-01-04 16:11:00 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL email was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#3 {main}
2013-01-04 16:11:11 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL conta was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2013-01-04 16:11:11 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL conta was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#3 {main}
2013-01-04 16:23:31 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2013-01-04 16:23:31 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /var/www/geradorCRUJ/application/bootstrap.php(118): Kohana_Core::modules(Array)
#1 /var/www/geradorCRUJ/index.php(102): require('/var/www/gerado...')
#2 {main}
2013-01-04 16:23:43 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2013-01-04 16:23:43 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /var/www/geradorCRUJ/application/bootstrap.php(118): Kohana_Core::modules(Array)
#1 /var/www/geradorCRUJ/index.php(102): require('/var/www/gerado...')
#2 {main}
2013-01-04 16:23:43 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2013-01-04 16:23:43 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /var/www/geradorCRUJ/application/bootstrap.php(118): Kohana_Core::modules(Array)
#1 /var/www/geradorCRUJ/index.php(102): require('/var/www/gerado...')
#2 {main}
2013-01-04 16:23:44 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
2013-01-04 16:23:44 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'phpmailer' at 'phpmailer' ~ SYSPATH/classes/kohana/core.php [ 550 ]
--
#0 /var/www/geradorCRUJ/application/bootstrap.php(118): Kohana_Core::modules(Array)
#1 /var/www/geradorCRUJ/index.php(102): require('/var/www/gerado...')
#2 {main}
2013-01-04 16:27:05 --- ERROR: ErrorException [ 8 ]: Undefined offset:  1 ~ APPPATH/classes/controller/gerar.php [ 35 ]
2013-01-04 16:27:05 --- STRACE: ErrorException [ 8 ]: Undefined offset:  1 ~ APPPATH/classes/controller/gerar.php [ 35 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(35): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}