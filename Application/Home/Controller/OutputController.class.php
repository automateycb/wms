<?php
namespace Home\Controller;
use Think\Controller;

class OutputController extends PublicController {
    
    public function index(){
        //获取所有的品牌
        $brand=M('brand')->field('id,name')->select();

        //获取所有的类型
        $category=M('category')->field('id,name')->select();
        
        //获取所有的属性
//        $attribute=M('attribute')->field('id,name')->select();
//        dump($attribute);
        
        //商品列表信息
        $res=D('Goods')->goods();
        //dump($res);       
        // $List=$res;
        // dump($List['res'][0]['sum']);
        //分配
        $this->assign(array(
            'res'       =>  $res,
            'empty'     =>  '<tr><td colspan="8"><span class="empty">没有找到匹配的数据...</span></td></tr>',
            'brand'     =>  $brand,
            'category'  =>  $category,
//            'attribute'=>  $attribute
            )
        );
        $this->display();
    }
     
    
    //编辑 修改
//     public function item(){
//         //分类列表
//         $category=D('Category');
//         $res=$category->field('id,name')->select();
//         $this->assign('category',$res);
        
//         //品牌列表
//         $brand=D('Brand');
//         $brand=$brand->field('id,name')->select();
//         $this->assign('brand',$brand);     
        
//         //获取信息
//         if( I('get.id/d') ){
//             $id=I('get.id/d');
//             $res=D('Goods')->goods();
// //            dump($res['res'][0]);
//             $this->assign('info',$res['res'][0] );
//         }
        
//         //数据提交
//         if( I('post.') ){
//             $data=I('post.');
            
//             //判断是否是ajax提交
// //            ajax();
            
//             $model=D('Goods');
//             //检验是否是有效数据
//             if($model->reduce_stock1()){
//                 //修改
//                 $this->success('下单成功！',U('Output/index')) && exit();
                
//             }else{
//                 $this->error( '下单失败!'.$model->getError() );
//                 exit;
//             }
            
//             //乐观锁  返回json数据
//             $this->ajaxReturn( array('status'=>1,'info'=>'修改成功！') );      
//         }
        
//         $this->display();
//     }
    
    //编辑 出库
    public function item(){

         //获取信息
        if( I('get.id/d') ){
            $id=I('get.id/d');
            $res=D('Goods')->goods();
            $this->assign('info',$res['res'][0] );
        }
        
        //数据提交
        if( I('post.') ){
            $data=I('post.');
            //判断是否是ajax提交
            ajax();
            
            $model=D('Goods');
             
            //检验是否是有效数据          
            if($model->output_record() ){

                    $this->success('出库成功，邮件已发送管理员！',U('Output/item')) && exit();
                }
                else{
                    $this->error( '出库失败!'.$model->getError() );
                    exit;
            }
            
            //乐观锁  返回json数据
            $this->ajaxReturn( array('status'=>1,'info'=>'修改成功！') );      
        }
        
        $this->display('item');

    }

    
    //ajax获取属性列表
    public function get_attr(){
        $model=D('Goods');
        $res=$model->get_attr( I('get.id/d') );
        $this->ajaxReturn($res);
    }

    
    //出库记录
    public function record(){

        //获取所有的品牌
        $brand=M('brand')->field('id,name')->select();

        //获取出库信息
        $res=D('record')->search();
        
        //获取所有的类型
        $category=M('category')->field('id,name')->select();
        
        //dump($res);
        $this->assign(array(
            'res'   =>  $res,
            'empty' =>  '<tr><td colspan="9"><span class="empty">没有找到匹配的数据...</span></td></tr>',
            'category'=>$category,
            'brand' =>  $brand
        ));
        
        $this->display();
    }

    //Excel函数
    public function exportExcel($expTitle,$expCellName,$expTableData){

        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle.date('_Ymd');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel.PHPExcel");
            
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        //设置单元格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

        //设置行高
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //设置字体样式
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize('20');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:AE2')->getFont()->setBold(true);
        
                //设置居中
        $objPHPExcel->getActiveSheet()->getStyle('A1:AE'.($dataNum+3))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
        //所有垂直居中
        $objPHPExcel->getActiveSheet()->getStyle('A1:AE'.($dataNum+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        //合并单元格
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');
   
        //设置Excel表单文字
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     *
     * 导出Excel
     */
    function expUser(){//导出Excel
        // if(session('userid')!=1){
        //     $this->error('此操作需要超级管理员权限！',U('Index/contacts'),2);
        // }
        $xlsName  = "出库单";
        $xlsCell  = array(
        array('name','姓名'),
        array('goods_id','物品ID'),
        array('goods_name','物品名称'),
        array('count','出库数量'),
        array('create_time','出库时间'),

        );

        $xlsModel = M('Record');
        $xlsData  = $xlsModel->Field('goods_id,goods_name,count,name,create_time')->select();
        foreach ($xlsData as $k => $v)
        {
            //$xlsData[$k]['name']=Gettname($v['tid']);
            //$xlsData[$k]['name']=$v['name'];
            $xlsData[$k]['create_time']=date('Y-m-d',$xlsData[$k]['create_time']);
            //array_splice($xlsData[$k]['tid']);
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
            
    }
    /**
     *
     * 显示导入页面 ...
     */

    /**实现导入excel
     **/
    function impUser(){

        if (!empty($_FILES)) {
            $upload = new \Think\Upload();// 实例化上传类
            $filepath='./Public/Excel/'; 
            $upload->exts = array('xlsx','xls');// 设置附件上传类型
            $upload->rootPath  =  $filepath; // 设置附件上传根目录
            $upload->saveName  =     'time';
            $upload->autoSub   =     false;
            if (!$info=$upload->upload()) {
                $this->error($upload->getError());
            }
            foreach ($info as $key => $value) {
                unset($info);
                $info[0]=$value;
                $info[0]['savepath']=$filepath;
            }
            vendor("PHPExcel.PHPExcel");
            $file_name=$info[0]['savepath'].$info[0]['savename'];
            $extension = strtolower( pathinfo($file_name, PATHINFO_EXTENSION));
            //xls格式
            if($extension=='xls'){
                $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            }
            //xlsx格式
            else if($extension=='xlsx'){
                $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            }
            else if($extension=='csv'){
                $objReader = \PHPExcel_IOFactory::createReader('CSV');
            }
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $j=0;
            for($i=2;$i<=$highestRow;$i++)
            {
                $data['name']= $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                $data['asset_number']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $data['position']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                $data['sum']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                $data['price']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                $data['brand_id']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                $data['category_id']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                // if(M('Contacts')->where("name='".$data['name']."' and phone=$data['phone']")->find()){
                //  if(M('Contacts')->where("phone='".$data['phone']."'")->find()){
                    //如果存在相同联系人。判断条件：电话 两项一致，上面注释的代码是用姓名/电话判断
               // }else{
                $model=D('Goods');

                 //检验是否是有效数据
                if($model->create($data,1)){
                    //添加
                     $model->add($data);
                    // import_category($data);
                     $j++;
                }

            }
            unlink($file_name);
            //User_log('批量导入联系人，数量：'.$j);
            $this->success('导入成功！本次导入物品数量：'.$j);
        }else
        {
            $this->error("请选择上传的文件");
        }
    }
    

}

