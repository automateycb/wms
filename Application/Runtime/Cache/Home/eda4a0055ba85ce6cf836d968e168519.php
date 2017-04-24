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
        <form action="/index.php/Output/record" method="get" id="search">
                <!--查询-->
                <div class="search_add">                        
                    <!-- <div>账号：<span class="readonly width70"><?php echo ($infos["nickname"]); ?></span></div> -->
                    
                    <div>
                        姓名:<input type="text" name="name"class="text_search width100" value="<?php echo I('get.name');?>"/>
                    </div>
                    
                    <div>
                        日期:<input type="date" name="create_time" class="width100 text_search" value="<?php echo I('get.create_time');?>"/>
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

                    <div>
                        <input type="submit" value="搜索" class="btn_search" />
                        <button onclick="preview('data');" id="print">打印</button>
                    </div>
        </form>         

                    <!--    <div>
                        <form action="<?php echo U('Input/impUser');?>" method="post" enctype="multipart/form-data">
                            <input type="file"  class="width200 text_search" name="import"/>
                            <input type="submit" class="btn_add" value="Excel导入"/>
                        </form>
                    </div> -->
                    
                    <!-- Excel导出数据 -->
                    <div>
                         <input type="button" value="导出数据" class="btn_add" onclick="location.href='/index.php/Output/expUser';" />
                    </div>

                    <input type="button" value="返回" class="btn_add" onclick="location.href='/index.php/Output/index';" />
                </div>
      
       
                <!--数据区域：用表格展示数据-->     
                <div id="data">            
                    <table id="datalist">
                        <tr>
                            <th>用户ID</th>
                            <th>姓名</th>
                            <th>日期</th>
                            <th>物品ID</th>
                            <th>物品名称</th>
                            <th>类型</th>
                            <th>出库数量</th>
                            
                        </tr>

<?php if(is_array($res['res'])): $i = 0; $__LIST__ = $res['res'];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["no"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo date('Y-m-d H:i:s',$vo['create_time']);?></td>
                            <td><?php echo ($vo["goods_id"]); ?></td>
                            <td><?php echo ($vo["goods_name"]); ?></td>
                            <!-- <td><?php echo explode(',',$vo['value'])[0];?></td>
                            <td><?php echo explode(',',$vo['value'])[1];?></td> -->
                            <td><?php echo ($vo["category_name"]); ?></td>
                            <td><?php echo ($vo["count"]); ?></td>
                            
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
    $(function(){
        //点击之后的图标
        $('.output_off').addClass('output_on').removeClass('output_off');

    });   
</script>
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
            search();
        }            
                    
    });      
</script>            


        <div id="footer">
            <p>CSOT AUTO 自主使用仓库管理系统</p>
            <p>ycb设计  mail:yanchaobin@tcl.com </p>
        </div>
    </body>
</html>