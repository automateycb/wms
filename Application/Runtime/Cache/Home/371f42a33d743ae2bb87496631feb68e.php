<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>AUTO-仓库管理系统</title>
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global.css" />
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global_color.css" /> 
        <script src="/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/layer/layer.js"></script>
        <script src="/Public/js/user.js"></script>
        <script src="/Public/js/love.js"></script>
    </head>
    <body>
        <!--Logo区域开始-->
        <div id="header">
            <img src="/Public/images/logo.png" alt="logo" class="left"/>
            <span style="font-weight:bold;font-size:16px">Hi!</span>  
            <span style="color:red;font-weight:bold;font-size:16px"><?php echo ($infos["nickname"]); ?></span> 
            <a href="<?php echo U('Login/loginout');?>" style="font-size:16px" >[退出]</a>            
        </div>
        <!--Logo区域结束-->
        
        <!--导航区域开始-->
        <div id="navi">                        
            <ul id="menu">
                <li><a href="<?php echo U('Index/index');?>" class="index_off"></a></li>
                <li><a href="<?php echo U('Role/index');?>"  class="role_off"></a></li>
                <li><a href="<?php echo U('Admin/index');?>" class="admin_off"></a></li>
                <li><a href="<?php echo U('Input/index');?>" class="input_off"></a></li>   
                <li><a href="<?php echo U('Output/index');?>" class="output_off"></a></li>       
                <li><a href="<?php echo U('Goods/index');?>" class="warehouse_off"></a></li>
                <li><a href="<?php echo U('Issue/index');?>" class="issue_off"></a></li>
               <!--     <li><a href="<?php echo U('User/info');?>" class="information_off"></a></li>
                <li><a href="<?php echo U('User/pwd');?>" class="password_off"></a></li> -->
            </ul>            
        </div>
        <!--导航区域结束-->
 
            
<?php echo jumps($infos['authority'],CONTROLLER_NAME);?>

        <!--主要区域开始-->
        <div id="main">
            <form action="" method="">
                <!--增加-->
                <div class="search_add">
                    <div>
                        <input type="button" value="系统说明文档下载" class="btn_ex" onclick="location.href='/index.php/Issue/test';" />
                    </div>

                    <div>
                        <input type="button" value="增加ISSUE" class="width200 btn_add" onclick="location.href='/index.php/Issue/add';" />
                    </div>
                </div>
                                
                <!--数据区域：用表格展示数据-->     
                <div id="data">                      
                    <table id="datalist">
                        <tr>                            
                            <th>问题 ID</th>
                            <th>问题名称</th>
                            <th>提问人</th>
                         <!--    <th>类型</th> -->
                            <th>具体内容</th>
                            <th>时间</th>
                            <th class="td_modi"></th>
                        </tr>  
                  
                    <?php if(is_array($res['res'])): $i = 0; $__LIST__ = $res['res'];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["username"]); ?></td>
                           <!--  <td><?php echo ($vo["issuecategory_name"]); ?></td> -->
                            <td><?php echo ($vo["description"]); ?></td>
                            <td><?php echo date('Y-m-d H:i:s',$vo['time']) ;?></td>
                            <td>
                                <input type="button" value="修改" class="btn_modify" onclick="location.href='/index.php/Issue/edit/id/<?php echo ($vo["id"]); ?>';"/>
                                <input type="button" value="删除" class="btn_delete" onclick="deletes('/index.php/Issue/delete/id/<?php echo ($vo["id"]); ?>');" />
                            </td>
                        </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>                           

                    </table>
                </div> 
                <!--分页-->
                <div id="pages">
                    <?php echo ($res['page']); ?>
                </div>
            </form>
        </div>
        <!--主要区域结束-->

<script type="text/javascript">
    //删除
    function deletes(obj){
      
    layer.confirm('你确定真的要删除此分类？', {icon: 3, title:'提示'}, function(index){
    if(index){    
        
        $.get(obj, function(data){
            
            //判断是否删除成功！
            if(data.status==0){
                layer.msg(data.info,{icon: 5});
            }else{
                layer.msg(data.info,{icon: 6});

                //延迟跳转
                setTimeout(function () {
                    location.href = "<?php echo U('Issue/index');?>";
                }, <?php echo C('AJAX_TIME');?>);

            }
            
        });
        
        
    }  
      layer.close(index);
    });    
        
    }    
    
</script>             
<style type="text/css">
    .empty{
        font-weight:bold;
    }
</style>
<script type="text/javascript">
    $(function(){
        //点击之后的图标
        $('.issue_off').addClass('issue_on').removeClass('issue_off');
    });  
</script>        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统V1.2版</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>