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

        <form action="/index.php/Input/index.html" method="get" id="search" enctype="multipart/form-data">
                
            <!--查询-->
            <div class="search_add">                        
                    <div>物品ID：<input type="text" class="text_search width50" value="<?php echo I('get.id');?>" name='id'/></div>                            
                    <div>名称：<input type="text" class="width70 text_search" value="<?php echo I('get.name');?>" name='name'/></div>

                    <div>
                        排序：
                        <select class="select_search width70" name='order'>
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
                <!--搜索结束-->   

                    <div>
                    <input type="button" value="增加" class="btn_add" onclick="location.href='/index.php/Input/add';" />
                    </div> 
                                 
            </div>  
                           
                
   </form>  

            <!--excel导入导出  -->
             <div class="search_add">   
                   <div>
                        <form action="<?php echo U('Input/impUser');?>" method="post" enctype="multipart/form-data">
                            <input type="file"  class="width200 text_search" name="import"/>
                            <input type="submit" class="btn_add" value="Excel导入"/>
                        </form>
                    </div>

                    <div>
                            <input type="button" value="导出数据" class="btn_add" onclick="location.href='/index.php/Input/expUser';" />
                    </div>
            </div>

                            <!--数据区域：用表格展示数据-->                   
                <div id="data">            
                    <table id="datalist">
                        
                    <tr>
                        <th>物品ID</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>品牌</th>
                        <th>资产编号</th>
                        <th>仓库位置</th>
                        <th>入库数量</th>
                        <th>剩余库存</th>
                        <th>购入总价</th>
                        <th>单价</th>
                        <th>入库日期</th>                                            <th>操作</th>
                        <th></th>
                    </tr>
<!--开始遍历数据-->  
<?php if(is_array($res['res'])): $i = 0; $__LIST__ = $res['res'];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["category_name"]); ?></td>
                        <td><?php echo ($vo["brand_name"]); ?></td>
                        <td><?php echo ($vo["asset_number"]); ?></td>
                        <td><?php echo ($vo["position"]); ?></td>
                        <td><?php echo ($vo["sum"]); ?></td>
                        <td><?php echo ($vo["stock"]); ?></td>
                        <td><?php echo ($vo["total"]); ?></td>
                        <td><?php echo ($vo["price"]); ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$vo['time']);?></td>                    
                        <td class="td_modi">                          
                            <input type="button" value="修改" class="btn_modify" onclick=" location.href='/index.php/Input/edit/id/<?php echo ($vo["id"]); ?>'; " />
                            <input type="button" value="删除" class="btn_delete" onclick=" deletes( '/index.php/Input/delete/id/<?php echo ($vo["id"]); ?>' ); " />                   
                        </td>
                        <td><a href="/index.php/Input/detail/id/<?php echo ($vo["id"]); ?>">明细</a></td>

                    </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>   
<!--遍历结束-->                    
                  
                </table>    

                <p>操作说明：<br />
                1、通过增加，新增物品信息；<br />
                2、通过修改，修改原有物品信息；<br />
                3、通过明细，查看物品信息细节；<br />
                </div> 
                
                <!--分页-->
                <div id="pages">
                    <?php echo ($res['page']); ?>
                </div>                    
            
        </div>
<!--主要区域结束-->


<script type="text/javascript">
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
    
    
    
    //禁止 开通
    function set_status(obj){
    
        layer.confirm('你确定真的要修改用户状态吗？', {icon: 0, title:'提示'}, function(index){
        if(index){
        
                $.ajax({
                   type: "GET",
                   url: obj,
                   success: function(data){

                            //判断修改加成功！
                            if(data.status==0){
                                layer.msg(data.info,{icon: 5});
                            }else{
                                layer.msg(data.info,{icon: 6});

                                //延迟跳转
                                setTimeout(function () {
                                    location.href = "<?php echo U('Account/index');?>";
                                }, <?php echo C('AJAX_TIME');?>);

                            }

                   }
                });      
        
//        layer.msg(obj);

    }  
      layer.close(index);
    });

    }
    
    
    //删除
    function deletes(obj){
      
    layer.confirm('你确定真的要删除此商品？', {icon: 3, title:'提示'}, function(index){
    if(index){    
        
        $.get(obj, function(data){
            
            //判断是否删除成功！
            if(data.status==0){
                layer.msg(data.info,{icon: 5});
            }else{
                layer.msg(data.info,{icon: 6});

                //延迟跳转
                setTimeout(function () {
                    location.href = "<?php echo U('Input/index');?>";
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
         $('.input_off').addClass('input_on').removeClass('input_off');
    });  
</script>

<style type="text/css">
    #print{
        width:50px;
        height:24px;
    }
</style>
   <script type="text/javascript">
       
       function preview(id){
           var sprnhtml=$('#'+id).html();   //获取区域内容
           var selfhtml=$('body').html(); //获取当前页的html
           $('body').html(sprnhtml);
           window.print();
           $('body').html(selfhtml);
       }
   </script>

        


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>