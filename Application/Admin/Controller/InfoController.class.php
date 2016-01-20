<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;

class InfoController extends BasicController {

	private $nowPage = 1;	// 当前页码
	private $listRows = 20;	// 每页的数据量
	
	public function __construct()
	{
		parent::__construct();
		
		$this->nowPage = $_GET['page'];
	}
	
	/**
	 * 数据分页
	 * 
	 * @param int $count	数据总量
	 */
	public function page($count)
	{
		$totalPages = ceil($count / $this->listRows);	// 计算总页数
		$pageHtml = '<div class="dataTables_paginate">';
		for ($i=1; $i<=$totalPages; $i++)
		{
			$url = U('Info/index', array('page'=>$i));
			$pageHtml .= "<a href=\"{$url}\" class=\"ui-button\">{$i}</a>";
		}
		$pageHtml .= '</div>';
		
		return $pageHtml;
	}
	
	public function index(){
		$model = new Model();
		
		if (IS_AJAX)
		{
			if ($_GET['tag'] == 'sex')
			{
				//\Think\Log::write('测试日志信息，这是警告级别，并且实时写入','WARN');
				$sex = $_POST['sex'];
				$sql = "select * from `tp_info` where `sex`={$sex};";
				$data = $model->query($sql);
				$this->initRedis(300);
				S("search", $data);
				$this->ajaxReturn(1);
			}
			else if ($_GET['tag'] == 'province')
			{
				$province = $_POST['province'];
				$sql = "select * from `tp_info` where `province`='{$province}';";
				$data = $model->query($sql);
				$this->initRedis(300);
				S("search", $data);
				$this->ajaxReturn(1);
			}
		}
		
		$data = S('search');
		if (!$data)
		{
			//$data = $infoModel->cache('search', 300, 'redis')->select();
			$sql = "select * from `tp_Info`;";
			$data = $model->query($sql);
			$this->initRedis(300);
			S("search", $data);
		}
        
        $count = count($data);
        $pageShow = $this->page($count);
         
        $list = array_slice($data, ($this->nowPage-1) * 20, $this->listRows);     
        
        foreach ($list as &$val)
        {
        	if ($val['sex'])
        	{
        		$val['sex'] = '女';
        	}
        	else
        	{
        		$val['sex'] = '男';
        	}
        }
        
        
        $this->assign('list', $list);
        $this->assign('page', $pageShow);
		$this->view();
    }
}