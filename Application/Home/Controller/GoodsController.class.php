<?php
namespace Home\Controller;
use Think\Controller;

class GoodsController extends PublicController {
    
    public function index(){
        //获取所有的品牌
        $brand=M('brand')->field('id,name')->select();

        //获取所有的类型
        $category=M('category')->field('id,name')->select();
        
        //获取所有的属性
//        $attribute=M('attribute')->field('id,name')->select();
//        dump($attribute);
     
        //获取所有的门店
//        $store=M('store')->field('id,name')->select();
//        dump($store);        
        
        //商品列表信息
        $res=D('Goods')->goods();
        //dump($res);
        //分配
        $this->assign(array(
            'res'       =>  $res,
            'empty'     =>  '<tr><td colspan="9"><span class="empty">没有找到匹配的数据...</span></td></tr>',
             'brand'     =>  $brand,
             'category'  =>  $category,
            // 'attribute'=>  $attribute
            )
        );
        $this->display();
    }
    
    //添加商品
    public function add(){
        //分类列表
        $category=D('Category');
        $res=$category->field('id,name')->select();
        
        //品牌列表
        $brand=D('Brand');
        $brand=$brand->field('id,name')->select();     
    
        //获取所有的门店
        $store=M('store')->field('id,name')->select();
           
        $this->assign(array(
            'category'  =>  $res,
            'brand'     =>  $brand,
            'store'     =>  $store
        ));
        
        if( I('post.') ){
            $data=I('post./a') ;
//            dump($data);
//            die();
            //检测是否是ajax
            ajax();
            
            $model=D('Goods');
            //检验是否是有效数据
            if($model->create($data,1)){
                //添加
                if( $model->add($data) ){
                    $this->success('添加成功！',U('Goods/index')) && exit();
                }
                
            }else{
                $this->error( $model->getError() );
                exit();
            }
            
            //乐观锁  返回json数据
            $this->ajaxReturn( array('status'=>1,'info'=>'修改成功！') );  
            
        }
        
        $this->display('add');
    }
    
    
    //编辑 修改
    public function edit(){
        //分类列表
        $category=D('Category');
        $res=$category->field('id,name')->select();
        
        //品牌列表
        $brand=D('Brand');
        $brand=$brand->field('id,name')->select();     
    
        //获取所有的门店
        $store=M('store')->field('id,name')->select();
           
        $this->assign(array(
            'category'  =>  $res,
            'brand'     =>  $brand,
            'store'     =>  $store
        ));
           
        
        //获取信息
        if( I('get.id/d') ){
            $id=I('get.id/d');
            $res=D('Goods')->goods();
//            dump($res['res'][0]);
            $this->assign('info',$res['res'][0] );
        }
        
        //数据提交
        if( I('post.') ){
            $data=I('post.');

            //判断是否是ajax提交
            ajax();
            
            $model=D('Goods');
            //检验是否是有效数据
            if($model->create($data,2)){
                //修改
                if( $model->save($data) ){
                    $this->success('修改成功！',U('Goods/index')) && exit();
                }
                
            }else{
                $this->error( $model->getError() );
                exit;
            }
            
            //乐观锁  返回json数据
            $this->ajaxReturn( array('status'=>1,'info'=>'修改成功！') );      
        }
        
        $this->display();
    }
    
    //删除
    public function delete(){
        //判断是否传入了id
        if( I('get.id/d') ){
            $id=I('get.id/d'); 
            
            //判断是否是ajax提交
            ajax(); 
            
            $model=D('Goods');
            if( $model->delete($id) ){
                $this->success('删除成功!',U('Goods/index'));
            }else{
                $this->error( $model->getError() );
            }
            
        }
        
    }
    
    //ajax获取属性列表
    public function get_attr(){
        $model=D('Goods');
        $res=$model->get_attr( I('get.id/d') );
        $this->ajaxReturn($res);
    }
    
   
    //信息
    public function detail(){
        //分类列表
        $category=D('Category');
        $res=$category->field('id,name')->select();
        
        //品牌列表
        $brand=D('Brand');
        $brand=$brand->field('id,name')->select();     
    
        //获取所有的门店
        $store=M('store')->field('id,name')->select();
           
        $this->assign(array(
            'category'  =>  $res,
            'brand'     =>  $brand,
            'store'     =>  $store
        ));  
        
        //获取信息
        if( I('get.id/d') ){
            $id=I('get.id/d');
            $res=D('Goods')->goods();

            $this->assign('info',$res['res'][0] );
        }
     
        $this->display();
    }    
    
    
     //添加用户
    public function buy_add(){
        //分类列表
        $category=D('Category');
        $res=$category->field('id,name')->select();
        $this->assign('category',$res);
        
        //品牌列表
        $brand=D('Brand');
        $brand=$brand->field('id,name')->select();
        $this->assign('brand',$brand);        
        
        if( I('post.') ){
            $data=I('post./a') ;

            //检测是否是ajax
            ajax();
            
            $model=D('Goods');
            //检验是否是有效数据
            if($model->create($data,1)){
                //添加
                if( $model->add($data) ){
                    $this->success('添加成功！',U('Goods/index')) && exit();
                }
                
            }else{
                $this->error( $model->getError() );
            }
        }
        
        $this->display();
    }   

    //文件信息写入数据库
    private function AddFile($fileinfo,$depict){
          $i=0;
       // var_dump($fileinfo);
        $dateline=date("Y-m-d H:m:s");
        $file=M('file');
        foreach($fileinfo as $vo)
        {
            $data['filename']=$vo['savename'];
            $data['depict']=$depict[$i];
            $data['filepath']=$vo['savepath'];
            $data['dateline']=$dateline;
            if($file->data($data)->add()){
                //
                $i++;
            }else{
                  return false;
            }
        }

        return true;
    }
   //上传文件
    public function upload()
    {
        $config=array(
            'maxSize'=>100*1024*1024*1024,
            'mimes'=>array(),
            'rootPath'=>'./Public/Uploads/',
            'ext'=>array(),
            'autoSub'=>true,
        );
        $upload = new \Think\Upload($config);// 实例化上传类
        $depict=$_POST['depict'];
        $info   =   $upload->upload(); // 上传文件
        if(!$info){// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        else{// 上传成功

            if($this->AddFile($info,$depict))//写入数据库
            {
                $this->success('上传成功！','view');
            }
            else{
              //  $this->error('写入数据库失败');
            }

        }

    }
    
    //文件信息查看
    public function view()
    {
        $file=M('file');

        $count=$file->count();

        $pageone=20;

        $orderby['id']='desc';

        $Page= new \Think\Page($count,$pageone);

        $show=$Page->show();

        $data=$file->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('data',$data);

        $this->assign('show',$show);

        $this->display();

    }
    //文件信息管理
    public function manage()
    {
        $file=M('file');

        $count=$file->count();

        $pageone=20;

        $orderby['id']='desc';

        $Page= new \Think\Page($count,$pageone);

        $show=$Page->show();

        $data=$file->order($orderby)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('data',$data);

        $this->assign('show',$show);

        $this->display();
    }
    //文件下载
    function download(){
        $id=$_GET['id'];
        $file=M('file');
        $data=$file->find($id);
        $filepath=$data['filepath'];
        $file_name=$data['filename'];
        $file_path = "./Public/Uploads/".$filepath.$file_name;
       // echo $file_path;
        //转码，文件名转为gb2312解决中文乱码
        $file_name = iconv("utf-8","gb2312",$file_name);
        $file_path = iconv("utf-8","gb2312",$file_path);
        $fp = fopen($file_path,"r") or exit("文件不存在");
         //定义变量空着每次下载的大小
        $buffer = 1024;
       //得到文件的大小
        $file_size = filesize($file_path);
             //header("Content-type:text/html;charset=gb2312");
       //会写用到的四条http协议信息
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");//可以忽略
        header("Content-Length: ".$file_size);//原文这里是Accept-Length经查阅http协议无此项
        header("Content-Disposition:attachment;filename=".$file_name);
//字节技术器，纪录当前现在字节数
        $count = 0;
        while(!feof($fp) && $file_size-$count>0){
//从$fp打开的文件流中每次读取$buffer大小的数据
            $file_data = fread($fp,$buffer);
            $count+=$buffer;
//将读取到的数据读取出来
            echo $file_data;
        }
//关闭文件流
        fclose($fp);
    }
  //文件编辑页面
    public function  updateFilePage()
    {
        $id=$_GET['id'];

        $model=M("file");

        $data=$model->find($id);

        // echo $model->getLastSql();
        $this->assign('data',$data);

        $this->display();
    }
//修改文件信息
    public  function  updateFile()
    {
        $model=M("file");
        $data['id']=$_POST['id'];
        $data['fielname']=$_POST['fielname'];
        $data['depict']=$_POST['depict'];

        $num=$model->save($data);

        if($num > 0)
            $this->success("修改成功","manage");

        else
        {
            $this->error("修改失败","manage");
        }

    }
    //删除文章
    public  function  deleteFile()
    {
        $id=$_GET['id'];

        $model=M("file");



        $data=$model->find($id);
        $filepath=$data['filepath'];
        $file_name=$data['filename'];
        $file_path = "./Public/Uploads/".$filepath.$file_name;

        if(unlink($file_path))
        {
            $num=$model->delete($id);
            if($num > 0)
            {


                $this->success("删除成功","/fileupload/index.php/Home/Index/manage");

            }
        }


        // $this->assign('data',$data);
        //$this->display();
    }
 
}
