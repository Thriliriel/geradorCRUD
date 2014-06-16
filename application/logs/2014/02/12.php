<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-02-12 16:45:31 --- ERROR: ErrorException [ 8 ]: Undefined offset:  3 ~ APPPATH/classes/controller/gerar.php [ 1435 ]
2014-02-12 16:45:31 --- STRACE: ErrorException [ 8 ]: Undefined offset:  3 ~ APPPATH/classes/controller/gerar.php [ 1435 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(1435): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2014-02-12 16:46:58 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/classes/controller/gerar.php [ 1647 ]
2014-02-12 16:46:58 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/classes/controller/gerar.php [ 1647 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler('controller_gera...')
#1 {main}