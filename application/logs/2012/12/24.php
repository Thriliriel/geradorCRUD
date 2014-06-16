<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2012-12-24 09:24:23 --- ERROR: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, integer given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
2012-12-24 09:24:23 --- STRACE: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, integer given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query/builder/insert.php(80): Kohana_Core::error_handler(0, 'paulo', 'paulo@ows.com.b...', 'tio', '46c87e7e726f019...', 'N')
#1 /var/www/paulo/application/classes/controller/cadastro.php(36): Kohana_Database_Query_Builder_Insert->values()
#2 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 09:24:43 --- ERROR: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, integer given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
2012-12-24 09:24:43 --- STRACE: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, integer given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query/builder/insert.php(80): Kohana_Core::error_handler(0, 'paulo', 'wsk.shadow@gmai...', 'tio', 'f00f566008e6e29...', 'N')
#1 /var/www/paulo/application/classes/controller/cadastro.php(36): Kohana_Database_Query_Builder_Insert->values()
#2 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 09:25:07 --- ERROR: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, string given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
2012-12-24 09:25:07 --- STRACE: ErrorException [ 4096 ]: Argument 1 passed to Kohana_Database_Query_Builder_Insert::values() must be an array, string given, called in /var/www/paulo/application/classes/controller/cadastro.php on line 36 and defined ~ MODPATH/database/classes/kohana/database/query/builder/insert.php [ 80 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query/builder/insert.php(80): Kohana_Core::error_handler('0', 'paulo', 'wsk.shadow@gmai...', 'tio', 'f00f566008e6e29...', 'N')
#1 /var/www/paulo/application/classes/controller/cadastro.php(36): Kohana_Database_Query_Builder_Insert->values()
#2 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 09:28:52 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry 'wsk.shadow@gmail.com' for key 2 [ INSERT INTO `CLIENTES` (`CLI_ID`, `CLI_NOME`, `CLI_EMAIL`, `CLI_LOGIN`, `CLI_SENHA`, `CLI_ATIVADO`) VALUES (0, 'paulo', 'wsk.shadow@gmail.com', 'tio', '20fc31b71a27944d085805055a615b36', 'N') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-12-24 09:28:52 --- STRACE: Database_Exception [ 1062 ]: Duplicate entry 'wsk.shadow@gmail.com' for key 2 [ INSERT INTO `CLIENTES` (`CLI_ID`, `CLI_NOME`, `CLI_EMAIL`, `CLI_LOGIN`, `CLI_SENHA`, `CLI_ATIVADO`) VALUES (0, 'paulo', 'wsk.shadow@gmail.com', 'tio', '20fc31b71a27944d085805055a615b36', 'N') ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(2, 'INSERT INTO `CL...', false, Array)
#1 /var/www/paulo/application/classes/controller/cadastro.php(38): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Cadastro->action_salvar()
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Cadastro))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 09:33:23 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: cadastro/verificaEmail/wsk.shadow@gmail.com ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-12-24 09:33:23 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: cadastro/verificaEmail/wsk.shadow@gmail.com ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/paulo/index.php(109): Kohana_Request->execute()
#1 {main}
2012-12-24 09:34:56 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: cadastro/verificaEmail/wsk.shadow ~ SYSPATH/classes/kohana/request.php [ 1142 ]
2012-12-24 09:34:56 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: cadastro/verificaEmail/wsk.shadow ~ SYSPATH/classes/kohana/request.php [ 1142 ]
--
#0 /var/www/paulo/index.php(109): Kohana_Request->execute()
#1 {main}
2012-12-24 09:40:00 --- ERROR: ErrorException [ 8 ]: Undefined variable: qry ~ APPPATH/classes/controller/cadastro.php [ 55 ]
2012-12-24 09:40:00 --- STRACE: ErrorException [ 8 ]: Undefined variable: qry ~ APPPATH/classes/controller/cadastro.php [ 55 ]
--
#0 /var/www/paulo/application/classes/controller/cadastro.php(55): Kohana_Core::error_handler()
#1 [internal function]: Controller_Cadastro->action_verificaEmail(Object(Controller_Cadastro))
#2 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/paulo/index.php(109): Kohana_Request->execute()
#6 {main}
2012-12-24 09:40:10 --- ERROR: ErrorException [ 8 ]: Undefined variable: qry ~ APPPATH/classes/controller/cadastro.php [ 55 ]
2012-12-24 09:40:10 --- STRACE: ErrorException [ 8 ]: Undefined variable: qry ~ APPPATH/classes/controller/cadastro.php [ 55 ]
--
#0 /var/www/paulo/application/classes/controller/cadastro.php(55): Kohana_Core::error_handler()
#1 [internal function]: Controller_Cadastro->action_verificaEmail(Object(Controller_Cadastro))
#2 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/paulo/index.php(109): Kohana_Request->execute()
#6 {main}
2012-12-24 10:04:38 --- ERROR: ErrorException [ 8 ]: Undefined index:  flogin ~ APPPATH/classes/controller/cadastro.php [ 43 ]
2012-12-24 10:04:38 --- STRACE: ErrorException [ 8 ]: Undefined index:  flogin ~ APPPATH/classes/controller/cadastro.php [ 43 ]
--
#0 /var/www/paulo/application/classes/controller/cadastro.php(43): Kohana_Core::error_handler()
#1 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#2 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/paulo/index.php(109): Kohana_Request->execute()
#6 {main}
2012-12-24 10:14:51 --- ERROR: ErrorException [ 8 ]: Undefined variable: conteudo ~ APPPATH/views/template.php [ 54 ]
2012-12-24 10:14:51 --- STRACE: ErrorException [ 8 ]: Undefined variable: conteudo ~ APPPATH/views/template.php [ 54 ]
--
#0 /var/www/paulo/application/views/template.php(54): Kohana_Core::error_handler('/var/www/paulo/...', Array)
#1 /var/www/paulo/system/classes/kohana/view.php(61): include('/var/www/paulo/...')
#2 /var/www/paulo/system/classes/kohana/view.php(343): Kohana_View::capture()
#3 /var/www/paulo/system/classes/kohana/controller/template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after(Object(Controller_Email))
#5 /var/www/paulo/system/classes/kohana/request/client/internal.php(119): ReflectionMethod->invoke(Object(Request))
#6 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#8 /var/www/paulo/index.php(109): Kohana_Request->execute()
#9 {main}
2012-12-24 10:16:51 --- ERROR: ErrorException [ 2 ]: Controller_Email::include() [function.include]: Failed opening '' for inclusion (include_path='.:/usr/share/php:/usr/share/pear') ~ APPPATH/classes/controller/email.php [ 24 ]
2012-12-24 10:16:51 --- STRACE: ErrorException [ 2 ]: Controller_Email::include() [function.include]: Failed opening '' for inclusion (include_path='.:/usr/share/php:/usr/share/pear') ~ APPPATH/classes/controller/email.php [ 24 ]
--
#0 /var/www/paulo/application/classes/controller/email.php(24): Kohana_Core::error_handler()
#1 /var/www/paulo/application/classes/controller/email.php(24): Controller_Email::action_enviar()
#2 [internal function]: Controller_Email->action_enviar(Object(Controller_Email))
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 10:17:34 --- ERROR: ErrorException [ 2 ]: Controller_Email::include() [function.include]: Failed opening '' for inclusion (include_path='.:/usr/share/php:/usr/share/pear') ~ APPPATH/classes/controller/email.php [ 24 ]
2012-12-24 10:17:34 --- STRACE: ErrorException [ 2 ]: Controller_Email::include() [function.include]: Failed opening '' for inclusion (include_path='.:/usr/share/php:/usr/share/pear') ~ APPPATH/classes/controller/email.php [ 24 ]
--
#0 /var/www/paulo/application/classes/controller/email.php(24): Kohana_Core::error_handler()
#1 /var/www/paulo/application/classes/controller/email.php(24): Controller_Email::action_enviar()
#2 [internal function]: Controller_Email->action_enviar(Object(Controller_Email))
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}
2012-12-24 10:26:01 --- ERROR: ErrorException [ 1 ]: Undefined class constant 'modules' ~ APPPATH/classes/controller/email.php [ 22 ]
2012-12-24 10:26:01 --- STRACE: ErrorException [ 1 ]: Undefined class constant 'modules' ~ APPPATH/classes/controller/email.php [ 22 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-12-24 12:54:28 --- ERROR: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/controller/cadastro.php [ 58 ]
2012-12-24 12:54:28 --- STRACE: ErrorException [ 1 ]: Class 'Email' not found ~ APPPATH/classes/controller/cadastro.php [ 58 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2012-12-24 12:54:57 --- ERROR: ErrorException [ 2048 ]: Non-static method Controller_Email::enviar() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/cadastro.php [ 58 ]
2012-12-24 12:54:57 --- STRACE: ErrorException [ 2048 ]: Non-static method Controller_Email::enviar() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/cadastro.php [ 58 ]
--
#0 /var/www/paulo/application/classes/controller/cadastro.php(58): Kohana_Core::error_handler()
#1 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#2 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/paulo/index.php(109): Kohana_Request->execute()
#6 {main}
2012-12-24 12:55:47 --- ERROR: ErrorException [ 2048 ]: Non-static method Controller_Email::action_enviar() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/cadastro.php [ 58 ]
2012-12-24 12:55:47 --- STRACE: ErrorException [ 2048 ]: Non-static method Controller_Email::action_enviar() should not be called statically, assuming $this from incompatible context ~ APPPATH/classes/controller/cadastro.php [ 58 ]
--
#0 /var/www/paulo/application/classes/controller/cadastro.php(58): Kohana_Core::error_handler()
#1 [internal function]: Controller_Cadastro->action_salvar(Object(Controller_Cadastro))
#2 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Request))
#3 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute()
#5 /var/www/paulo/index.php(109): Kohana_Request->execute()
#6 {main}
2012-12-24 12:56:07 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/controller/email.php [ 21 ]
2012-12-24 12:56:07 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/controller/email.php [ 21 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler(1, 'paulo@ows.com.b...')
#1 {main}
2012-12-24 13:47:20 --- ERROR: Database_Exception [ 1140 ]: Mixing of GROUP columns (MIN(),MAX(),COUNT(),...) with no GROUP columns is illegal if there is no GROUP BY clause [ SELECT COUNT(CLI_ID) AS `qnt`, `CLI_ID`, `CLI_NOME` FROM `CLIENTES` WHERE `CLI_LOGIN` = 'tio' AND `CLI_SENHA` = 'f00f566008e6e294d74a517d9df3fae1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2012-12-24 13:47:20 --- STRACE: Database_Exception [ 1140 ]: Mixing of GROUP columns (MIN(),MAX(),COUNT(),...) with no GROUP columns is illegal if there is no GROUP BY clause [ SELECT COUNT(CLI_ID) AS `qnt`, `CLI_ID`, `CLI_NOME` FROM `CLIENTES` WHERE `CLI_LOGIN` = 'tio' AND `CLI_SENHA` = 'f00f566008e6e294d74a517d9df3fae1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /var/www/paulo/modules/database/classes/kohana/database/query.php(245): Kohana_Database_MySQL->query(1, 'SELECT COUNT(CL...', false, Array)
#1 /var/www/paulo/application/classes/controller/conta.php(52): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Conta->action_logar()
#3 /var/www/paulo/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Conta))
#4 /var/www/paulo/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/paulo/system/classes/kohana/request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/paulo/index.php(109): Kohana_Request->execute()
#7 {main}