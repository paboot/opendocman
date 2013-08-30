<?php
/*
Copyright (C) 2012  Stephen Lawrence Jr.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

// check for session and $_REQUEST['id']
session_start();
if (!isset($_SESSION['uid']))
{
    header('Location:index.php?redirection=' . urlencode( $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ) );
    exit;
}

include('odm-load.php');
include('udf_functions.php');
$secureurl = new phpsecureurl;

// open a connection to the database
$user_obj = new User($_SESSION['uid'], $GLOBALS['connection'], DB_NAME);
// Check to see if user is admin
if(!$user_obj->isAdmin())
{
    header('Location:error.php?ec=4');
    exit;
}

$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');

draw_header(msg('accesslogpage_access_log'), $last_message);
?>
<!-- Left Menu -->
				<section id="left_menu" <?php if (isset($_GET['last_message'])) echo 'style="height:calc(100% - 159px) !important"'; ?>>
					<ul id="Level-1" class="Level1">
						<!-- User Admin -->
						<li id="1"><?php echo msg('users')?></li>
						<ul id="Level-2-1" class="Level2" style="display:none">
							<li id="1-1"><a href="<?php echo $secureurl->encode('user.php?submit=adduser&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_add')?></a></li>
							<li id="1-2"><a href="<?php echo $secureurl->encode('user.php?submit=deletepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_delete')?></a></li>
							<li id="1-3"><a href="<?php echo $secureurl->encode('user.php?submit=updatepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_update')?></a></li>
							<li id="1-4"><a href="<?php echo $secureurl->encode('user.php?submit=showpick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_display')?></a></li>
						</ul>
						<!-- Department Admin -->
						<li id="2"><?php echo msg('label_department')?></li>
						<ul id="Level-2-2" class="Level2" style="display:none">
							<li id="2-1"><a href="<?php echo $secureurl->encode('department.php?submit=add&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_add')?></a></li>
							<li id="2-2"><a href="<?php echo $secureurl->encode('department.php?submit=deletepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_delete')?></a></li>
							<li id="2-3"><a href="<?php echo $secureurl->encode('department.php?submit=updatepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_update')?></a></li>
							<li id="2-4"><a href="<?php echo $secureurl->encode('department.php?submit=showpick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_display')?></a></li>
						</ul>
						<!-- Category Admin -->
						<li id="3"><?php echo msg('category')?></li>
						<ul id="Level-2-3" class="Level2" style="display:none">
							<li id="3-1"><a href="<?php echo $secureurl->encode('category.php?submit=add&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_add')?></a></li>
							<li id="3-2"><a href="<?php echo $secureurl->encode('category.php?submit=deletepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_delete')?></a></li>
							<li id="3-3"><a href="<?php echo $secureurl->encode('category.php?submit=updatepick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_update')?></a></li>
							<li id="3-4"><a href="<?php echo $secureurl->encode('category.php?submit=showpick&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_display')?></a></li>
						</ul>
						<!-- Root-only Section -->
						<?php if($user_obj->isRoot()) { ?>
						<!-- File Admin -->
						<li id="4"><?php echo msg('file')?></li>
						<ul id="Level-2-4" class="Level2" style="display:none">
							<li id="4-1"><a href="<?php echo $secureurl->encode('delete.php?mode=view_del_archive&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_delete_undelete')?></a></li>
							<li id="4-2"><a href="<?php echo $secureurl->encode('toBePublished.php?mode=root&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_reviews')?></a></li>
							<li id="4-3"><a href="<?php echo $secureurl->encode('rejects.php?mode=root&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_rejections')?></a></li>
							<li id="4-4"><a href="<?php echo $secureurl->encode('check_exp.php?&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('label_check_expiration')?></a></li>
							<li id="4-5"><a href="<?php echo $secureurl->encode('file_ops.php?&state=' . ($_REQUEST['state'])); ?>&submit=view_checkedout"><?php echo msg('label_checked_out_files')?></a></li>
						</ul>
						<?php
							udf_admin_header();
							udf_admin_menu($secureurl);
						?>
						<li id="6"><?php echo msg('label_settings')?></li>
						<ul id="Level-2-6" class="Level2" style="display:none">
							<li id="2-1"><a href="<?php echo $secureurl->encode('settings.php?submit=update&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('adminpage_edit_settings'); ?></a></li>
							<li id="2-2"><a href="<?php echo $secureurl->encode('filetypes.php?submit=update&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('adminpage_edit_filetypes'); ?></a></li>
						</ul>
						<li id="7"><?php echo msg('adminpage_reports')?></li>
						<ul id="Level-2-7" class="Level2" style="display:none">
							<li id="2-1"><a href="<?php echo $secureurl->encode('access_log.php?submit=update&state=' . ($_REQUEST['state'])); ?>"><?php echo msg('adminpage_access_log');?></a></li>
							<li id="2-2"><a href="reports/file_list.php"><?php echo msg('adminpage_reports_file_list');?></a></li>
						</ul>
						<?php
						if(is_array($GLOBALS['plugin']->getPluginsList()) && $user_obj->isRoot()) {
						?>
						<li id="8" style="border-bottom:none"><?php echo msg('label_plugins')?></li>
						<?php callPluginMethod('onAdminMenu'); } ?>
						<?php } ?>
					</ul>
				</section>
<?php
$query = "SELECT 
            {$GLOBALS['CONFIG']['db_prefix']}access_log.*, 
            {$GLOBALS['CONFIG']['db_prefix']}data.realname, 
            {$GLOBALS['CONFIG']['db_prefix']}user.username
          FROM 
            {$GLOBALS['CONFIG']['db_prefix']}access_log 
          INNER JOIN 
            {$GLOBALS['CONFIG']['db_prefix']}data ON {$GLOBALS['CONFIG']['db_prefix']}access_log.file_id={$GLOBALS['CONFIG']['db_prefix']}data.id
          INNER JOIN 
            {$GLOBALS['CONFIG']['db_prefix']}user ON {$GLOBALS['CONFIG']['db_prefix']}access_log.user_id = {$GLOBALS['CONFIG']['db_prefix']}user.id
        ";
$result = mysql_query($query, $GLOBALS['connection']) or die("Error in query: $query. " . mysql_error());

$actions_array = array(
    "A" => msg('accesslogpage_file_added'),
    "B" => msg('accesslogpage_reserved'),
    "C" => msg('accesslogpage_reserved'),
    "V" => msg('accesslogpage_file_viewed'), 
    "D" => msg('accesslogpage_file_downloaded'), 
    "M" => msg('accesslogpage_file_modified'), 
    "I" => msg('accesslogpage_file_checked_in'), 
    "O" => msg('accesslogpage_file_checked_out'), 
    "X" => msg('accesslogpage_file_deleted'), 
    "Y" => msg('accesslogpage_file_authorized'), 
    "R" => msg('accesslogpage_file_rejected')
    );
$accesslog_array = array();

while ($row = mysql_fetch_array($result))
{
    $details_link = $secureurl->encode('details.php?id=' . $row['file_id'] . '&state=' . ($_REQUEST['state'] + 1));

    $accesslog_array[] = array(
        'user_id' => $row['user_id'],
        'file_id' => $row['file_id'],
        'user_name' => $row['username'],
        'realname' => $row['realname'],
        'action' => $actions_array[$row['action']],
        'details_link' => $details_link,
        'timestamp' => $row['timestamp']
    );
}

$GLOBALS['smarty']->assign('accesslog_array', $accesslog_array);
display_smarty_template('access_log.tpl');

draw_footer();
