<?php
/*
category.php - Administer Categories
Copyright (C) 2002-2011 Stephen Lawrence Jr.

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

// check for valid session 
session_start();
if (!isset($_SESSION['uid']))
{
    header('Location:index.php?redirection=' . urlencode($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']));
    exit;
}
// includes
include('odm-load.php');
$secureurl = new phpsecureurl;
$user_obj = new User($_SESSION['uid'], $GLOBALS['connection'], DB_NAME);
// Check to see if user is admin
if(!$user_obj->isAdmin())
{
    header('Location:' . $secureurl->encode('error.php?ec=4'));
    exit;
}

$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');

if(isset($_GET['submit']) && $_GET['submit'] == 'add')
{
    draw_header(msg('area_add_new_category'), $last_message);
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
    <form name="add_category" id="categoryAddForm" action="category.php?last_message=<?php echo $last_message; ?>" method="GET" enctype="multipart/form-data" class="admin_form">
        <table border="0" cellspacing="5" cellpadding="5">
            <tr>
                <td><b><?php echo msg('category')?></b></td>
                <td colspan="3"><input name="category" type="text" class="required" maxlength="40"></td>
            <td>
                <div class="buttons">
                    <button class="positive" type="Submit" name="submit" value="Add Category"><?php echo msg('button_add_category')?></button>
                </div>
            </td>
            <td>
                <div class="buttons">
                    <button class="negative cancel" type="submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                </div>
             </td>
            </tr>
        </table>
    </form>
     <script>
  $(document).ready(function(){
    $('#categoryAddForm').validate();
  });
  </script>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add Category')
{
    // Make sure they are an admin
    if (!$user_obj->isAdmin())
    {
        header('Location:' . $secureurl->encode('error.php?ec=4'));
        exit;
    }
    $query = "INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}category (name) VALUES ('". addslashes($_REQUEST['category']) ."')";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    // back to main page
    $last_message = urlencode(msg('message_category_successfully_added'));
    header('Location: ' . $secureurl->encode('admin.php?last_message=' . $last_message));
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'delete')
{
    // If demo mode, don't allow them to update the demo account
    if ($GLOBALS['CONFIG']['demo'] == 'True')
    {
        draw_header(msg('area_delete_category'), $last_message);
        echo msg('message_sorry_demo_mode');
        draw_footer();
        exit;
    }

    draw_header(msg('area_delete_category'), $last_message);
    // query to show item
    echo '<table border=0>';
    $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category where id={$_REQUEST['item']}";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    while(list($lid, $lname) = mysql_fetch_row($result))
    {
        echo '<tr><td>' .msg('label_id'). ' # :</td><td>' . $lid . '</td></tr>';
        echo '<tr><td>'.msg('label_name').' :</td><td>' . $lname . '</td></tr>';
    }
    ?>
    <form action="category.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_REQUEST['item']; ?>">
        <tr>
            <td>
                <?php echo msg('label_reassign_to');?>:
            </td>
            <td>
                  <select name="assigned_id">
                            <?php
                            $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category WHERE id != '{$_REQUEST['item']}' ORDER BY name";
                            $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
                            while(list($lid, $lname) = mysql_fetch_row($result))
                            {
                                echo '<option value="' . $lid . '">' . $lname . '</option>';
                            }
                            mysql_free_result ($result);
                            ?>
                    </select>
            </td>
        </tr>
        <tr>
            <td valign="top"><?php echo msg('message_are_you_sure_remove')?></td>
            <td align="center">
                <div class="buttons">
                    <button class="positive" type="submit" name="deletecategory" value="Yes"><?php echo msg('button_yes')?></button>
                </div>
                <div class="buttons">
                    <button class="negative cancel" type="submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                </div>
            </td>
    </form>
</tr>
</TABLE>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['deletecategory']))
{
    // Delete category
    // 
    // 
    // Make sure they are an admin
    if (!$user_obj->isAdmin())
    {
        header('Location:' . $secureurl->encode('error.php?ec=4'));
        exit;
    }
    $query = "DELETE FROM {$GLOBALS['CONFIG']['db_prefix']}category where id='$_REQUEST[id]'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());

    // Set all old category_id's to the new re-assigned category
    $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}data SET category='{$_REQUEST['assigned_id']}' WHERE category = '{$_REQUEST['id']}'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error when updating old category ID to re-assigned category: $query. " . mysql_error());
    
    // back to main page
    $last_message = urlencode(msg('message_category_successfully_deleted') . ' id:' . $_REQUEST['id']);
    header('Location: ' . $secureurl->encode('admin.php?last_message=' . $last_message));
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'deletepick')
{
    $deletepick='';
    draw_header(msg('area_delete_category'). ' : ' .msg('choose'), $last_message);
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
    <table border="0" cellspacing="5" cellpadding="5" class="admin_form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
            <tr>
                <td><b><?php echo msg('category')?></b></td>
                <td colspan=3><select name="item">
                            <?php
                            $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category ORDER BY name";
                            $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
                            while(list($lid, $lname) = mysql_fetch_row($result))
                            {
                                $str = '<option value="' . $lid . '"';
                                $str .= '>' . $lname . '</option>';
                                echo $str;
                            }
                            mysql_free_result ($result);
                            $deletepick='';
                            ?>
                    </select></td>

                <td></td>
                <td colspan="2" align="center">
                    <div class="buttons">
                        <button class="positive" type="submit" name="submit" value="delete"><?php echo msg('button_delete')?></button>
                        <button class="negative cancel" type="submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                    </div>
                </td>
            </tr>
        </form>
    </table>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Show Category')
{
    // query to show item
    draw_header(msg('area_view_category'), $last_message);
    $category_id = (int) $_REQUEST['item'];
        
    // Select name
    $query = "SELECT name FROM {$GLOBALS['CONFIG']['db_prefix']}category where id='$category_id'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    echo('<table name="main" cellspacing="15" border="0">');
    list($lcategory) = mysql_fetch_row($result);
    echo '<th>' .msg('label_name'). '</th><th>' .msg('label_id'). '</th>';
    echo '<tr>';
    echo '<td>' . $lcategory . '</td>';
    echo '<td>' . $category_id . '</td>';
    echo '</tr>';
    ?>
<form action="admin.php?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
    <tr>
        <td colspan="4" align="center"><div class="buttons"><button class="regular" type="submit" name="submit" value="Back"><?php echo msg('button_back')?></button></div></td>
    </tr>
</form>
</table>
<!-- ADD THE LIST OF FILES HERE -->
<?php
    echo msg('categoryviewpage_list_of_files_title') . '<br />';
    $query = "SELECT id, realname FROM `{$GLOBALS['CONFIG']['db_prefix']}data` WHERE category = '$category_id'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    while(list($file_id, $file_name) = mysql_fetch_row($result)) {
        ?>
            <a href="edit.php?id=<?php echo $file_id; ?>&state=3">ID: <?php echo $file_id . ','; echo $file_name; ?></a><br />
     <?php  
    }
    
    draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'showpick')
{
    draw_header(msg('area_view_category') . ' : ' . msg('choose'), $last_message);
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
    <table border="0" cellspacing="5" cellpadding="5" class="admin_form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
            <tr>
                <td><b><?php echo msg('category')?></b></td>
                <td colspan="3"><select name="item">
                            <?php
                            $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category ORDER BY name";
                            $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
                            while(list($lid, $lname) = mysql_fetch_row($result))
                            {
                                echo '<option value="' . $lid . '">' . $lname . '</option>';
                            }
                            mysql_free_result ($result);
                            ?>
                    </select></td>

                <td></td>
                <td colspan="3" align="center">
                    <div class="buttons">
                        <button class="positive" type="Submit" name="submit" value="Show Category"><?php echo msg('area_view_category')?></button>
                        <button class="negative cancel" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                    </div>
                </td>
            </tr>
        </form>
    </table>
</body>
</html>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Update')
{
    draw_header(msg('area_update_category'), $last_message);
    ?>
<form id="updateCategoryForm" action="category.php?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
    <table border="0" cellspacing="5" cellpadding="5">
        <tr>
                       <?php
                // query to get a list of users
                $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category where id='{$_REQUEST['item']}'";
                $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
                while(list($lid, $lname) = mysql_fetch_row($result))
                {
                    echo '<tr>';
                    echo '<td colspan="2">' . msg('category') .': <input type="textbox" name="name" value="' . $lname . '" class="required" maxlength="40"></td>';
                    echo '<input type="hidden" name="id" value="' . $lid . '">';

                }
                mysql_free_result ($result);
                ?>


            <td align="center">

                <div class="buttons">
                    <button class="positive" type="Submit" name="updatecategory" value="Modify Category"><?php echo msg('area_update_category')?></button>
                </div>
            </td>
            <td align="center">
                <div class="buttons">
                    <button class="negative cancel" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                </div>
            </td>
        </tr>
    </table>
 </form>
 <script>
  $(document).ready(function(){
    $('#updateCategoryForm').validate();
  });
  </script>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'updatepick')
{
    draw_header(msg('area_update_category'). ': ' .msg('choose'), $last_message);
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="admin_form">
        <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
        <table border="0">
            <tr>
                <td><b><?php echo msg('choose')?> <?php echo msg('category')?>:</b></td>
                <td colspan="3"><select name="item">
                            <?php
                            // query to get a list of users
                            $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category ORDER BY name";
                            $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
                            while(list($lid, $lname) = mysql_fetch_row($result))
                            {
                                echo '<option value="' . $lid . '">' . $lname . '</option>';
                            }
                            mysql_free_result ($result);
                            ?>
                </td>

                <td align="center">
                    <div class="buttons">
                        <button class="positive" type="submit" name="submit" value="Update"><?php echo msg('choose')?></button>
                    </div>
                </td>
                <td align="center">
                    <div class="buttons">
                        <button class="negative cancel" type="submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                    </div>
                </td>
            </tr>
    </form></TD>
</tr>
</table>
    <?php
    draw_footer();
}
elseif(isset($_REQUEST['updatecategory']))
{
    // Make sure they are an admin
    if (!$user_obj->isAdmin())
    {
        header('Location:' . $secureurl->encode('error.php?ec=4'));
        exit;
    }
    $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}category SET name='". addslashes($_REQUEST['name']) ."' where id='$_REQUEST[id]'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    // back to main page
    $last_message = urlencode(msg('message_category_successfully_updated') .' : ' . $_REQUEST['name']);
    header('Location: ' . $secureurl->encode('admin.php?last_message=' . $last_message));
}
elseif (isset($_REQUEST['cancel']) && $_REQUEST['cancel'] == 'Cancel')
{
    $last_message=urlencode(msg('message_action_cancelled'));
    header ('Location: admin.php?last_message=' . $last_message);
}