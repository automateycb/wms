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

            <form action="/index.php/Input/add/upload" enctype="multipart/form-data"  method="post" class="main_form">

<!--                 <div class="text_info clearfix"><span>图片上传:</span></div>
                <div class="input_info">
                <input type="file" name="photo" />
                <input type="submit" value="提交" >
                </div> -->
               
                
                <div class="text_info clearfix"><span>物品名称：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='name'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div>

                <div class="text_info clearfix"><span>资产编号：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='asset_number'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字的组合</div>
                </div>

                <div class="text_info clearfix"><span>仓库位置：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='position'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div>

                <div class="text_info clearfix"><span>入库数量：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='sum'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div>

                <div class="text_info clearfix"><span>单价：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='price'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div>
                                                      
                <div class="text_info clearfix"><span>物品品牌：</span></div>
                <div class="input_info">
                        <select name="brand_id">
                            <!--分类-->
                            <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            
                        </select>  
                        <input type="button" value="增加" class="btn_add" onclick="location.href='<?php echo U('Brand/add');?>';" />
                </div>                
                                 
                                    
                <div class="text_info clearfix"><span>物品类型：</span></div>
                <div class="input_info" id="as">
  
                     <select name="category_id" id="category_id" onchange="get_attr(this)" > 
                    <!--遍历类型-->                            
                    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
                    </select>  
                    <span class="required">
                    <input type="button" value="增加" class="btn_add" onclick="location.href='<?php echo U('Category/add');?>';" />
                    </span>
                    <div class="validate_msg_tiny">至少选择一个类型</div>
                </div>

                         


<div class="button_info clearfix">
    <?php echo W('Menu/goods');?> 
</div>


                <div class="button_info clearfix">
                    <input type="button" value="保存" class="btn_save" onclick="send()" />
                    <input type="button" value="取消" class="btn_save" />
                </div>
            </form>
        </div>
        <!--主要区域结束-->
     
        
        
<style type="text/css">
    .l-text{
        width: 100px;
    }
    .li_width label input{
        position: relative;
        top:10px;
    }
</style>
<script type="text/javascript">
    $(function(){
        //点击之后的图标
        $('.input_off').addClass('input_on').removeClass('input_off');

    });  
    
</script>

<script type="text/javascript">
    function send(){

                $.ajax({
                    url: '/index.php/Input/add',
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
                                location.href = "<?php echo U('Input/index');?>";
                            }, <?php echo C('AJAX_TIME');?>);


                        }

                    }
                });
            
    }
</script>

// <script type="text/javascript">

// </script>
        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统V1.2版</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>