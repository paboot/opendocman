        <html>
        <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->

    <link href="{$g_base_url}/templates/tweeter/css/bootstrap.css" rel="stylesheet">
    <link href="{$g_base_url}/templates/tweeter/css/tweeter.css" rel="stylesheet">
	
	<!-- Design by Pabot and Fandi -->
	<link href="{$g_base_url}/css/main.css" rel="stylesheet">
	
    <style type="text/css">
        {literal}
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      {/literal}
    </style>
    <link href="{$g_base_url}/templates/tweeter/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="{$g_base_url}/templates/tweeter/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="{$g_base_url}/images/favicon.png">

    <link rel="apple-touch-icon" href="{$g_base_url}/templates/tweeter/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{$g_base_url}/templates/tweeter/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{$g_base_url}/templates/tweeter/images/apple-touch-icon-114x114.png">
    
	<script type="text/javascript" src="{$g_base_url}/js/jquery.js"></script>
	<script type="text/javascript" src="{$g_base_url}/js/browser.js"></script>
	
    
    {* Must Include This Section *}
    {include file='../../templates/common/head_include.tpl'}
    
            <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>{$g_title}</title>
        </head>

        <body>

		<div id="login-container">
			<div id="login-logo">
				<img src="images/bookthumb.png" alt="Site Logo" id="login-logo-book">
				<span id="logoname">Intens Docs</span>
			</div>

			<form action="index.php" method="post" id="login-form">
				<table id="login-table">
					<tbody>
						{if $redirection}
							<tr>
							<td>
								<input type="hidden" name="redirection" value="{$redirection}">
							</td>
							</tr>
						{/if}
						<tr>
							<td><label for="frmuser">{$g_lang_username}</label></td>
							<td><input type="Text" name="frmuser" size="15"></td>
						</tr>
						<tr>
							<td><label for="frmpass">{$g_lang_password}</label></td>
							<td>
								<input type="password" name="frmpass" size="15">
								{if $g_allow_password_reset eq 'True'}
									<a href="{$g_base_url}/forgot_password.php">{$g_lang_forgotpassword}</a>
								{/if}
							</td>
						</tr>
						<!--<tr>
							<td>
							<input type="submit" name="login" value="{$g_lang_enter}">
							</td>
						</tr>
						{if $g_demo eq 'True'}
							<tr>
								<td>
									Regular User: <br />Username:demo Password:demo<br />
								</td>
							</tr>
							<tr>
								<td>
									Admin User: <br />Username:admin Password:admin<br />
								</td>
							</tr>
						{/if}
						{if $g_allow_signup eq 'True'}
							<tr>
								<td>
									<a href="{$g_base_url}/signup.php">{$g_lang_signup}</a>
								</td>
							</tr>
						{/if}-->
					</tbody>
				</table>
				<input id="submit-button" type="submit" name="login" value="{$g_lang_enter}">
			</form><br><br>
			<div id="ribbon">
				<div id="ribbon-curve">
					<span id="ribbon-content">
						{$g_lang_welcome}<br>
						<!--{$g_lang_welcome2}-->
					</span>
				</div>
			</div>
		</div>