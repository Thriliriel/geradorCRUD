<!DOCTYPE html>
<html lang="pt">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Paulo" />
        <meta name="keywords" content="Paulo" />
        <meta name="RATING" content="GENERAL" />
        <meta name="REVISIT-AFTER" content="2 days" />
        <meta name="LANGUAGE" content="pt-br" />
        <meta name="ROBOTS" content="all" />
        <meta name="GOOGLEBOT" content="INDEX, FOLLOW" />
        <meta name="author" content="Paulo Knob" />
        <link rel="shortcut icon" href="<?php echo url::base(); ?>favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=8,chrome=1" />

        <script type="text/javascript">
            var URLBASE = "<?php echo url::base() ?>";
        </script>

        <!--JQUERY-->
        <script src="<?php echo url::base(); ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>

        <!--FANCYBOX-->
        <script src="<?php echo url::base(); ?>js/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo url::base(); ?>js/fancybox/jquery.fancybox-1.3.1.min.css" type="text/css" media="" />
        <!--FIM FANCYBOX-->
        
        <link href="<?php echo url::base(); ?>css/style.css" type="text/css" rel="stylesheet" />

        <script src="<?php echo url::base(); ?>js/forms_etc.js"></script>

    </head>
    
    <body>
        <div id="topo">
            TIO
        </div>
        
        <div id="meio">
            <ul id="menu">
                <!--<li><a href="<?php echo url::base() ?>">Home</a></li>--
                                
                <li><a href="<?php echo url::base() ?>gerar">Gerar</a></li>-->
            </ul>
            
            <?php echo $conteudo ?>
        </div>
        
        <div id="rodape">
            
        </div>
    </body>
</html>