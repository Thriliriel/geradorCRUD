<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-06-11 23:27:41 --- ERROR: ErrorException [ 2 ]: fopen(upload//controller/.php): failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 1045 ]
2014-06-11 23:27:41 --- STRACE: ErrorException [ 2 ]: fopen(upload//controller/.php): failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 1045 ]
--
#0 [internal function]: Kohana_Core::error_handler(2, 'fopen(upload//c...', '/var/www/gerado...', 1045, Array)
#1 /var/www/geradorCRUD/application/classes/controller/gerar.php(1045): fopen('upload//control...', 'w+')
#2 [internal function]: Controller_Gerar->action_salvar()
#3 /var/www/geradorCRUD/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Gerar))
#4 /var/www/geradorCRUD/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUD/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/geradorCRUD/index.php(109): Kohana_Request->execute()
#7 {main}