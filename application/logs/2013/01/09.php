<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-01-09 09:43:38 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:43:38 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 09:43:38 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:43:38 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 09:44:04 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:44:04 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 09:44:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:44:05 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 09:44:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:44:05 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 09:44:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2013-01-09 09:44:05 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imgs/bt_menos.png ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#1 {main}
2013-01-09 10:39:38 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL tete was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2013-01-09 10:39:38 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL tete was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#3 {main}
2013-01-09 11:09:31 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:09:31 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:10:32 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',10/2-1/-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:10:32 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',10/2-1/-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:11:19 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:11:19 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:12:09 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:12:09 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:12:17 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:12:17 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:12:29 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:12:29 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:12:39 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:12:39 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/200-/1-'2,0.00)' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testabndo',/200-/1-'2,0.00) ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:17:09 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '2','0.00')' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testehsh','/201-/1-'2','0.00') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:17:09 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '2','0.00')' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testehsh','/201-/1-'2','0.00') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:17:36 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '2','0.00')' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testehsh','/201-/1-'2','0.00') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 11:17:36 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '2','0.00')' at line 2 [ insert into TESTE(TES_ID,TES_TITULO,TES_DATA,TES_VALOR) 
                values('0','testehsh','/201-/1-'2','0.00') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(95): Kohana_Database_MySQL->query(2, 'insert into TES...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 11:41:57 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '"' ~ APPPATH/classes/controller/teste.php [ 87 ]
2013-01-09 11:41:57 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '"' ~ APPPATH/classes/controller/teste.php [ 87 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler('controller_test...')
#1 {main}
2013-01-09 14:10:34 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '8.48'' where TES_ID = 
                '2'' at line 1 [ update TESTE set TES_ID = '2',TES_TITULO = 'teste 2',TES_DATA = '2010-10-10',TES_VALOR = ''8.48'' where TES_ID = 
                '2' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2013-01-09 14:10:34 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '8.48'' where TES_ID = 
                '2'' at line 1 [ update TESTE set TES_ID = '2',TES_TITULO = 'teste 2',TES_DATA = '2010-10-10',TES_VALOR = ''8.48'' where TES_ID = 
                '2' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/geradorCRUJ/application/classes/controller/teste.php(106): Kohana_Database_MySQL->query(3, 'update TESTE se...')
#1 [internal function]: Controller_Teste->action_salvar()
#2 /var/www/geradorCRUJ/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Teste))
#3 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#6 {main}
2013-01-09 14:46:09 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL teste was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2013-01-09 14:46:09 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL teste was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/geradorCRUJ/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/geradorCRUJ/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/geradorCRUJ/index.php(109): Kohana_Request->execute()
#3 {main}