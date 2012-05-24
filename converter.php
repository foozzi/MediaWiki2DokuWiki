<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LinuXeeD конвертор ищ MediaWiki в DokuWiki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="convert mediawiki2dokuwiki">
    <meta name="author" content="linuxeed">

    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="./bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="./bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./bootstrap/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">LinuXeeD Converter</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="/converter.php">Главная</a></li>
              <li><a href="/">Главная Wiki</a></li>                                       
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Конвертер из MediaWiki синтаксиса в DokuWiki</h1>
      <p>Если у вас есть статьи на MediaWiki синтаксисе, вы можете конвертировать ее с помощью нашего конвертора в синтаксис DokuWiki.</p>
    </div> <!-- /container -->
<?php
if (isset($_POST['mediawiki'])) {
  $replacements = array(
        '^[ ]*=([^=])'=>'<h1> ${1}',
        '([^=])=[ ]*$'=>'${1} </h1>',
        '^[ ]*==([^=])'=>'<h2> ${1}',
        '([^=])==[ ]*$'=>'${1} </h2>',
        '^[ ]*===([^=])'=>'<h3> ${1}',
        '([^=])===[ ]*$'=>'${1} </h3>',
        '^[ ]*====([^=])'=>'<h4> ${1}',
        '([^=])====[ ]*$'=>'${1} </h4>',
        '^[ ]*=====([^=])'=>'<h5> ${1}',
        '([^=])=====[ ]*$'=>'${1} </h5>',
        '^[ ]*======([^=])'=>'<h6> ${1}',
        '([^=])======[ ]*$'=>'${1} </h6>',
        
        '<\/?h1>'=>'======',
        '<\/?h2>'=>'=====',
        '<\/?h3>'=>'====',
        '<\/?h4>'=>'===',
        '<\/?h5>'=>'==',
        '<\/?h6>'=>'=',
        
        '^[\*#]{4}\* ?'=>'          * ',
        '^[\*#]{3}\* ?'=>'        * ',
        '^[\*#]{2}\* ?'=>'      * ',
        '^[\*#]{1}\* ?'=>'    * ',
        '^\* ?'=>'  * ',
        '^[\*#]{4}# ?'=>'          \- ',
        '^[\*\#]{3}\# ?'=>'      \- ',
        '^[\*\#]{2}\# ?'=>'    \- ',
        '^[\*\#]{1}\# ?'=>'  \- ',
        '^\# ?'=>'  - ',
        
        '([^\[])\[([^\[])'=>'${1}[[${2}',
        '^\[([^\[])'=>'[[${1}',
        '([^\]])\]([^\]])'=>'${1}]]${2}',
        '([^\]])\]$'=>'${1}]]',
        
        '(\[\[[^| \]]*) ([^|\]]*\]\])'=>'${1}|${2}',
        
        "'''"=>"**",
        "''"=>"//",
        
        "^[ ]*:"=>">",
        ">:"=>">>",
        ">>:"=>">>>",
        ">>>:"=>">>>>",
        ">>>>:"=>">>>>>",
        ">>>>>:"=>">>>>>>",
        ">>>>>>:"=>">>>>>>>",
        
        "<pre>"=>"<code>",
        "<br[^>]*>"=>"\\\\\\\\",
        "<\/pre>"=>"<\/code>"
    );
    $_POST['mediawiki'] = stripslashes($_POST['mediawiki']);
    $dokuwiki = split("\r\n",stripslashes($_POST['mediawiki']));
    if(!empty($dokuwiki)) foreach($replacements as $k=>$v){
        for($i=0;$i<count($dokuwiki);$i++)
            $dokuwiki = preg_replace('/'.$k.'/',$v,$dokuwiki);
        //echo (++$j)."\r\n";
        //echo $dokuwiki."\r\n";
    }
    $dokuwiki = join("\r\n",$dokuwiki);
    echo '<h2 class="span2" >Dokuwiki:</h2><textarea class="span2"style="WIDTH: 500px; HEIGHT: 300px" name="dokuwiki">' . $dokuwiki . '</textarea>';
    die('');
}
    
?>

<h2 class="span2" >Mediawiki:</h2>
<form class="span2" action="" method="post">
<textarea style="WIDTH: 500px; HEIGHT: 300px" name="mediawiki"><?php //echo $_POST['mediawiki'] ?></textarea>
<input class="btn" type="submit" value="Конвертировать">
</form>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./bootstrap/js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap-transition.js"></script>
    <script src="./bootstrap/js/bootstrap-alert.js"></script>
    <script src="./bootstrap/js/bootstrap-modal.js"></script>
    <script src="./bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="./bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="./bootstrap/js/bootstrap-tab.js"></script>
    <script src="./bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="./bootstrap/js/bootstrap-popover.js"></script>
    <script src="./bootstrap/js/bootstrap-button.js"></script>
    <script src="./bootstrap/js/bootstrap-collapse.js"></script>
    <script src="./bootstrap/js/bootstrap-carousel.js"></script>
    <script src="./bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
