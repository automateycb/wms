<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

导入导出通讯录
通讯录操作

    <P><a href="<?php echo U('Excel/expUser');?>" >导出数据并生成excel</a></P><br/>
        <form action="<?php echo U('Excel/impUser');?>" method="post" enctype="multipart/form-data">
            <input type="file" name="import"/>
			<input type="hidden" name="table" value="tablename"/>
            <input type="submit" value="导入"/>
        </form>


</body>
</html>