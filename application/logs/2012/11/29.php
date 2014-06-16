<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-11-29 09:59:39 --- ERROR: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 1 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-11-29 09:59:39 --- STRACE: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 1 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/dme/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT * FROM `...', false, Array)
#1 /var/www/dme/application/classes/controller/index.php(37): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}
2012-11-29 10:28:36 --- ERROR: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 5 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-11-29 10:28:36 --- STRACE: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 5 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/dme/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT * FROM `...', false, Array)
#1 /var/www/dme/application/classes/controller/contato.php(21): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Contato->action_index()
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Contato))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}
2012-11-29 11:22:30 --- ERROR: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 5 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-11-29 11:22:30 --- STRACE: Database_Exception [ 1146 ]: Table 'DME.NOTICIAS' doesn't exist [ SELECT * FROM `NOTICIAS` WHERE `NOT_MANCHETE` = 'S' ORDER BY `NOT_DATA` DESC LIMIT 5 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/dme/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT * FROM `...', false, Array)
#1 /var/www/dme/application/classes/controller/contato.php(21): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Contato->action_index()
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Contato))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}
2012-11-29 11:30:39 --- ERROR: ErrorException [ 8 ]: Undefined index:  email_cont ~ APPPATH/classes/controller/contato.php [ 39 ]
2012-11-29 11:30:39 --- STRACE: ErrorException [ 8 ]: Undefined index:  email_cont ~ APPPATH/classes/controller/contato.php [ 39 ]
--
#0 /var/www/dme/application/classes/controller/contato.php(39): Kohana_Core::error_handler()
#1 [internal function]: Controller_Contato->action_enviar(Object(Controller_Contato))
#2 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/dme/index.php(109): Kohana_Request->execute()
#6 {main}
2012-11-29 14:56:32 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Controller_Produto::action_ver() ~ APPPATH/classes/controller/produto.php [ 39 ]
2012-11-29 14:56:32 --- STRACE: ErrorException [ 2 ]: Missing argument 1 for Controller_Produto::action_ver() ~ APPPATH/classes/controller/produto.php [ 39 ]
--
#0 /var/www/dme/application/classes/controller/produto.php(39): Kohana_Core::error_handler()
#1 [internal function]: Controller_Produto->action_ver(Object(Controller_Produto))
#2 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/dme/index.php(109): Kohana_Request->execute()
#6 {main}
2012-11-29 14:57:14 --- ERROR: ErrorException [ 1 ]: Call to undefined method Request::params() ~ APPPATH/classes/controller/produto.php [ 40 ]
2012-11-29 14:57:14 --- STRACE: ErrorException [ 1 ]: Call to undefined method Request::params() ~ APPPATH/classes/controller/produto.php [ 40 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-29 14:57:45 --- ERROR: ErrorException [ 2048 ]: Non-static method Kohana_Request::redirect() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/produto.php [ 18 ]
2012-11-29 14:57:45 --- STRACE: ErrorException [ 2048 ]: Non-static method Kohana_Request::redirect() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/produto.php [ 18 ]
--
#0 /var/www/dme/application/classes/controller/produto.php(18): Kohana_Core::error_handler(NULL, 'Comercial')
#1 /var/www/dme/application/classes/controller/produto.php(40): Controller_Produto->action_index()
#2 [internal function]: Controller_Produto->action_ver(Object(Controller_Produto))
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}
2012-11-29 14:59:17 --- ERROR: ErrorException [ 1 ]: Class 'Produto' not found ~ APPPATH/classes/controller/produto.php [ 41 ]
2012-11-29 14:59:17 --- STRACE: ErrorException [ 1 ]: Class 'Produto' not found ~ APPPATH/classes/controller/produto.php [ 41 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-29 14:59:25 --- ERROR: ErrorException [ 1 ]: Call to undefined function action_index() ~ APPPATH/classes/controller/produto.php [ 41 ]
2012-11-29 14:59:25 --- STRACE: ErrorException [ 1 ]: Call to undefined function action_index() ~ APPPATH/classes/controller/produto.php [ 41 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-11-29 15:00:32 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-11-29 15:00:32 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/dme/index.php(109): Kohana_Request->execute()
#1 {main}
2012-11-29 15:00:33 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-11-29 15:00:33 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/dme/index.php(109): Kohana_Request->execute()
#1 {main}
2012-11-29 15:02:25 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-11-29 15:02:25 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/dme/index.php(109): Kohana_Request->execute()
#1 {main}
2012-11-29 15:02:26 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-11-29 15:02:26 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: produto/ver/4/images/foto1.jpg ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/dme/index.php(109): Kohana_Request->execute()
#1 {main}
2012-11-29 15:10:09 --- ERROR: ErrorException [ 8 ]: Undefined offset:  0 ~ APPPATH/views/produto.php [ 27 ]
2012-11-29 15:10:09 --- STRACE: ErrorException [ 8 ]: Undefined offset:  0 ~ APPPATH/views/produto.php [ 27 ]
--
#0 /var/www/dme/application/views/produto.php(27): Kohana_Core::error_handler('/var/www/dme/ap...', Array)
#1 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#2 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/dme/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /var/www/dme/application/views/template.php(136): Kohana_View->__toString('/var/www/dme/ap...', Array)
#5 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#6 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#7 /var/www/dme/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after(Object(Controller_Produto))
#9 /var/www/dme/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#10 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#12 /var/www/dme/index.php(109): Kohana_Request->execute()
#13 {main}
2012-11-29 15:23:23 --- ERROR: ErrorException [ 8 ]: Undefined variable: projetos ~ APPPATH/views/projetos.php [ 5 ]
2012-11-29 15:23:23 --- STRACE: ErrorException [ 8 ]: Undefined variable: projetos ~ APPPATH/views/projetos.php [ 5 ]
--
#0 /var/www/dme/application/views/projetos.php(5): Kohana_Core::error_handler('/var/www/dme/ap...', Array)
#1 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#2 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/dme/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /var/www/dme/application/views/template.php(136): Kohana_View->__toString('/var/www/dme/ap...', Array)
#5 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#6 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#7 /var/www/dme/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after(Object(Controller_Projetos))
#9 /var/www/dme/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#10 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#12 /var/www/dme/index.php(109): Kohana_Request->execute()
#13 {main}
2012-11-29 15:23:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: produtos ~ APPPATH/views/projetos.php [ 27 ]
2012-11-29 15:23:36 --- STRACE: ErrorException [ 8 ]: Undefined variable: produtos ~ APPPATH/views/projetos.php [ 27 ]
--
#0 /var/www/dme/application/views/projetos.php(27): Kohana_Core::error_handler('/var/www/dme/ap...', Array)
#1 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#2 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/dme/system/classes/kohana/view.php(228): Kohana_View->render()
#4 /var/www/dme/application/views/template.php(136): Kohana_View->__toString('/var/www/dme/ap...', Array)
#5 /var/www/dme/system/classes/kohana/view.php(61): include('/var/www/dme/ap...')
#6 /var/www/dme/system/classes/kohana/view.php(343): Kohana_View::capture()
#7 /var/www/dme/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after(Object(Controller_Projetos))
#9 /var/www/dme/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#10 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#12 /var/www/dme/index.php(109): Kohana_Request->execute()
#13 {main}
2012-11-29 18:19:50 --- ERROR: Database_Exception [ 1146 ]: Table 'DME.EMAIL' doesn't exist [ SELECT COUNT(EMA_IDEMAIL) AS `QTD` FROM `EMAIL` WHERE `EMA_EMAIL` = 'paulo@ows.com.br' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-11-29 18:19:50 --- STRACE: Database_Exception [ 1146 ]: Table 'DME.EMAIL' doesn't exist [ SELECT COUNT(EMA_IDEMAIL) AS `QTD` FROM `EMAIL` WHERE `EMA_EMAIL` = 'paulo@ows.com.br' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/dme/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT COUNT(EM...', false, Array)
#1 /var/www/dme/application/classes/controller/contato.php(126): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Contato->action_cadastrar()
#3 /var/www/dme/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Contato))
#4 /var/www/dme/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/dme/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/dme/index.php(109): Kohana_Request->execute()
#7 {main}