<?php if (!defined('THINK_PATH')) exit();?>
        <!--导航区域开始-->
        <div id="index_navi">
            <ul id="menu">
                <li><a href="<?php echo U('Index/index');?>" class="index_on"></a></li>
                <li><a href="<?php echo U('Role/index');?>" class="role_off"></a></li>
                <li><a href="<?php echo U('Admin/index');?>" class="admin_off"></a></li>
                <li><a href="<?php echo U('Input/index');?>" class="input_off"></a></li>             
                <li><a href="<?php echo U('Output/index');?>" class="output_off"></a></li>
                <li><a href="<?php echo U('Goods/index');?>" class="warehouse_off"></a></li>
                <li><a href="<?php echo U('Issue/index');?>" class="issue_off"></a></li>
            </ul>
        </div>