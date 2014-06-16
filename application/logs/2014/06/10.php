<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-06-10 13:05:31 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.min.css ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2014-06-10 13:05:31 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.min.css ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#1 {main}
2014-06-10 13:05:31 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.js ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2014-06-10 13:05:31 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.js ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#1 {main}
2014-06-10 13:05:31 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.min.css ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2014-06-10 13:05:31 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: fancybox/jquery.fancybox-1.3.1.min.css ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#1 {main}
2014-06-10 13:12:57 --- ERROR: ErrorException [ 8 ]: Undefined index: fTabela ~ APPPATH/classes/controller/gerar.php [ 34 ]
2014-06-10 13:12:57 --- STRACE: ErrorException [ 8 ]: Undefined index: fTabela ~ APPPATH/classes/controller/gerar.php [ 34 ]
--
#0 /var/www/geradorCRUD/application/classes/controller/gerar.php(34): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/gerado...', 34, Array)
#1 [internal function]: Controller_Gerar->action_salvar()
#2 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Gerar))
#3 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#6 {main}
2014-06-10 13:14:48 --- ERROR: ErrorException [ 8 ]: Undefined index: fTabela ~ APPPATH/classes/controller/gerar.php [ 34 ]
2014-06-10 13:14:48 --- STRACE: ErrorException [ 8 ]: Undefined index: fTabela ~ APPPATH/classes/controller/gerar.php [ 34 ]
--
#0 /var/www/geradorCRUD/application/classes/controller/gerar.php(34): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/gerado...', 34, Array)
#1 [internal function]: Controller_Gerar->action_salvar()
#2 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Gerar))
#3 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#6 {main}