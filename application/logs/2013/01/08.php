<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-01-08 10:43:30 --- ERROR: ErrorException [ 2 ]: mkdir() [function.mkdir]: File exists ~ APPPATH/classes/controller/gerar.php [ 46 ]
2013-01-08 10:43:30 --- STRACE: ErrorException [ 2 ]: mkdir() [function.mkdir]: File exists ~ APPPATH/classes/controller/gerar.php [ 46 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/TESTE', 511)
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(46): mkdir()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-08 10:45:37 --- ERROR: ErrorException [ 1 ]: Call to undefined function id_dir() ~ APPPATH/classes/controller/gerar.php [ 46 ]
2013-01-08 10:45:37 --- STRACE: ErrorException [ 1 ]: Call to undefined function id_dir() ~ APPPATH/classes/controller/gerar.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2013-01-08 11:37:43 --- ERROR: ErrorException [ 8 ]: Undefined variable: edicao ~ APPPATH/classes/controller/gerar.php [ 121 ]
2013-01-08 11:37:43 --- STRACE: ErrorException [ 8 ]: Undefined variable: edicao ~ APPPATH/classes/controller/gerar.php [ 121 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(121): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-08 14:50:59 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ APPPATH/classes/controller/gerar.php [ 89 ]
2013-01-08 14:50:59 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ APPPATH/classes/controller/gerar.php [ 89 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler('controller_gera...')
#1 {main}
2013-01-08 15:32:49 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:32:49 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-08 15:34:36 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:34:36 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-08 15:35:48 --- ERROR: View_Exception [ 0 ]: The requested view teste/lst.php could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2013-01-08 15:35:48 --- STRACE: View_Exception [ 0 ]: The requested view teste/lst.php could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/view.php(137): Kohana_View->set_filename('teste/lst.php')
#1 /var/www/geradorCRUJ/system/classes/kohana/view.php(30): Kohana_View->__construct('teste/lst.php', NULL)
#2 /var/www/geradorCRUJ/application/classes/controller/teste.php(26): Kohana_View::factory('teste/lst.php')
#3 [internal function]: Controller_Teste->action_index()
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-01-08 15:37:29 --- ERROR: ErrorException [ 1 ]: Class 'Pagination' not found ~ APPPATH/classes/controller/index.php [ 58 ]
2013-01-08 15:37:29 --- STRACE: ErrorException [ 1 ]: Class 'Pagination' not found ~ APPPATH/classes/controller/index.php [ 58 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler('select * from T...', 10)
#1 {main}
2013-01-08 15:38:19 --- ERROR: ErrorException [ 8 ]: Undefined variable: mensagem ~ APPPATH/classes/controller/teste.php [ 41 ]
2013-01-08 15:38:19 --- STRACE: ErrorException [ 8 ]: Undefined variable: mensagem ~ APPPATH/classes/controller/teste.php [ 41 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(41): Kohana_Core::error_handler()
#1 [internal function]: Controller_Teste->action_index(Object(Controller_Teste))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-08 15:41:16 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:41:16 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-08 15:42:37 --- ERROR: ErrorException [ 8 ]: Undefined offset:  0 ~ APPPATH/views/teste/edit.php [ 9 ]
2013-01-08 15:42:37 --- STRACE: ErrorException [ 8 ]: Undefined offset:  0 ~ APPPATH/views/teste/edit.php [ 9 ]
--
#0 /var/www/geradorCRUJ/application/views/teste/edit.php(9): Kohana_Core::error_handler('/var/www/gerado...', Array)
#1 /var/www/geradorCRUJ/system/classes/kohana/view.php(61): include('/var/www/gerado...')
#2 /var/www/geradorCRUJ/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/geradorCRUJ/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /var/www/geradorCRUJ/application/views/template.php(55): Kohana_View->__toString('/var/www/gerado...', Array)
#5 /var/www/geradorCRUJ/system/classes/kohana/view.php(61): include('/var/www/gerado...')
#6 /var/www/geradorCRUJ/system/classes/kohana/view.php(343): Kohana_View::capture()
#7 /var/www/geradorCRUJ/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after(Object(Controller_Teste))
#9 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#10 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#12 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#13 {main}
2013-01-08 15:48:11 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL teste/salvar was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
2013-01-08 15:48:11 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL teste/salvar was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 111 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#3 {main}
2013-01-08 15:49:00 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:49:00 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-08 15:49:42 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:49:42 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-08 15:49:49 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-08 15:49:49 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/teste.php(16): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Teste->before(Object(Controller_Teste))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}