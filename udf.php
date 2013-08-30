<?php
/*
udf.php - Administer User Defined Fields
Copyright (C) 2007 Stephen Lawrence Jr., Jonathan Miner
Copyright (C) 2008-2012 Stephen Lawrence Jr.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 3
of the License, or any later version.

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
//Fb::log($_REQUEST);exit;
$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');

$secureurl = new phpsecureurl;
$user_obj = new User($_SESSION['uid'], $GLOBALS['connection'], DB_NAME);
if(!$user_obj->isAdmin())
{
    header('Location:' . $secureurl->encode('error.php?ec=4'));
    exit;
}

if(isset($_REQUEST['cancel']) and $_REQUEST['cancel'] != 'Cancel')
{
    draw_menu($_SESSION['uid']);
}

if(isset($_GET['submit']) && $_GET['submit'] == 'add')
{
    draw_header(msg('area_add_new_udf'), $last_message);
    
    // Check to see if user is admin
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
<form id="udfAddForm" class="admin_form" action="udf.php?last_message=<?php echo $last_message; ?>" method="GET" enctype="multipart/form-data">
<table border="0" cellspacing="5" cellpadding="5">
        <tr>
                <td><b><?php echo msg('label_name')?>(limit 5)</b></td>
                <td colspan="3"><input maxlength="5" name="table_name" type="text" class="required"></td>
        </tr>
        <tr>
                <td><b><?php echo msg('label_display')?> <?php echo msg('label_name')?></b></td>
                <td colspan="3"><input maxlength="16" name="display_name" type="text" class="required"></td>
        </tr>
        <tr>
                <td><b><?php echo msg('type')?></b></td>
                <td colspan="3"><select name="field_type">
                <option value=1><?php echo msg('select') . ' ' . msg('list')?></option>
                <option value=4><?php echo msg('label_sub_select_list'); ?></option>
                <option value=2><?php echo msg('label_radio_button'); ?></option>
                <option value=3><?php echo msg('label_text'); ?></option>               
                </select>
                </td>
        </tr>
    </table>
	<button class="positive" type="Submit" name="submit" value="Add User Defined Field" style="margin-left: 105px;"><?php echo msg('button_save')?></button>
	<button class="negative cancel" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
</form>
    <script>
  $(document).ready(function(){
    $('#udfAddForm').validate();
  });
  </script>
<?php
draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add User Defined Field')
{
    // Make sure they are an admin
    if (!$user_obj->isAdmin())
    {
        header('Location:' . $secureurl->encode('error.php?ec=4'));
        exit;
    }

    udf_functions_add_udf();

    $last_message = urlencode(msg('message_udf_successfully_added') . ': ' . $_REQUEST['display_name']);
    header('Location: ' . $secureurl->encode('admin.php?last_message=' . $last_message));
}
elseif(isset($_REQUEST['submit']) && ($_REQUEST['submit'] == 'delete') && (isset($_REQUEST['item'])))
{
// If demo mode, don't allow them to update the demo account
if (@$GLOBALS['CONFIG']['demo'] == 'True')
{
    
    draw_header(msg('label_delete') . ' ' . msg('label_user_defined_fields') ,$last_message);
    echo msg('message_sorry_demo_mode');
    draw_footer();
    exit;
}
$delete='';

draw_header(msg('label_delete') . ' ' . msg('label_user_defined_fields'), $last_message);
// query to show item
echo '<form action="udf.php" method="POST" enctype="multipart/form-data">';
echo '<table border=0>';
$query = "SELECT table_name, display_name, field_type  FROM {$GLOBALS['CONFIG']['db_prefix']}udf where table_name='{$_REQUEST['item']}'";
$result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
while(list($lid, $lname, $ltype) = mysql_fetch_row($result))
{  
    echo '<tr><th align=right>' . msg('label_name') . ':</th><td>' . $lid . '</td></tr>';
    echo '<tr><th align=right>' . msg('label_display') . ':</th><td>' . $lname . '</td></tr>';
    echo '<input type="hidden" name="type" value="' . $ltype . '">';
}
    ?>
            <input type="hidden" name="id" value="<?php echo $_REQUEST['item']; ?>">
            
                <tr>
                    <td valign="top"><?php echo msg('message_are_you_sure_remove')?></td>
                    <td align="center">
                        <div class="buttons">
                            <button class="positive" type="Submit" name="deleteudf" value="Yes"><?php echo msg('button_yes')?></button>
                            <button class="negative" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
                        </div>
                    </td>
                </tr>
        </table>
    </form>
<?php
        draw_footer();
}
elseif(isset($_REQUEST['deleteudf']))
{
    // Make sure they are an admin
    if (!$user_obj->isAdmin())
    {
        header('Location:' . $secureurl->encode('error.php?ec=4'));
        exit;
    }
    udf_functions_delete_udf();

    // back to main page
    $last_message = urlencode(msg('message_udf_successfully_deleted'). ': id=' . $_REQUEST['id']);
    header('Location: ' . $secureurl->encode('admin.php?last_message=' . $last_message));
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'deletepick')
{
    $deletepick='';
    draw_header(msg('select') . ' ' . msg('label_user_defined_fields'), $last_message);
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
        <form class="admin_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <table border="0" cellspacing="5" cellpadding="5">

        <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
                        <tr>
                                <td><b><?php echo msg('label_user_defined_field')?></b></td>
                                <td colspan=3><select name="item">
<?php
        $query = "SELECT table_name,display_name FROM {$GLOBALS['CONFIG']['db_prefix']}udf ORDER BY id";
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
        </select>
                </td>
                <td align="center">
                <div class="buttons">
                    <button class="positive" type="Submit" name="submit" value="delete"><?php echo msg('button_delete')?></button>
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
<?php
        draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Show User Defined Field')
{
    // query to show item
    
    draw_header(msg('label_display') . ' ' . msg('label_user_defined_field'), $last_message);
    
    // Select name
    $query = "SELECT name FROM {$GLOBALS['CONFIG']['db_prefix']}category where id='{$_REQUEST['item']}'";
    $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
    echo('<table name="main" cellspacing="15" border="0">');
    list($lcategory) = mysql_fetch_row($result);
    echo '<th>' . msg('name') . '</th><th>ID</th>';
    echo '<tr>';
    echo '<td>' . $lcategory . '</td>';
    echo '<td>' . $_REQUEST['item'] . '</td>';
    echo '</tr>';
?>
        <form action="admin.php?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
                <tr>
                        <td colspan="4" align="center"><input type="Submit" name="" value="Back"></td>
                </tr>
        </form>
        </table>
<?php

        draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'showpick')
{      
    draw_header(msg('user_defined_field'), $last_message);
    $showpick='';
    ?>
                        <table border="0" cellspacing="5" cellpadding="5">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
                        <tr>
                        <td><b>User Defined Field</b></td>
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
                <tr>
                <td></td>
                <td colspan="3" align="center">
                <input type="Submit" name="submit" value="Show User Defined Field">
                <input type="Submit" name="cancel" value="Cancel">
                </td>
                </tr>
                </form>
                </table>
<?php
        draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Update')
{
    draw_header('Update User Defined Field', $last_message);
    ?>
                <table border="0" cellspacing="5" cellpadding="5">
                        <tr>
                <form action="commitchange.php?last_message=<?php echo $last_message; ?>" method="POST" enctype="multipart/form-data">
<?php
        $query = "SELECT id, name FROM {$GLOBALS['CONFIG']['db_prefix']}category where id='{$_REQUEST['item']}'";
        $result = mysql_query($query, $GLOBALS['connection']) or die ("Error in query: $query. " . mysql_error());
        while(list($lid, $lname) = mysql_fetch_row($result))
        {
                echo '<tr>';
                echo '<td><input maxlength="16" type="textbox" name="name" value="' . $lname . '"></td>';
                echo '<td><input type="hidden" name="id" value="' . $lid . '"></td>';
                echo '</tr>';
        }
        mysql_free_result ($result);
?>
                <td>
                        <input type="Submit" name="updatecategory" value="Modify User Defined Field">
        </form>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?last_message=<?php echo $last_message; ?>">
                <input type="Submit" name="cancel" value="Cancel">
        </form>
                        </td>
                </tr>
        </table>
<?php
draw_footer();
}
elseif(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'updatepick')
{
    draw_header('User Defined Field Selection', $last_message);
    ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="state" value="<?php echo ($_REQUEST['state']+1); ?>">
                        <table border="0">
                                <tr>
                                <td><b>User Defined Field to modify:</b></td>
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
        </tr>
        <tr>
        <td></td>
        <td colspan="3" align="center">
        <input type="Submit" name="submit" value="Update">
        <input type="Submit" name="cancel" value="Cancel">
        </td>
        </tr>
        </form></TD>
        </tr>
        </table>
<?php
        draw_footer();
}
elseif (isset($_REQUEST['cancel']) && $_REQUEST['cancel'] == 'Cancel')
{
    $last_message=urlencode('Action canceled');
    header ('Location: admin.php?last_message=' . $last_message);
}
elseif (isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'edit')
{
    
    draw_header(msg('edit') . ' ' . msg('label_user_defined_field'), $last_message);
    
    $query = "SELECT table_name,field_type,display_name FROM {$GLOBALS['CONFIG']['db_prefix']}udf WHERE table_name = '{$_REQUEST['udf']}'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    $display_name = $row[2];
    $field_type = $row[1];
    mysql_free_result($result);
    if ( $field_type == 1 || $field_type == 2) {
        // Do Updates
        if (isset($_REQUEST['display_name']) && $_REQUEST['display_name'] != "" ) {
            $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}udf SET display_name='{$_REQUEST['display_name']}' WHERE table_name = '{$_REQUEST['udf']}'";
            mysql_query($query);
            $display_name = $_REQUEST['display_name'];
        }
        // Do Inserts
        if (isset($_REQUEST['newvalue']) && $_REQUEST['newvalue'] != "" ) {
            $query = 'INSERT INTO '.$_REQUEST['udf'].' (value) VALUES ("'.$_REQUEST['newvalue'].'")';
            mysql_query($query);
        }
        // Do Deletes
        $query = 'SELECT max(id) FROM '.$_REQUEST['udf'];
        $result = mysql_query($query);
        $row = mysql_fetch_row($result);
        $max = $row[0];
        mysql_free_result($result);
        while ( $max > 0 ) {
            if ( isset($_REQUEST['x'.$max]) && $_REQUEST['x'.$max] == "on" ) {
                $query = 'DELETE FROM '.$_REQUEST['udf'].' WHERE id = '.$max;
                mysql_query($query);
            }
            $max--;
        }
        echo '<form id="editUdfForm" method="POST">';
        echo '<input type=hidden name=submit value="edit">';
        echo '<input type=hidden name=udf value="'.$_REQUEST['udf'].'">';
        echo '<table>';
        echo '<tr><th align=right>' . msg('label_name') . ':</th><td>' . $_REQUEST['udf'] . '</td></tr>';
        echo '<tr><th align=right>' . msg('label_display') . ' ' . msg('label_name') . ':</th><td><input type=textbox maxlength="16" name=display_name value="'.$display_name.'" class="required"></td></tr>';
        echo '</table>';
        echo '<table>';
        echo '<tr bgcolor="83a9f7"><th>' .msg('button_delete') . '?</th><th>' .msg('value')  . ' </th></tr>';
        $query = 'SELECT id,value FROM '.$_REQUEST['udf'];
        $result = mysql_query($query);
        while ($row = mysql_fetch_row($result)) {
            if ( isset($bg) && $bg == "FCFCFC" )
                $bg = "E3E7F9";
            else
                $bg = "FCFCFC";
            echo '<tr bgcolor="'.$bg.'"><td align=center><input type=checkbox name=x'.$row[0].'></td><td>'.$row[1].'</td></tr>';
        }
        mysql_free_result($result);
        echo '<tr><th align=right>' . msg('new') . ':</th><td><input type=textbox maxlength="16" name="newvalue"></td></tr>';
        echo '<tr><td colspan="2">';
        echo '<div class="buttons"><button class="positive" type="submit" value="Update">' . msg('button_update') . '</button>';
        ?>
                <button class="negative" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
            </div>

        </div>
        </td>
        </tr>
        </table>
                </form>
 <script>
  $(document).ready(function(){
    $('#editUdfForm').validate();
  });
  </script>
<?php
    }
        if($field_type == 3)
        {
          echo msg('message_nothing_to_do');
        }

	if ( $field_type == 4) {
          $type_pr_sec = isset($_REQUEST['type_pr_sec']) ? $_REQUEST['type_pr_sec'] : '';

        if (isset($_REQUEST['display_name']) && $_REQUEST['display_name'] != "") {
            $query = "UPDATE {$GLOBALS['CONFIG']['db_prefix']}udf SET display_name='{$_REQUEST['display_name']}' WHERE table_name = '{$_REQUEST['udf']}'";
            mysql_query($query);
            $display_name = $_REQUEST['display_name'];
        }

        $explode_udf = explode('_', $_REQUEST['udf']);
        $field_name = $explode_udf[2];

        // Do Inserts
        if ($type_pr_sec == 'primary') {
            $tablename = '_primary';
        } else {
            $tablename = '_secondary';
            $sec_values = 'pr_id';
        }
        if (isset($_REQUEST['newvalue']) && $_REQUEST['newvalue'] != "") {
            if ($type_pr_sec == 'primary') {
                $query = 'INSERT INTO ' . $GLOBALS['CONFIG']['db_prefix'] . 'udftbl_' . $field_name . $tablename . ' (value) VALUES ("' . $_REQUEST['newvalue'] . '")';
                //echo $query;
            } else {
                $query = 'INSERT INTO ' . $GLOBALS['CONFIG']['db_prefix'] . 'udftbl_' . $field_name . $tablename . ' (value, pr_id) VALUES ("' . $_REQUEST['newvalue'] . '", "' . $_REQUEST['primary_type'] . '")';
            }
            //echo $query;
            //exit;
            mysql_query($query);
        }
        // Do Deletes
        $query = 'SELECT max(id) FROM ' . $GLOBALS['CONFIG']['db_prefix'] . 'udftbl_' . $field_name . $tablename;
        $result = mysql_query($query);
        $row = mysql_fetch_row($result);
        $max = $row[0];
        mysql_free_result($result);
        while ($max > 0) {
            if (isset($_REQUEST['x' . $max]) && $_REQUEST['x' . $max] == "on") {
                $query = 'DELETE FROM ' . $GLOBALS['CONFIG']['db_prefix'] . 'udftbl_' . $field_name . $tablename . ' WHERE id = ' . $max;
                //echo $query;
                mysql_query($query);
            }
            $max--;
        }

			echo '<form id="editUdfForm" method="POST">';
			echo '<input type=hidden name=submit value="edit">';
			echo '<input type=hidden name=udf value="'.$_REQUEST['udf'].'">';
			echo '<table>';
			echo '<tr><th align=right>' . msg('label_name') . ':</th><td>' . $_REQUEST['udf'] . '</td></tr>';
			echo '<tr><th align=right>' . msg('label_display') . ' ' . msg('label_name') . ':</th><td><input type=textbox maxlength="16" name=display_name value="'.$display_name.'" class="required"></td></tr>';
			echo '<tr><th align=right>' . msg('label_type_pr_sec') .  ':</th><td><select name="type_pr_sec" class="required" onchange="showdivs(this.value,\'' . $_REQUEST['udf'] . '\')"><option value="primary">Primary Items</option><option value="secondary">Secondary Items</option></select></td></tr>'; //CHM
			
			echo '</table>'; ?>
			
			<div id="txtHint">
            
            <?php
			echo '<table>';
			echo '<tr bgcolor="83a9f7"><th>' .msg('button_delete') . '?</th><th>' .msg('value')  . ' </th></tr>';
			$query = 'SELECT * FROM ' . $_REQUEST['udf'];

			$result = mysql_query($query);
			while ($row = mysql_fetch_row($result)) {
				if ( isset($bg) && $bg == "FCFCFC" )
					$bg = "E3E7F9";
				else
					$bg = "FCFCFC";
				echo '<tr bgcolor="'.$bg.'"><td align=center><input type=checkbox name=x'.$row[0].'></td><td>'.$row[1].'</td></tr>';
			}
			mysql_free_result($result);
			echo '<tr><th align=right>' . msg('new') . ':</th><td><input type=textbox maxlength="16" name="newvalue"></td></tr>';
			echo '</div>';
			echo '<tr><td colspan="2">';
			echo '<div class="buttons"><button class="positive" type="submit" value="Update">' . msg('button_update') . '</button>';
			?>
					<button class="negative" type="Submit" name="cancel" value="Cancel"><?php echo msg('button_cancel')?></button>
				</div>
	
			</td>
			</tr>
			</table>
					</form>
	 <script>
	  $(document).ready(function(){
		$('#editUdfForm').validate();
	  });
	  </script>
	<?php
		}
		//CHM
		
    draw_footer();
}
else
{
    draw_header(msg('label_user_defined_field'), $last_message);
    draw_footer();
}