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
            <form action="/index.php/Output/index.html" method="get" id="search">
                <!--查询-->
                <div class="search_add">                        
                    <div>物品ID：<input type="text" class="text_search width50" value="<?php echo I('get.id');?>" name='id'/></div>                            
                    <div>名称：<input type="text" class="width70 text_search" value="<?php echo I('get.name');?>" name='name'/></div>

                    <div>
                    排序：
                    <select class="select_search" name='order'>
                        <option value="id asc">默认</option>
                        <option value="price asc" <?php if( I('get.order')=='price asc' ){ echo 'selected';} ?> >  ↑ 价格从低到高 </option>                        
                        <option value="price desc" <?php if( I('get.order')=='price desc' ){ echo 'selected';} ?> > ↓ 价格从高到低 </option>
                        <option value="count asc" <?php if( I('get.order')=='count asc' ){ echo 'selected';} ?> >  ↑ 库存从低到高 </option>                        
                        <option value="count desc" <?php if( I('get.order')=='count desc' ){ echo 'selected';} ?> > ↓ 库存从高到低 </option> 
                        <option value="time asc" <?php if( I('get.order')=='time asc' ){ echo 'selected';} ?> >   ↑ 日期从低到高 </option>                        
                        <option value="time desc" <?php if( I('get.order')=='time desc' ){ echo 'selected';} ?> >  ↓ 日期从高到低 </option> 
                    </select>
                    </div>
                    
                    <div>
                        品牌：
                        <select class="select_search width70" name='brand' id='status'>
                            <option value="">全部</option>
                            <!--遍历品牌-->                            
                            <?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if( I('get.brand')==$vo['id'] ){ echo 'selected';} ?>  ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                            
                            
                        </select>
                    </div>

                    <div>
                    类型：
                    <select class="select_search" name='category'>
                    <option value="">全部</option>
                    <!--遍历类型-->                            
                        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if( I('get.category')==$vo['id'] ){ echo 'selected';} ?>  ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>                            
                    </select>
                    </div>
                    
                    <!--搜索开始-->
                    <div>
                        <input type="button" value="搜索" class="btn_search" id="btn_search" onclick="search()"/>
                        <button onclick="preview('data');" id="print">打印</button>
                    </div> 

                    <div>
                    <input type="button" value="出库记录" class="btn_add" onclick="location.href='/index.php/Output/record';" />
                    </div>  
                    
            </div>  
                                            
            </form> 
             <!--数据区域：用表格展示数据-->   
                <div id="data">            
                  <table id="datalist">
                    <tr>
                        <th>物品ID</th>
                        <th>物品名称</th>
                        <th>类型</th>
                        <th>仓库位置</th>
                        <th>剩余库存</th>
                        <th>出库总数</th>
                        <th>操作</th>
                    </tr>


                   <?php if(is_array($res['res'])): $i = 0; $__LIST__ = $res['res'];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["category_name"]); ?></td>
                        <td><?php echo ($vo["position"]); ?></td>
                        <td><?php echo ($vo["stock"]); ?> </td>   
                        <td><?php echo ($vo["output_sum"]); ?> </td>              
                        <td><a href="/index.php/Output/item/id/<?php echo ($vo["id"]); ?>" title="出库操作">出库操作</a></td>
                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>                     
                  </table> 
                </div>   
                <!--分页-->
                <div id="pages">
                    <?php echo ($res['page']); ?>
                </div>                    
            
        </div>
        <!--主要区域结束-->

<script type="text/javascript">
    $(function(){
        //点击之后的图标
        $('.output_off').addClass('output_on').removeClass('output_off');

    });  

    function search(){
        layer.load(2); //加载
        setTimeout(function(){
            $('#search').submit();
        },<?php echo C('SEARCH_TIME');?>);
        
    }
    
    $(function(){
        
        $('#status').change(function(){
            $('#search').submit();
        });
        
        $('select').change(function(){
            $('#search').submit();
        });        
    });
    
    //键盘事件    
    $(document).keydown(function(event){ 
        if(event.keyCode == 13){
//            alert(event.keyCode); 
            search();
        }            
                    
    });          
    
</script>
<script type="text/javascript">
       
       function preview(id){
           var sprnhtml=$('#'+id).html();   //获取区域内容
           var selfhtml=$('body').html(); //获取当前页的html
           $('body').html(sprnhtml);
           window.print();  //打印
           $('body').html(selfhtml); //赋值
       }
</script>        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>