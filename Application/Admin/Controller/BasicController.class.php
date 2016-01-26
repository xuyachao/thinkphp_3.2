<?php
namespace Admin\Controller;
use Think\Controller;
class BasicController extends Controller
{
	
	private $allow = array("login", "dologin");	// 用于存放不用判断用户是否登录的action
	
	public function __construct()
	{
		parent::__construct();
		// 判断用户是否登录
		if (!in_array(strtolower(ACTION_NAME), $this->allow))
		{
// 			$isLogin = session("?userInfo");
// 			if (!$isLogin)
// 			{
// 				$this->error("您还没有登录，请登录", U('admin/User/login'));
// 			}
		}
	}	
}