<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-06-12 23:21:16 --- ERROR: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
2014-06-12 23:21:16 --- STRACE: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
--
#0 /var/www/geradorCRUD/application/classes/controller/index.php(31): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/gerado...', 31, Array)
#1 /var/www/geradorCRUD/application/classes/controller/gerar.php(8): Controller_Index->before()
#2 [internal function]: Controller_Gerar->before()
#3 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Gerar))
#4 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#7 {main}
2014-06-12 23:21:32 --- ERROR: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
2014-06-12 23:21:32 --- STRACE: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
--
#0 /var/www/geradorCRUD/application/classes/controller/index.php(31): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/gerado...', 31, Array)
#1 [internal function]: Controller_Index->before()
#2 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Index))
#3 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#6 {main}
2014-06-12 23:22:46 --- ERROR: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
2014-06-12 23:22:46 --- STRACE: ErrorException [ 8 ]: Undefined variable: aContent ~ APPPATH/classes/controller/index.php [ 31 ]
--
#0 /var/www/geradorCRUD/application/classes/controller/index.php(31): Kohana_Core::error_handler(8, 'Undefined varia...', '/var/www/gerado...', 31, Array)
#1 [internal function]: Controller_Index->before()
#2 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Index))
#3 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#6 {main}