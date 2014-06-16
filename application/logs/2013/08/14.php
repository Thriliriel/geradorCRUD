<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-08-14 15:25:17 --- ERROR: ErrorException [ 8 ]: Undefined offset:  1 ~ APPPATH/classes/controller/gerar.php [ 95 ]
2013-08-14 15:25:17 --- STRACE: ErrorException [ 8 ]: Undefined offset:  1 ~ APPPATH/classes/controller/gerar.php [ 95 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(95): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}