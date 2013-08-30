<?php /* Smarty version 2.6.26, created on 2013-08-30 12:42:02
         compiled from C:%5Cxampp%5Chtdocs%5Copendocman//templates/common/access_log.tpl */ ?>
<div id="filetable_wrapper" style="margin-left: 260px">
<form name="table" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">
    <table id="filetable" class="display" border="0" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <?php if ($this->_tpl_vars['showCheckBox']): ?>
                <th class="sorting_desc_disabled sorting_asc_disabled"><input type="checkbox" id="checkall"/></th>
            <?php endif; ?>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_file_name']; ?>
</th>
            <th><?php echo $this->_tpl_vars['g_lang_label_fileid']; ?>
</th>
            <th><?php echo $this->_tpl_vars['g_lang_label_username']; ?>
</th>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_action']; ?>
</th>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_date']; ?>
</th>
        </tr>
    </thead>
    <tbody>
        <?php $_from = $this->_tpl_vars['accesslog_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['accesslog_array'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['accesslog_array']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['accesslog_array']['iteration']++;
?>
        <tr <?php if ($this->_tpl_vars['item']['lock'] == true): ?>class="gradeX"<?php endif; ?> >
            <td class="center"><a href="<?php echo $this->_tpl_vars['item']['details_link']; ?>
"><?php echo $this->_tpl_vars['item']['realname']; ?>
</a></td>
            <td class="center" style="width: 50px;"><?php echo $this->_tpl_vars['item']['file_id']; ?>
</td>
            <td class="center"><?php echo $this->_tpl_vars['item']['user_name']; ?>
</td>
            <td class="center"><?php echo $this->_tpl_vars['item']['action']; ?>
</td>
            <td class="center"><?php echo $this->_tpl_vars['item']['timestamp']; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </tbody>
    <tfoot>
       <tr>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_file_name']; ?>
</th>
            <th><?php echo $this->_tpl_vars['g_lang_label_fileid']; ?>
</th>
            <th><?php echo $this->_tpl_vars['g_lang_label_username']; ?>
</th>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_action']; ?>
</th>
            <th class="sorting"><?php echo $this->_tpl_vars['g_lang_label_date']; ?>
</th>
        </tr>
    </tfoot>
    <?php if ($this->_tpl_vars['form'] != '1'): ?>
</form>
    <?php endif; ?>
</table>
</div>
<br />