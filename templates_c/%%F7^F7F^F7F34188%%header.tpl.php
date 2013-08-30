<?php /* Smarty version 2.6.26, created on 2013-08-30 12:15:31
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->_tpl_vars['g_title']; ?>
 - <?php echo $this->_tpl_vars['page_title']; ?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    <link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/css/tweeter.css" rel="stylesheet">
	<link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/css/main.css" rel="stylesheet" media="screen">
	
	<!-- Javascript -->
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['g_base_url']; ?>
/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['g_base_url']; ?>
/js/admin.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['g_base_url']; ?>
/js/menu.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['g_base_url']; ?>
/js/browser.js"></script>
	
    <style type="text/css">
        <?php echo '
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      '; ?>

    </style>
    <link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/images/favicon.png">

    <link rel="apple-touch-icon" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/images/apple-touch-icon-114x114.png">
    
    
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../templates/common/head_include.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
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
          <a class="brand" href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/out.php"><?php echo $this->_tpl_vars['g_title']; ?>
</a>
          <div class="nav-collapse collapse">
            <ul class="nav">

              <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/out.php"><?php echo $this->_tpl_vars['g_lang_home']; ?>
</a></li>
              <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/in.php"><?php echo $this->_tpl_vars['g_lang_button_check_in']; ?>
</a></li>
              <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/search.php"><?php echo $this->_tpl_vars['g_lang_search']; ?>
</a></li>
              <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/add.php"><?php echo $this->_tpl_vars['g_lang_button_add_document']; ?>
</a></li>
              <?php if ($this->_tpl_vars['isadmin'] == 'yes'): ?>
              <li>
                 
                    <a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/admin.php"><?php echo $this->_tpl_vars['g_lang_label_admin']; ?>
</a>
              </li>
              <?php endif; ?>
			  <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/docs/manual.php">Manual</a></li>
              <li><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/logout.php"><?php echo $this->_tpl_vars['g_lang_logout']; ?>
</a></li>
            </ul>          
              <p class="navbar-text pull-right">
<?php echo $this->_tpl_vars['g_lang_label_logged_in_as']; ?>

<a href="<?php echo $this->_tpl_vars['base_url']; ?>
/profile.php"><?php echo $this->_tpl_vars['userName']; ?>
</a>
</p>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    </div>
<?php if ($this->_tpl_vars['g_demo'] == 'True'): ?>
    <h1>Demo resets once per hour</h1>
<?php endif; ?>
	<div class="container-wrapper">
      <div class="container">
        <div class="row">
            <div class="span4">
                You are here: <?php echo $this->_tpl_vars['breadCrumb']; ?>

            </div>
        </div>
        <p></p>
        <?php if ($this->_tpl_vars['lastmessage'] != ''): ?>
            <div id="last_message"><?php echo $this->_tpl_vars['lastmessage']; ?>
</div>
        <?php endif; ?>