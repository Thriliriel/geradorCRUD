<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-12-21 13:59:14 --- ERROR: ErrorException [ 8 ]: Undefined variable: banners ~ APPPATH/views/template.php [ 98 ]
2012-12-21 13:59:14 --- STRACE: ErrorException [ 8 ]: Undefined variable: banners ~ APPPATH/views/template.php [ 98 ]
--
#0 /var/www/paulo/application/views/template.php(98): Kohana_Core::error_handler('/var/www/paulo/...', Array)
#1 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#2 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after(Object(Controller_Index))
#5 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#6 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/paulo/index.php(109): Kohana_Request->execute()
#9 {main}