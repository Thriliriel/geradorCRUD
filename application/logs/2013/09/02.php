<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-09-02 14:23:22 --- ERROR: ErrorException [ 2 ]: in_array() [function.in-array]: Wrong datatype for second argument ~ APPPATH/classes/controller/index.php [ 54 ]
2013-09-02 14:23:22 --- STRACE: ErrorException [ 2 ]: in_array() [function.in-array]: Wrong datatype for second argument ~ APPPATH/classes/controller/index.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/upload', 'ckeditor')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(54): in_array()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:23:57 --- ERROR: ErrorException [ 2 ]: in_array() [function.in-array]: Wrong datatype for second argument ~ APPPATH/classes/controller/index.php [ 54 ]
2013-09-02 14:23:57 --- STRACE: ErrorException [ 2 ]: in_array() [function.in-array]: Wrong datatype for second argument ~ APPPATH/classes/controller/index.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('ckeditor', 'upload/upload')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(54): in_array()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:46:25 --- ERROR: ErrorException [ 2 ]: rmdir(upload/upload) [function.rmdir]: Directory not empty ~ APPPATH/classes/controller/index.php [ 57 ]
2013-09-02 14:46:25 --- STRACE: ErrorException [ 2 ]: rmdir(upload/upload) [function.rmdir]: Directory not empty ~ APPPATH/classes/controller/index.php [ 57 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/upload')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(57): rmdir()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:47:51 --- ERROR: ErrorException [ 2 ]: unlink(upload/uploadcontroller/*) [function.unlink]: No such file or directory ~ APPPATH/classes/controller/index.php [ 57 ]
2013-09-02 14:47:51 --- STRACE: ErrorException [ 2 ]: unlink(upload/uploadcontroller/*) [function.unlink]: No such file or directory ~ APPPATH/classes/controller/index.php [ 57 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/uploadco...')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(57): unlink()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:49:29 --- ERROR: ErrorException [ 2 ]: rmdir(upload/uploadcontroller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 58 ]
2013-09-02 14:49:29 --- STRACE: ErrorException [ 2 ]: rmdir(upload/uploadcontroller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 58 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/uploadco...')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(58): rmdir()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:49:54 --- ERROR: ErrorException [ 2 ]: rmdir(upload/uploadcontroller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 59 ]
2013-09-02 14:49:54 --- STRACE: ErrorException [ 2 ]: rmdir(upload/uploadcontroller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 59 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/uploadco...')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(59): rmdir()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:53:11 --- ERROR: ErrorException [ 2 ]: rmdir(upload/upload/controller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 63 ]
2013-09-02 14:53:11 --- STRACE: ErrorException [ 2 ]: rmdir(upload/upload/controller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 63 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/upload/c...')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(63): rmdir()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}
2013-09-02 14:54:13 --- ERROR: ErrorException [ 2 ]: rmdir(upload/upload/controller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 63 ]
2013-09-02 14:54:13 --- STRACE: ErrorException [ 2 ]: rmdir(upload/upload/controller) [function.rmdir]: No such file or directory ~ APPPATH/classes/controller/index.php [ 63 ]
--
#0 [internal function]: Kohana_Core::error_handler('upload/upload/c...')
#1 /var/www/geradorCRUJ/application/classes/controller/index.php(63): rmdir()
#2 /var/www/geradorCRUJ/application/classes/controller/gerar.php(8): Controller_Index->before()
#3 [internal function]: Controller_Gerar->before(Object(Controller_Gerar))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#7 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#8 {main}