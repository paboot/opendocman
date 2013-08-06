<?php /* Smarty version 2.6.26, created on 2013-08-06 08:05:21
         compiled from login.tpl */ ?>
        <html>
        <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->

    <link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/templates/tweeter/css/tweeter.css" rel="stylesheet">
	
	<!-- Design by Pabot -->
	<link href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/css/main.css" rel="stylesheet">
	
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
/templates/tweeter/images/favicon.ico">

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
    
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title><?php echo $this->_tpl_vars['g_title']; ?>
</title>
        </head>

        <body>

        <table style="margin:auto" cellspacing="0" cellpadding="0">
        <tr>
        <td align="left"><img src="images/logo.gif" alt="Site Logo" border=0></td>
        </tr>
        </table>

        <table class="login-table" cellspacing="5" cellpadding="5">
			<tr>
				<td class="login-table" align="center">
					<p id="login-welcome">
						<?php echo $this->_tpl_vars['g_lang_welcome']; ?>
<br>
						<?php echo $this->_tpl_vars['g_lang_welcome2']; ?>

					</p>
				</td>
			</tr>
			<tr>
				<td class="login-table" align="center">
					<table border="0" cellspacing="5" cellpadding="5">
						<form action="index.php" method="post">
            <?php if ($this->_tpl_vars['redirection']): ?>
                <input type="hidden" name="redirection" value="<?php echo $this->_tpl_vars['redirection']; ?>
">
            <?php endif; ?>
            
         <tr>
        <td><?php echo $this->_tpl_vars['g_lang_username']; ?>
</td>
        <td><input type="Text" name="frmuser" size="15"></td>
        </tr>
        <tr>
        <td><?php echo $this->_tpl_vars['g_lang_password']; ?>
</td>
        <td><input type="password" name="frmpass" size="15">
            <?php if ($this->_tpl_vars['g_allow_password_reset'] == 'True'): ?>
                <a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/forgot_password.php"><?php echo $this->_tpl_vars['g_lang_forgotpassword']; ?>
</a>
             <?php endif; ?>
                     </td>
        </tr>
        <tr>
        <td colspan="2" align="center"><input type="submit" name="login" value="<?php echo $this->_tpl_vars['g_lang_enter']; ?>
"></td>
        </tr>
                </tr>
                <?php if ($this->_tpl_vars['g_demo'] == 'True'): ?>
        Regular User: <br />Username:demo Password:demo<br />
        Admin User: <br />Username:admin Password:admin<br />
        <?php endif; ?>
        <?php if ($this->_tpl_vars['g_allow_signup'] == 'True'): ?>
                <tr>
            <td colspan="2"><a href="<?php echo $this->_tpl_vars['g_base_url']; ?>
/signup.php"><?php echo $this->_tpl_vars['g_lang_signup']; ?>
</a>
        </tr>
        <?php endif; ?>
        
        </form>
        </table>
        </td>
        </tr>
        </table>