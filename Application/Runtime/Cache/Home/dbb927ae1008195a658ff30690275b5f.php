<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>

    <title></title>
</head>
<body>

<form action="/index.php/File/upload" method="POST" enctype="multipart/form-data">
    <table width="500px" align="center" cellspacing="10">
        <th>文件名</th><th>文件描述</th><th>文件下载</th>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td align="center"width="30%"><?php echo ($vo["filename"]); ?></td><td align="center" width="50%"><?php echo ($vo["depict"]); ?></td><td align="center"  width="20%"><a href="<?php echo U('download',array('id'=>$vo['id'],''));?>">下载</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr> <td colspan="2"><?php echo ($show); ?></td></tr>
</table>
</form>
</body>
</html>