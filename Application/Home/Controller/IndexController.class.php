<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(isset($_GET['type'])){
            $_type=array(
                'ps_file_type'=>$_GET['type']
            );
        }else{
            $_type='1=1';
        }
        $base='administration';
        $date=$_type;
        $_result=R('Sql/Select',array($base,$date));
        $this->assign('value',$_result);
        $this->display();
    }
    public function ajaxchuli()
    {
        $n = D("administration");//造一个nation表的模型对象
        if(isset($_GET['type'])){
            if($_GET['type']==5){
                $attr = $n->order('ps_file_id desc')->select();
            }else{
                $_data=array(
                    'ps_file_type'=>$_GET['type'],
                );
                $attr = $n->where($_data)->order('ps_file_id desc')->select();
            }
        }
        $this->ajaxReturn($attr);//ajax返回数据的方式，用ajaxReturn。
    }


    /**
     * 添加
     */
    public function insert() {
        $_count=count($_FILES['file']['name']);
        $Form = D("administration");
        $_file='file';$_img_route='ps_file_route';
        $_data=$this->upload($_file,$_img_route);
        $_flag='';
        for($i=0;$i<$_count;$i++){
            $data=array(
                'ps_file_name'=>$_FILES['file']['name'][$i],
                'ps_file_route'=>$_data[$_img_route][$i],
                'ps_file_type'=>$_REQUEST['type'],
            );
            $_resut=$Form->add($data);
            if($_resut){
                $_flag++;
            }
        }
        if($_flag==$_count){
            $this->ajaxReturn(1);
        } else {
            $this->error(2);
        }
    }
    public function upload($_file,$_img_route){
        $image = new \Think\Image();
        $data = array();
        // 计数数组中上传的文件数
        $total = count($_FILES[$_file]['name']);
        // 循环遍历每个文件
        for ($i = 0; $i < $total; $i++) {
            //临时文件路径
            $tmpFilePath = $_FILES[$_file]['tmp_name'][$i];
            //确保我们有一个文件路径
            if ($tmpFilePath != "") {
                $time=NOW_TIME;
                $savename=$time.$_FILES[$_file]['name'][$i];
                $newFilePath = "./Public/uploads/" . $savename;
                //将文件上传到临时目录中
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    //将图片的名字存到一串字符串中,用逗号隔开
                    $data[$_img_route][$i] = $savename;
                    $image->open($newFilePath);
                    $image->thumb(250, 250)->save('./Public/Thumbnail/'.$savename);
                }
            }
        }
        return $data;
    }
    public function delete(){
        $_data=array(
            'ps_file_id'=>$_GET['id']
        );
        $_srt=D('administration');
        $_rest=$_srt
            ->where($_data)
            ->delete();
        if($_rest){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(5);
        }
    }

}