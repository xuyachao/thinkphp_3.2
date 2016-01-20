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
		
		// 获取菜单数据
		$menuArray = $this->menuShow();
		$this->assign("menuArray", $menuArray);
	}
	
	/**
	 * 从数据库获取菜单数据
	 * @return array
	 */
	private function menuFromSQL()
	{	
		$menuModel = M("menu");
		$menuArray = array();	// 用于存放向模板传入菜单数据的数组
		$menuArray = $menuModel->where(array('pid'=>0))->select();
		// 组装向模板传入菜单数据的数组
		foreach ($menuArray as $key=>$val)
		{
			$subMenu = $menuModel->where(array('pid'=>$val['id']))->select();
			if ($subMenu)
			{
				$menuArray[$key]['size'] = count($subMenu);
				$menuArray[$key]['sub'] = $subMenu;
			}
			else
			{
				$menuArray[$key]['sub'] = 0;
			}
		}
		return $menuArray;
	}
	
	/**
	 * 初始化redis缓存
	 * 
	 * @param int $expire	缓存有效期（单位：秒）
	 * @return object
	 */
	public function initRedis($expire=7200)
	{
		$setting = array(
				'type'	=> 'redis',	// 设置缓存类型为redis
				'host'	=> '127.0.0.1',
				'port'	=> '6379',
				'expire'=> $expire
		);
		$cache = S($setting);	// 初始化缓存设置
		return $cache;
	}

	/**
	 * 获取菜单数据
	 */
	public function menuShow()
	{
		$cache = $this->initRedis();
		$menu = $cache->menu;
		if ($menu)
		{
			return $menu;
		}
		else
		{
			$menu = $this->menuFromSQL();
			$cache->menu = $menu;
			return $menu;
		}
	}
	
	/**
	 * 自定义模板显示函数
	 * @param string $template
	 */
	public function view($template='')
	{
		$this->display("Basic/header");
		$this->display($template);
		$this->display("Basic/footer");
	}
		
}