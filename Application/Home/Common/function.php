<?php

function ajax(){
    IS_AJAX || die('无效的方式的提交方式');
}

//excel处理
function excel(){
    //引入核心 class  
    require_once('./Public/Classes/PHPExcel.php');  
    require_once('./Public/Classes/PHPExcel/Writer/Excel2007.php');  
    $objPHPExcel = new PHPExcel();   
    
    //Set properties 设置文件属性  
    //创建人
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
    //最后修改人
    $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
    //标题
    $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
    //题目
    $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
    //描述
    $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
    //关键字
    $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
    //种类
    $objPHPExcel->getProperties()->setCategory("Test result file"); 
    
    //设置当前的sheet
    $objPHPExcel->setActiveSheetIndex(0);
    //设置sheet的name
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    //设置单元格的值
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'String');
    $objPHPExcel->getActiveSheet()->setCellValue('A2', 12);
    $objPHPExcel->getActiveSheet()->setCellValue('A3', true);
    $objPHPExcel->getActiveSheet()->setCellValue('C5', '=SUM(C2:C4)');
    $objPHPExcel->getActiveSheet()->setCellValue('B8', '=MIN(B2:C5)');    
    
    //在默认sheet后，创建一个worksheet
    echo date('H:i:s') . " Create new Worksheet object\n";
    $objPHPExcel->createSheet();
    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
    $objWriter-save('php://output');    
}

//验证码校验
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

//验证权限 并跳转
function jumps($infos,$name){
    if( !strstr( $infos,$name )  &&  !strstr( $infos,'---' ) ){
//        dump(strstr( $infos,$name ) );
//        dump(strstr( $infos,'---' ));
//        die;
        $url= 'http://'.$_SERVER['HTTP_HOST'].PHP_FILE.'/Public/nopower';
        echo "<script language='javascript' type='text/javascript'>";  
        echo "location.href='".$url."'";  
        echo "</script>";          
        exit;
    }    
}

/**
* 系统邮件发送函数
* @param string $to 接收者邮箱
* @param string $name  接收者邮箱名称
* @param string $subject 邮箱主题
* @param string $body    邮件内容
* @param string $attachment  附件列表
* @param return boolean
*/
 function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){

    $config = C('THINK_EMAIL');

    vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件

    $mail= new \PHPMailer(); //PHPMailer对象

    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码

    $mail->IsSMTP();  // 设定使用SMTP服务

    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能

                                               // 1 = errors and messages

                                               // 2 = messages only

    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能

    $mail->SMTPSecure = 'ssl';                 // 使用安全协议

    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器

    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号

    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名

    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码

    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);

    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];

    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];

    $mail->AddReplyTo($replyEmail, $replyName);

    $mail->Subject    = $subject;

    $mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 

    $mail->MsgHTML($body);

    $mail->AddAddress($to, $name);

    if(is_array($attachment)){ // 添加附件

        foreach ($attachment as $file){

            is_file($file) && $mail->AddAttachment($file);

        }

    }

    return  $mail->Send() ? true : $mail->ErrorInfo;

}