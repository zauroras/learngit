<?php
namespace app\user\Model;
use think\Model;
use think\Db;
class User extends Model{
    public function login($data){
        //$data['username']为表单用户名的名称
        $user=Db::name('tp_name')->where('list_name','=',$data['username'])->find();
        if($user)
        {
            if($user['password']==$data['password'])
            {
                //用户名密码信息正确
                return 1;
            }
            else{
                //密码错误
                return 2;
            }

        }
        else{
            //用户名不存在
            return 3;
        }



    }



}




?>