<?php if (!defined('THINK_PATH')) exit();?>		<div id="content">
			<div id="content-header">
				<h1>信息</h1>
			</div>
					
			<div class="form-horizontal" style="float:left;">
				<label class="control-label">性别</label>
				<div class="controls">
					<select id="sex" url="<?php echo U('Info/index', array('tag'=>'sex'));?>" >
						<option>请选择</option>
						<option value="0">男</option>
						<option value="1">女</option>
					</select>
				</div>
			</div>
			<div class="form-horizontal" style="float:left;">
				<label class="control-label">省份</label>
				<div class="controls">
					<select id="province" data-url="<?php echo U('Info/index', array('tag'=>'province'));?>">
						<option>请选择</option>
						<option value="广东">广东</option>
						<option value="河南">河南</option>
						<option value="江西">江西</option>
						<option value="河北">河北</option>
						<option value="四川">四川</option>
					</select>
				</div>
			</div>

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>人员列表</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>姓名</th>
											<th>性别</th>
											<th>年龄</th>
											<th>地址</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
												<td style="text-align:center;"><?php echo ($item["id"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["name"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["sex"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["age"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["addr"]); ?></td>
												<td>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</tbody>
								</table>							
							</div>
						</div>
					</div>
				</div>
				<?php echo ($page); ?>
				
<div style="height:30px;"></div>				

<script type="text/javascript">

$(document).ready(function(){
	$("#sex").change(function(){
		var url=$(this).attr("url");
		var sex=$(this).val();
		$.ajax({
			type:"post",
			url:url,
			data:{sex:sex},
			success:function(result){
				if(result)
				{
					location.reload();
				}
			}
		});
	});

	$("#province").change(function(){
		var aurl=$(this).data("url");
		//console.log(url);
		
		var province=$(this).val();
		$.ajax({
			type:"post",
			url:aurl,
			data:{province:province},
			success:function(result){
				if(result)
				{
					location.reload();
				}
			}
		});
	});
	
});

</script>


				
<!-- 
	<div class="dataTables_filter">
		<label>Search: <input type="text" aria-controls="DataTables_Table_0"></label>
	</div>
	<div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers" id="DataTables_Table_0_paginate">
		<a tabindex="0" class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled" id="DataTables_Table_0_first">First</a>
		<a tabindex="0" class="previous fg-button ui-button ui-state-default ui-state-disabled" id="DataTables_Table_0_previous">Previous</a>
		<span>
		<a tabindex="0" class="fg-button ui-button ui-state-default ui-state-disabled">1</a><a tabindex="0" class="fg-button ui-button ui-state-default">2</a>
		<a tabindex="0" class="fg-button ui-button ui-state-default">3</a>
		<a tabindex="0" class="fg-button ui-button ui-state-default">4</a>
		<a tabindex="0" class="fg-button ui-button ui-state-default">5</a>
		</span>
		<a tabindex="0" class="next fg-button ui-button ui-state-default" id="DataTables_Table_0_next">Next</a>
		<a tabindex="0" class="last ui-corner-tr ui-corner-br fg-button ui-button ui-state-default" id="DataTables_Table_0_last">Last</a>
	</div>
 -->