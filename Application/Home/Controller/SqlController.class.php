<?php
namespace Home\Controller;
use Think\Controller;
class SqlController extends Controller {
    /**
     * Select()查询
     * @param string $base 表名
     * @param array $date 条件
     * @return array mixed 查询结果
     */
    public function Select($base,$date){
        $_str=D($base);
        $_result=$_str
            ->where($date)
            ->order('ps_file_id desc')
            ->select();
        return $_result;
    }

    /**
     * Add()添加图片
     * @param string $base 表名
     * @param array $date 条件
     * @param string $action 操作
     */
    public function Add($base,$date,$action){
        $_count=count($date['ps_file_name']);
        $str=D($base);
        $_flag=0;
        $_die=array();
        for($i=0;$i<$_count;$i++){
            global $data;
            $data=array(
                'ps_file_name'=>$date['ps_file_name'][$i],
                'ps_file_route'=>$date['ps_file_route'][$i],
                'ps_file_type'=>$date['ps_file_type'],
            );
            $_ret=$str->add($data);
            if($_ret){
                $_flag++;
                $_die[$i]=$_ret;
            }
        }
        if($_flag==$_count){
            $this->success($action.'成功！');
        }else{
            $this->_error($base,$_die);
            _unlink($data['savename']);
            $this->error($action.'失败！');
        }
    }

    public function Delete($base,$data,$action){
        $_delete=D($base)
            ->where($data)
            ->delete();
        if($action!=null){
            if($_delete){
                $this->success($action.'成功！');
            }else{
                $this->error($action.'失败！');
            }
        }
    }

    /**
     * _error()上传错误删除数据库的内容
     * @param $base
     * @param $date
     */
    public function _error($base,$date){
        $_count=count($date);
        for($i=0;$i<$_count;$i++){
            $data=array(
                'ps_file_id'=>$date[$i]
            );
        }
        $this->delete($base,$data,null);
    }
}