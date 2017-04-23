<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>AUTO-仓库管理系统</title>
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global.css" />
        <link type="text/css" rel="stylesheet" media="all" href="/Public/styles/global_color.css" /> 
        <script src="/Public/js/jquery-1.9.1.min.js"></script>
        
        <script id="font-hack" type="text/javascript">
        if (/windows/i.test(navigator.userAgent)) {
            var el = document.createElement('style');
            el.innerHTML = '' + '@font-face {font-family:"noto-thin";src:local("Microsoft Yahei");}' + '@font-face {font-family:"noto-light";src:local("Microsoft Yahei");}';
            document.head.insertBefore(el, document.getElementById('font-hack'));
       }
       </script>
        
    </head>
    <body class="index">
        <div class="login_logo">  </div>
        <div class="login_box">
<form action="/index.php/Login/login" method="post" id="login">
    <!-- <a href="/index.php/Login/admin">普通用户登陆</a> -->
            <table>
                <caption>AUTO仓库管理系统</caption>
                <tr>
                    <td class="login_info">账号：</td>
                    <td colspan="2"><input name="username" type="text" class="width150" /></td>
<!--                    <td class="login_error_info"><span class="required">30长度的字母、数字和下划线</span></td>-->
                </tr>
                <tr>
                    <td class="login_info">密码：</td>
                    <td colspan="2"><input name="password" type="password" class="width150" /></td>
<!--                    <td><span class="required">30长度的字母、数字和下划线</span></td>-->
                </tr>
                <tr>
                    <td class="login_info">验证码：</td>
                    <td class="width70"><input name="code" type="text" class="width70" /></td>
                    <td><img src="/index.php/Login/code" alt="验证码" title="点击更换" id="code" onclick=""/></td>  
<!--                    <td><span class="required">验证码错误</span></td>              -->
                </tr>            
                <tr>
                    <td></td>
                    <!--登录-->
                    <td class="login_button" colspan="2">
                        <input type="submit" value="" />
                    </td>
                    
<!--                    <td><span class="required">用户名或密码错误，请重试</span></td>                -->
                </tr>
                <tr> 
                    <td></td>
                    <!--注册-->
                    <td class="login_button" colspan="2">
                        <input type="button" value="" onclick="location.href='<?php echo U('Login/register');?>'" />
                    </td>
                </tr>
            </table>
</form>    
        </div>
    </body>
</html>
<style type="text/css">
    input[type='submit']{
        background:url('/Public/images/login_btn.png'); 
        width: 124px;
        height:41px;
        border:none;
    }
    input[type='button']{
        background:url('/Public/images/register_btn.png'); 
        width: 124px;
        height:41px;
        border:none;
    }
    #code{
        width: 70px;
        height:30px;        
    }
</style>
<script type="text/javascript">
//    验证码
    $( function(){
	var checkVerify="/index.php/Login/code";
        
	//点击图片切换验证码
	$('#code').click(function(){
            var verifyurl=$(this).attr('src');
            //alert(verifyurl);
            $(this).attr('src',verifyurl+'/'+Math.random()); 
        });
    } );

</script>