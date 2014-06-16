<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-01-23 09:42:47 --- ERROR: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 1353 ]
2014-01-23 09:42:47 --- STRACE: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 1353 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(1353): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2014-01-23 09:42:59 --- ERROR: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 1353 ]
2014-01-23 09:42:59 --- STRACE: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 1353 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(1353): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}