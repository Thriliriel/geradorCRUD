<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-08-19 15:18:01 --- ERROR: ErrorException [ 2 ]: fopen(upload/CIDADE/controller/cidade.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 740 ]
2013-08-19 15:18:01 --- STRACE: ErrorException [ 2 ]: fopen(upload/CIDADE/controller/cidade.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 740 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/CIDADE/c...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(740): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}