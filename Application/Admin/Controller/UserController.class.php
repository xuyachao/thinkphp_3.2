<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {

	private $adminMode = null;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->adminMode = M('admin');
	}
	
	/**
	 * 后台管理人员注册
	 */
	public function register()
	{
		if (IS_POST)
		{
			if ($this->adminMode->create())
			{
				$id = $this->adminMode->add();
				if ($id)
				{
					$this->success('注册成功');
				}
				else
				{
					$this->error('注册失败');
				}
			}
			exit;
		}
		
		$this->display();
	}
    
    /**
     * 后台管理人员登录
     */
    public function login()
    {
    	if (IS_POST)
    	{
    		$username = $_POST['username'];
    		$password = $_POST['password'];
    		$userInfo = $this->adminMode->where(array('username'=>$username))->find();
    		if (empty($userInfo))
    		{
    			$this->error("您登录的用户不存在");
    		}
    		if ($password == $userInfo['password'])
    		{
    			session("userInfo", $userInfo);
    			$this->success("登录成功", U('Admin/Index/index'));
    		}
    		else
    		{
    			$this->error("密码错误");
    		}
    	}
    
    	$this->display();
    }
    
    /**
     * 后台管理人员退出
     */
    public function loginOut()
    {
    	session(null);
    	$this->success("退出成功", U("admin/public/login"));
    }
}