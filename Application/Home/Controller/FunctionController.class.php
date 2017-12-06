<?php
namespace Home\Controller;
use Think\Controller;
class FunctionController extends Controller {

    /**
     * Upload()添加
     */
    public function Upload(){
        if (!empty($_FILES['file']['tmp_name'])) {
            $_img_name='ps_file_name';
            $_img_route='ps_file_route';
            $date=_Uploads($_img_name,$_img_route);
            $base='administration';
            $action='图片添加';
            $date['ps_file_type']=$_POST['type'];
            R('Sql/Add',array($base,$date,$action));
        }else{
            $this->success('请选择图片!');
        }
    }

    /**
     * delete()删除
     */
    public function delete(){
        $data=array(
            'ps_file_id'=>$_GET['id'],
            'ps_file_route'=>$_GET['route']
        );
        $base='administration';
        $action='删除';
        _unlink($data['ps_file_route']);
        R('Sql/Delete',array($base,$data,$action));
    }
}