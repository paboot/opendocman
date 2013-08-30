<?php /* Smarty version 2.6.26, created on 2013-08-30 12:38:14
         compiled from C:%5Cxampp%5Chtdocs%5Copendocman//templates/common/settings.tpl */ ?>
        <form action="settings.php" method="POST" enctype="multipart/form-data" id="settingsForm">    
        <table class="form-table">        
            <tr>
                <th><?php echo $this->_tpl_vars['g_lang_label_name']; ?>
</th><th><?php echo $this->_tpl_vars['g_lang_value']; ?>
</th><th><?php echo $this->_tpl_vars['g_lang_label_description']; ?>
</th><?php echo $this->_tpl_vars['g_lang_label_settings']; ?>
</th>
            </tr>
            <?php $_from = $this->_tpl_vars['settings_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
            <tr>
                <td><?php echo $this->_tpl_vars['i']['name']; ?>
</td>
                <td>
                <?php if ($this->_tpl_vars['i']['validation'] == 'bool'): ?>
                    <select name="<?php echo $this->_tpl_vars['i']['name']; ?>
">
                        <option value="True" <?php if ($this->_tpl_vars['i']['value'] == 'True'): ?> selected="selected"<?php endif; ?>>True</option>
                        <option value="False" <?php if ($this->_tpl_vars['i']['value'] == 'False'): ?> selected="selected"<?php endif; ?>>False</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'theme'): ?>
                    <select name="theme">
                        <?php $_from = $this->_tpl_vars['themes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['theme']):
?>
                            <option value="<?php echo $this->_tpl_vars['theme']; ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['theme']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['theme']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'language'): ?>
                    <select name="language">
                        <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
                            <option value="<?php echo $this->_tpl_vars['language']; ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['language']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['language']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                 <?php elseif ($this->_tpl_vars['i']['name'] == 'file_expired_action'): ?>
                    <select name="file_expired_action">
                        <option value="1" <?php if ($this->_tpl_vars['i']['value'] == '1'): ?>selected="selected"<?php endif; ?>>Remove from file list until renewed</option>
                        <option value="2" <?php if ($this->_tpl_vars['i']['value'] == '2'): ?>selected="selected"<?php endif; ?>>Show in file list but non-checkoutable</option>
                        <option value="3" <?php if ($this->_tpl_vars['i']['value'] == '3'): ?>selected="selected"<?php endif; ?>>Send email to reviewer only</option>
                        <option value="4" <?php if ($this->_tpl_vars['i']['value'] == '4'): ?>selected="selected"<?php endif; ?>>Do Nothing</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'authen'): ?>
                    <select name="authen">
                        <option value="mysql" <?php if ($this->_tpl_vars['i']['value'] == 'mysql'): ?>selected="selected"<?php endif; ?>>MySQL</option>
                    </select>
                <?php elseif ($this->_tpl_vars['i']['name'] == 'root_id'): ?>
                    <select name="root_id">
                        <?php $_from = $this->_tpl_vars['useridnums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['useridnum']):
?>
                            <option value="<?php echo $this->_tpl_vars['useridnum'][0]; ?>
" <?php if ($this->_tpl_vars['i']['value'] == $this->_tpl_vars['useridnum'][0]): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['useridnum'][1]; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php else: ?>
                    <input size="40" name="<?php echo $this->_tpl_vars['i']['name']; ?>
" type="text" value="<?php echo $this->_tpl_vars['i']['value']; ?>
">
                <?php endif; ?>
                </td>
                <td><em><?php echo $this->_tpl_vars['i']['description']; ?>
</em></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
         </tr>
    </table>
		<div class="settings_button">
			<button class="positive" type="submit" name="submit" value="Save"><?php echo $this->_tpl_vars['g_lang_button_save']; ?>
</buttons>
			<button class="negative" type="submit" name="submit" value="Cancel"><?php echo $this->_tpl_vars['g_lang_button_cancel']; ?>
</button>
		</div>
        </form>