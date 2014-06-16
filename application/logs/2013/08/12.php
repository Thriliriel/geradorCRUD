<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-08-12 09:49:22 --- ERROR: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 252 ]
2013-08-12 09:49:22 --- STRACE: ErrorException [ 8 ]: Undefined offset:  4 ~ APPPATH/classes/controller/gerar.php [ 252 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(252): Kohana_Core::error_handler()
#1 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-08-12 10:50:30 --- ERROR: ErrorException [ 2 ]: Wrong parameter count for addcslashes() ~ APPPATH/classes/controller/gerar.php [ 374 ]
2013-08-12 10:50:30 --- STRACE: ErrorException [ 2 ]: Wrong parameter count for addcslashes() ~ APPPATH/classes/controller/gerar.php [ 374 ]
--
#0 [internal function]: Kohana_Core::error_handler(''')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(374): addcslashes()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-08-12 10:51:13 --- ERROR: ErrorException [ 2 ]: addcslashes() [function.addcslashes]: Invalid '..'-range, '..'-range needs to be incrementing ~ APPPATH/classes/controller/gerar.php [ 374 ]
2013-08-12 10:51:13 --- STRACE: ErrorException [ 2 ]: addcslashes() [function.addcslashes]: Invalid '..'-range, '..'-range needs to be incrementing ~ APPPATH/classes/controller/gerar.php [ 374 ]
--
#0 [internal function]: Kohana_Core::error_handler(''', 'z..A')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(374): addcslashes()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-08-12 10:56:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING ~ APPPATH/classes/controller/gerar.php [ 373 ]
2013-08-12 10:56:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING ~ APPPATH/classes/controller/gerar.php [ 373 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler('controller_gera...')
#1 {main}