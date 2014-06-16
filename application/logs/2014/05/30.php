<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-05-30 10:38:42 --- ERROR: ErrorException [ 2 ]: fopen(upload/categoria noticias/controller/categoria noticias.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 1045 ]
2014-05-30 10:38:42 --- STRACE: ErrorException [ 2 ]: fopen(upload/categoria noticias/controller/categoria noticias.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 1045 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/categori...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(1045): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}