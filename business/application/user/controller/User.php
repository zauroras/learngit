<?php 
namespace app\user\Controller;
use think\Controller;
use think\Db;
use app\user\model\User as UserModel;
use think\Loader;
use think\cache\driver\Redis;
//用户端管理代码
class User extends Controller
{
	//用户注册
	public function register()
	{   
		 //暂时允许所有跨域访问
		 header('Access-Control-Allow-Origin:*');
		if(request()->isPost())
		{
		//通过get/post请求获取数据
		$data=input('post.');
		//用户名不能为空且密码不少于6位
	  if(empty($data['username'])&&strlen($data['password'])<=6)
	  {
		return 1;
	  }
	  //其他注册失败条件
	  if(aa)
	  {
		return 2;
	  }	
	  //获取注册所需要的其他信息(数据库插入数据)
      $data = ['foo' => 'bar', 'bar' => 'foo'];
	  $sql=Db::table('db_name')->insert($data);
	

		}
        

	}
	//用户登录
	public function landing()
	{
		//暂时允许所有跨域访问
		header('Access-Control-Allow-Origin:*');
		if(request()->isPost())
		{

			$user = new UserModel;
            if ($user->login($data) == 1) 
            {
                //用户名密码正确，成功登陆
                echo json_encode('1');
            }
            elseif($user->login($data) ==2) 
            {
                //用户名或密码错误
                return json_encode('0');
            }
            elseif($user->login($data)==3)
            {
                //用户名不存在
                return json_encode(0.5);
            }


		}

	}
	//用户修改密码
    //得到原用户名username和修改后username1
	public function change()
	{
        header('Access-Control-Allow-Origin:*');
        if(request()->isPost())
        {
            //用户名
           $usernmae1=input('username1');
           $usernmae=input('username');
           $sql=Db::table('db_name')->where('username',$username)->update(['username'=>$username1]);
          
           if($sql){
            return x;
           }
           //密码，得到用户名
           $password=input('password');
           $sql1==Db::table('db_name')->where('username',$username)->update(['password'=>$password]);
           
           if($sql1){
            return x;
           }
        }

	}
	//获取手机验证码(用redis存储phone-code-time)
	public function getmsg()
	{
		    //if(request()->isPost()){          
            $number = input('number');//input助手函数	获取输入数据 支持默认值和过滤
            
            Loader::import('alimsg.api_demo.SmsDemo',EXTEND_PATH);//对应extend目录，路径，如果你对SmsDemo类添加了命名空间可在上面 use 后在此处直接实例化
 
            $code =$this->random();

            //得到信息文件并执行.实例化阿里短信类
            $msg = new \SmsDemo('LTAIffAJ8FtKz2e8','ULI0zQcnGKXJCYG1mVFAq7LWYC0ohJ');//  此处写的就是Access key id 和Access key secret
            
            //此配置在sdk包中有相关例子
            $res = $msg->sendSms(
                //短信签名名称
                "学习试验",
                //短信模板code
                "SMS_142075303",
                //短信接收者的手机号码
               "$number",
                //模板信息
                Array(
                    'code' => $code,//随机变化的
                )
            );
            //对象转数组
            $response = (array)$res;
            var_dump($response["Message"]);
            //发送信息成功
            if($response["Message"]=='OK')
            {
                $redis = new Redis();
                $redis->set('user:phone:'.$number.':code'.$code);
            }
            
 
       // }
       
    }

    //生成所发送的验证码并返回(生成随机数)
    public function random()
    {
        $length = 6;
        $char = '0123456789';
        $code = '';
        while(strlen($code) < $length){
            //截取字符串长度
            $code .= substr($char,(mt_rand()%strlen($char)),1);
        }
        return $code;
    }

    //验证验证码是否正确
    public function check()
    {

    }





}




 ?>