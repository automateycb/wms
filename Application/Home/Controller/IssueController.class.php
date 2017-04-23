<?php
namespace Home\Controller;
use Think\Controller;

class IssueController extends PublicController{

    public function index(){
        $model=D('Issue');
        $res=$model->issue();
        $this->assign('res',$res);
        
        $this->display('list');
    }

    //添加
    public function add(){
       
        $issuecategory=D('Issuecategory');
        $res=$issuecategory->field('id,name')->select();
        $this->assign(array(
            'issuecategory'  =>  $res,
        ));

        if(I('post.')){

            $data=I('post./a'); //接受数据
            
            //检测是否是ajax
            ajax();
            
            $model=D('Issue');
            
            //检验是否是有效数据
            if($model->create($data,1)){
                //添加
                if( $model->add($data) ){
                    $this->success('添加成功！',U('Issue/index')) && exit();
                }
                
            }else{
                $this->error( $model->getError() );
            }
            
        }
        
        $this->display();
    }

    //删除问题
    public function delete(){
        
        //如果get id存在
        if( I('get.id/d')  ){
            $id=I('get.id/d');
            $model=D('Issue');
            
            //判断是否删除成功
            if( $model->delete($id) ){
                $this->success('删除成功!',U('Issue/index'));
            }else{
                $this->error( $model->getError() );
            }
            
        }
            
    }   
    


}