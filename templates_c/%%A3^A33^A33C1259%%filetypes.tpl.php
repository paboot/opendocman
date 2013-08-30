<?php /* Smarty version 2.6.26, created on 2013-08-30 12:38:24
         compiled from C:%5Cxampp%5Chtdocs%5Copendocman//templates/common/filetypes.tpl */ ?>
<form action="filetypes.php" method="POST" enctype="multipart/form-data">    
<table class="form-table" style="width: 200px;">
        <thead>
            <tr>
                <th colspan="3"><?php echo $this->_tpl_vars['g_lang_label_allowed']; ?>
&nbsp;<?php echo $this->_tpl_vars['g_lang_label_filetypes']; ?>
</th>
            </tr>

            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="multiView" multiple="multiple" id="types" name="types[]">
                            <?php $_from = $this->_tpl_vars['filetypes_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
                                <option value="<?php echo $this->_tpl_vars['i']['id']; ?>
" <?php if ($this->_tpl_vars['i']['active'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['i']['type']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                
                    <td>
                        <div class="buttons"><button class="positive" type="submit" name="submit" value="Save"><?php echo $this->_tpl_vars['g_lang_button_save']; ?>
</button>
                    </td>
                    <td >
                        <div class="buttons">
                            <button class="negative" type="Submit" name="submit" value="Cancel"><?php echo $this->_tpl_vars['g_lang_button_cancel']; ?>
</button>
                        </div>
                     </td>
        </tr>
        <tr>
            <td>
                <a href="filetypes.php?submit=AddNew"><?php echo $this->_tpl_vars['g_lang_label_add']; ?>
&nbsp;<?php echo $this->_tpl_vars['g_lang_label_filetype']; ?>
</a>&nbsp;|&nbsp;<a href="filetypes.php?submit=DeleteSelect"><?php echo $this->_tpl_vars['g_lang_label_delete']; ?>
&nbsp;<?php echo $this->_tpl_vars['g_lang_label_filetype']; ?>
</a>
            </td>
        </tr>
        <tbody>
    </table>
</form>