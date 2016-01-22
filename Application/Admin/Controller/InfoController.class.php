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
	
	/**
	 * 根据$offset和$length参数截取数组$array的子数组
	 * 
	 * @param array $array			要操作的数组
	 * @param int $offset			如果$offset非负，则序列将从$array中的此偏移量开始；
	 * 								如果$offset为负，则序列从$array中距离末端这么远的地方开始
	 * @param int $length			如果给出了$length并且为正，则序列中将具有这么多的单元;
	 * 								如果给出了 $length并且为负，则序列将终止在距离数组末端这么远的地方;
	 * 								如果省略，则序列将从$offset开始一直到$array的末端
	 * @param bool $preserve_keys
	 */
	public function array_slice_test($array, $offset, $length=null, $preserve_keys=false)
	{
		// 数据类型检查
		if (!is_array($array)) return;
		$offset = is_numeric($offset) ? intval($offset) : 0;
		$length = is_numeric($length) ? intval($length) : null;
		$preserve_keys = is_bool($preserve_keys) ? $preserve_keys : false;
		
		$first = 0;	// 子数组在原数组的起点
		$len = 0;	// 子数组的长度

		$count = count($array);
		// 判断子数组在原数组的起点
		if ($offset >= 0)
		{
			$first = $offset;
		}
		else if ($offset < 0)
		{
			$first = $count + $offset;
		}
		// 判断子数组的长度
		if ($length === null)
		{
			$len = $count - $first;
		}
		else if ($length >=0)
		{
			$len = $length;
		}
		else if ($length < 0)
		{
			$len = $count - $first + $length;
			$len = $len>=0 ? $len : 0;
		}
		// 组装子数组
		for ($i=0; $i<$first; $i++) next($array);
		$i = 0;
		$key = 0;
		$subArray = array();
		while ($i < $len)
		{
			$tmp = each($array);
			if (empty($tmp[0])) break;
			if (is_int($tmp[0]) && !$preserve_keys)
			{
				$subArray[$key] = $tmp[1];
				$key++;
			}
			else
			{
				$subArray[$tmp[0]] = $tmp[1];
			}
			$i++;
		}
		reset($array);
		
		return $subArray;
	}
	
	public function test_2()
	{
		$array = array(
				'a' => "ahehe",
				'b' => "bhehe",
				2 => "chehe",
				3 => "dhehe",
				4 => "ehehe",
				'f' => "fhehe"
		);
		
		$test = $this->array_slice_test($array, 1, 3, true);
		
		print_r($array);
		echo "<br />";
		print_r($test);
		echo "<br />";
	}
	
	public function index()
	{
		$model = new Model();
		
		if (IS_AJAX)
		{
			// 数据搜索
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
			else if ($_GET['tag'] == 'search')
			{
				$searchData = $_POST['data'];
				$sql = "select * from `tp_info` where `addr` like '%{$searchData}%' 
					|| `name` like '%{$searchData}%' 
					|| `age`='{$searchData}';";
				
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