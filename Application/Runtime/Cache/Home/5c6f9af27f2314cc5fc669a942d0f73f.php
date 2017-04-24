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
        <script src="/Public/js/love.js"></script>
    </head>
    <body>
        <!--Logo区域开始-->
        <div id="header">
            <img src="/Public/images/logo.png" alt="logo" class="left"/>
            <span style="font-weight:bold;font-size:15px">Hi!</span>  
            <span style="color:red;font-weight:bold;font-size:15px"><?php echo ($infos["nickname"]); ?></span> 
            <a href="<?php echo U('Login/loginout');?>" style="font-size:15px" >[退出]</a>            
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

            <form action="/index.php/Output/item/id/30" method="post" class="main_form">
             
                <input type="hidden" name="id" value='<?php echo ($info["id"]); ?>' />
                <div class="text_info clearfix"><span>物品ID：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='id' value='<?php echo ($info["id"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div> 
                
                <div class="text_info clearfix"><span>物品名称：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='name' value='<?php echo ($info["name"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>资产编号：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='asset_number' value='<?php echo ($info["asset_number"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>仓库位置：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='position' value='<?php echo ($info["position"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>库存数量：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='sum' value='<?php echo ($info["stock"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div> 

                 <div class="text_info clearfix"><span>单价：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='price' value='<?php echo ($info["price"]); ?>'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div> 
                          
                <div class="text_info clearfix"><span>出库数量：</span></div>
                <div class="input_info">
                    <input type="text" class="width110" name='output_num' /> 
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能超过库存数量</div>
                </div>   

 <!--           <div class="text_info clearfix"><span>入库数量：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='sum'/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且只能为数字</div>
                </div>     
  -->                    
                <div class="button_info clearfix">
                    <?php echo W('Menu/goods');?> 
                </div>


                <div class="button_info clearfix">
                    <input type="button" value="出库" class="btn_save" onclick="send()" />
                    <input type="button" value="取消" class="btn_save" />
                </div>
            </form>
        </div>
        <!--主要区域结束-->
     
        
        
<style type="text/css">
    .l-text{
        width: 80px;
    }
    .li_width label input{
        position: relative;
        top:10px;
    }
</style>
<script type="text/javascript">
    $(function(){
        //点击之后的图标
         $('.output_off').addClass('output_on').removeClass('output_off');

    });  
    
</script>

<script type="text/javascript">
    function send(){
        layer.confirm('你确定真的要下单吗？', {icon: 3, title:'提示'}, function(index){
        if(index){    
        
    
                    $.ajax({
                    url: '/index.php/Output/item/id/30',
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
                                location.href = "<?php echo U('Output/index');?>";
                            }, <?php echo C('AJAX_TIME');?>);

                        }

                    }
                });
                
                
        }  
          layer.close(index);
        });                 
            
    }
</script>

<script type="text/javascript">
 $(function(){
     $('#category_id').change();
 }); 
  
</script>
<script type="text/javascript">
    $(function(){
        //延迟加载属性
        setTimeout(function () {
            $(".div_contentlist label").change();
        }, 200);
    });
</script>        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>