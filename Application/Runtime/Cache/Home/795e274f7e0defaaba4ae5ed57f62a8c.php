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
                
                <div class="text_info clearfix"><span>物品ID：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='id' value='<?php echo ($info["id"]); ?>' disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 
                
                <div class="text_info clearfix"><span>物品名称：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='name' value='<?php echo ($info["name"]); ?>' disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>资产编号：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='asset_number' value='<?php echo ($info["asset_number"]); ?>' disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>仓库位置：</span></div>
                <div class="input_info">
                    <input type="text" class="width200" name='position' value='<?php echo ($info["position"]); ?>' disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div> 

                <div class="text_info clearfix"><span>单价：</span></div>
                <div class="input_info">
                    <input type="text" class="width110" name='price' value='<?php echo ($info["price"]); ?>' disabled/>
                    <span class="required">元</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div>                 

                <div class="text_info clearfix"><span>库存：</span></div>
                <div class="input_info">
                    <input type="text" class="width110" name='sum' value="<?php echo ($info["sum"]); ?>" disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div>   
                
                <div class="text_info clearfix"><span>入库时间：</span></div>
                <div class="input_info">
                    <input type="text" class="width130" name='stock' value="<?php echo date('Y-m-d H:i:s',$info['time']) ;?>" disabled/>
                    <span class="required">*</span>
                    <div class="validate_msg_medium">不能为空，且为20长度的字母、数字和汉字的组合</div>
                </div>                   
                              
                    <div class="text_info clearfix"><span>物品品牌：</span></div>
                    <div class="input_info">
                        <select name="brand_id" disabled>
                            <!--品牌分类-->
                            <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" 
                            <?php if($info['brand_id']==$vo['id']){ echo 'selected'; } ?>        
                                ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            
                        </select>  
                    </div>                
                                                   
                <div class="text_info clearfix"><span>物品类型：</span></div>
                <div class="input_info" id="as">
  
                        <select name="category_id" id="category_id" onchange="get_attr(this)" disabled> 
                        <!--遍历类型-->                            
                        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" 
                        <?php if($info['category_id']==$vo['id']){ echo 'selected'; } ?>            
                         ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
                        </select>  
                    <span class="required">
                    </span>
                    <div class="validate_msg_tiny">至少选择一个类型</div>
                </div>     
                
        </div>
        <!--主要区域结束-->
   
        


<script type="text/javascript">
    $(function(){
        //点击之后的图标
        $('.warehouse_off').addClass('warehouse_on').removeClass('warehouse_off');
    });  
</script>



<script type="text/javascript">
 $(function(){
     $('#category_id').change();
     
 }); 

 
</script>



  
  


        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统V1.2版</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>