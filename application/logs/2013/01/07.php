<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-01-07 10:21:30 --- ERROR: Database_Exception [ 1113 ]: A table must have at least 1 column [ CREATE TABLE TESTE ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-07 10:21:30 --- STRACE: Database_Exception [ 1113 ]: A table must have at least 1 column [ CREATE TABLE TESTE ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(34): Kohana_Database_MySQL->query(1, 'CREATE TABLE TE...')
#1 [internal function]: Controller_Gerar->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-07 10:22:29 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-07 10:22:29 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE TE...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE TE...')
#3 /var/www/geradorCRUJ/application/classes/controller/gerar.php(34): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-07 10:22:37 --- ERROR: Database_Exception [ 1050 ]: Table 'TESTE' already exists [ CREATE TABLE TESTE ( TES_ID int(11) ) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-07 10:22:37 --- STRACE: Database_Exception [ 1050 ]: Table 'TESTE' already exists [ CREATE TABLE TESTE ( TES_ID int(11) ) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/gerar.php(34): Kohana_Database_MySQL->query(1, 'CREATE TABLE TE...')
#1 [internal function]: Controller_Gerar->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-07 10:23:05 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-07 10:23:05 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/gerar.php(34): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-07 10:24:18 --- ERROR: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
2013-01-07 10:24:18 --- STRACE: ErrorException [ 2 ]: mysql_num_rows(): supplied argument is not a valid MySQL result resource ~ MODPATH/database/classes/kohana/database/mysql/result.php [ 20 ]
--
#0 [internal function]: Kohana_Core::error_handler(true)
#1 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql/result.php(20): mysql_num_rows(true, 'CREATE TABLE IF...', false, NULL)
#2 /var/www/geradorCRUJ/modules/database/classes/kohana/database/mysql.php(210): Kohana_Database_MySQL_Result->__construct(1, 'CREATE TABLE IF...')
#3 /var/www/geradorCRUJ/application/classes/controller/gerar.php(34): Kohana_Database_MySQL->query()
#4 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#5 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#6 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#9 {main}
2013-01-07 10:30:40 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 60 ]
2013-01-07 10:30:40 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 60 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(60): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:31:30 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 60 ]
2013-01-07 10:31:30 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 60 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(60): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:32:18 --- ERROR: ErrorException [ 2 ]: fopen(http://192.168.10.1/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: HTTP wrapper does not support writeable connections ~ APPPATH/classes/controller/gerar.php [ 60 ]
2013-01-07 10:32:18 --- STRACE: ErrorException [ 2 ]: fopen(http://192.168.10.1/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: HTTP wrapper does not support writeable connections ~ APPPATH/classes/controller/gerar.php [ 60 ]
--
#0 [internal function]: Kohana_Core::error_handler('http://192.168....', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(60): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:33:14 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:33:14 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:37:42 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:37:42 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'rw+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:40:14 --- ERROR: ErrorException [ 2 ]: file_put_contents(/geradorCRUJ/upload/arquivos/teste.php) [function.file-put-contents]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 53 ]
2013-01-07 10:40:14 --- STRACE: ErrorException [ 2 ]: file_put_contents(/geradorCRUJ/upload/arquivos/teste.php) [function.file-put-contents]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 53 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'Primeira linha ...')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(53): file_put_contents()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:47:13 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:47:13 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/arquivos/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:54:05 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:54:05 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:58:30 --- ERROR: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:58:30 --- STRACE: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('teste.php', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:58:51 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:58:51 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:59:30 --- ERROR: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:59:30 --- STRACE: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('teste.php', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 10:59:57 --- ERROR: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 10:59:57 --- STRACE: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('teste.php', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 11:00:25 --- ERROR: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 11:00:25 --- STRACE: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('teste.php', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 11:00:39 --- ERROR: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 11:00:39 --- STRACE: ErrorException [ 2 ]: fopen(teste.php) [function.fopen]: failed to open stream: Permission denied ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('teste.php', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 11:02:38 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 11:02:38 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.php) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 11:08:31 --- ERROR: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.txt) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
2013-01-07 11:08:31 --- STRACE: ErrorException [ 2 ]: fopen(/geradorCRUJ/upload/teste.txt) [function.fopen]: failed to open stream: No such file or directory ~ APPPATH/classes/controller/gerar.php [ 54 ]
--
#0 [internal function]: Kohana_Core::error_handler('/geradorCRUJ/up...', 'w+')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(54): fopen()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 14:12:53 --- ERROR: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/controller/gerar.php [ 32 ]
2013-01-07 14:12:53 --- STRACE: ErrorException [ 8 ]: Array to string conversion ~ APPPATH/classes/controller/gerar.php [ 32 ]
--
#0 [internal function]: Kohana_Core::error_handler('Array')
#1 /var/www/geradorCRUJ/application/classes/controller/gerar.php(32): strtoupper()
#2 [internal function]: Controller_Gerar->action_salvar(Object(Controller_Gerar))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#7 {main}
2013-01-07 14:51:55 --- ERROR: ErrorException [ 1 ]: Call to undefined function str_pos() ~ APPPATH/classes/controller/gerar.php [ 37 ]
2013-01-07 14:51:55 --- STRACE: ErrorException [ 1 ]: Call to undefined function str_pos() ~ APPPATH/classes/controller/gerar.php [ 37 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}