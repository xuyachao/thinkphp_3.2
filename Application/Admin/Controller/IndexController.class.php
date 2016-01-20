<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends BasicController {

	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index(){
		\Think\Log::write(_PUBLIC_, 'WARN');
        //$this->show();
        
		$this->view();
    }
    
    /**
     * 菜单列表
     */
    public function menuList()
    {
    	$menuModel = M('menu');
    	$data = $menuModel->where(array('pid'=>0))->select();
    	
    	$this->assign('data', $data);
    	$this->view();
    }
    
    /**
     * 添加菜单
     */
    public function addMenu(){
    	$menuModel = M('menu');
    	
    	if (IS_POST)
    	{
    		if ($menuModel->create())
    		{
    			$id = $menuModel->add();
    			if ($id)
    			{
    				$cache = $this->initRedis();
    				unset($cache->menu);
    				$this->success('添加成功');
    			}
    			else
    			{
    				$this->error('添加失败');
    			}
    		}
    		
    		exit;
    	}
    	
    	$data = $menuModel->where(array('pid'=>0))->select();
    	$this->assign('data', $data);
    	$this->view();
    }
}