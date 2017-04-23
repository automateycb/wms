<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>AUTO-仓储管理系统</title>
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global.css" />
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global_color.css" /> 
        <script src="/Public/js/jquery-1.9.1.min.js"></script>
        <script src="/Public/layer/layer.js"></script>
        <script src="/Public/js/user.js"></script>
    </head>
    <body>
        <!--Logo区域开始-->
        <div id="header">
            <img src="/Public/images/logo.png" alt="logo" class="left"/>
            <span style="font-weight:bold;">Hi!</span>  
            <span style="color:red;font-weight:bold;"><?php echo ($infos["nickname"]); ?></span> 
            <a href="<?php echo U('Login/loginout');?>" >[退出]</a>            
        </div>
        <!--Logo区域结束-->
        
        <!--导航区域开始-->
        <div id="navi">                        
            <ul id="menu">
                <li><a href="<?php echo U('Index/index');?>" class="index_off"></a></li>
                <li><a href="<?php echo U('Role/index');?>" class="role_off"></a></li>
                <li><a href="<?php echo U('Admin/index');?>" class="admin_off"></a></li>
                <li><a href="<?php echo U('Store/index');?>" class="store_off"></a></li>
                <li><a href="<?php echo U('Account/index');?>" class="emp_off"></a></li>
                <li><a href="<?php echo U('Buy/index');?>" class="buy_off"></a></li>               
                <li><a href="<?php echo U('Sell/index');?>" class="sell_off"></a></li>
                <li><a href="<?php echo U('Goods/index');?>" class="warehouse_off"></a></li>
                <li><a href="<?php echo U('User/info');?>" class="information_off"></a></li>
                <li><a href="<?php echo U('User/pwd');?>" class="password_off"></a></li>
            </ul>            
        </div>
        <!--导航区域结束-->
 
             
<?php echo jumps($infos['authority'],CONTROLLER_NAME);?>
        
        <!--主要区域开始-->
        <div id="main">            

            <form action="/index.php/Store/edit/id/1" method="post" class="main_form">
                
                <input type="hidden" name="id" value='<?php echo ($info["id"]); ?>' />
                
                <div class="text_info clearfix"><span>门店名称：</span></div>
                <div class="input_info">
                    <input type="text" class="width300" value="<?php echo ($info["name"]); ?>" name='name'/>
                    <span class="required">*</span>
                    <div class="validate_msg_short">20长度的字母、数字、汉字和下划线的组合</div>
                </div>
                
                <div class="text_info clearfix"><span>管理者：</span></div>
                <div class="input_info">
                    <input type="text" value="<?php echo ($info["leader"]); ?>" class="width110" name='leader'/>
                    <span class="info"></span>
                    <span class="required">*</span>
                    <div class="validate_msg_long">10长度的字母、数字、汉字</div>
                </div>
                                
                <div class="text_info clearfix"><span>电话：</span></div>
                <div class="input_info">
                    <input type="text" value="<?php echo ($info["tel"]); ?>" class="width150" name='tel'/>
                    <span class="required">*</span>
                    <div class="validate_msg_long ">数字组合</div>
                </div>
              
                <div class="text_info clearfix"><span>创建时间：</span></div>
                <div class="input_info">
                    <input type="date" value="<?php echo ($info["create_time"]); ?>" class="width150" name='create_time'/>
                    <span class="required">*</span>
                    <div class="validate_msg_long ">数字组合</div>
                </div>    
                
                <div class="text_info clearfix"><span>地址：</span></div>
                <div class="input_info">
                    <input type="text" value="<?php echo ($info["address"]); ?>" class="width300" name='address'/>
                    <div class="validate_msg_short ">数字、字母、汉字组合</div>
                </div>
                
                <div class="text_info clearfix"><span>描述：</span></div>
                <div class="input_info_high">
                    <textarea class="width300 height70" name='desc'><?php echo ($info["desc"]); ?></textarea>
                    <div class="validate_msg_short ">100长度的字母、数字、汉字和下划线的组合</div>
                </div>  
                
                <div class="button_info clearfix">
                    <input type="button" value="保存" class="btn_save"  onclick="send()" />
                    <input type="reset" value="取消" class="btn_save" />
                </div>
                
            </form>  
        </div>
        <!--主要区域结束-->

<script type="text/javascript">
    $(function(){
        //点击之后的图标
        $('.store_off').addClass('store_on').removeClass('store_off');
    });  
</script>
<script type="text/javascript">
//ajax提交
function send(obj){

            $.ajax({
                url: '/index.php/Store/edit/id/1',
                type: 'post',
                dataType:'json',
                data: $(".main_form").serializeArray(),
                success: function(data) {
//                    console.log(data);
                    //判断是否添加成功！
                    if(data.status==0){
                        layer.msg(data.info,{icon: 5});
                    }else{
                        layer.msg(data.info,{icon: 6});
                        
                        //延迟跳转
                        setTimeout(function () {
                            location.href = "<?php echo U('Store/index');?>";
                        }, <?php echo C('AJAX_TIME');?>);
                        
                        
                    }
                    
                }
            });


}
    
</script>        


        <div id="footer">
            <p>[CSOT AUTO 自主使用仓库管理系统]</p>
            <p>版权所有(c)ycb设计  qq:1150756674 </p>
        </div>
    </body>
</html>