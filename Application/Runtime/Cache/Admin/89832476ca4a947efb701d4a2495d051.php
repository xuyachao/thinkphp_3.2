<?php if (!defined('THINK_PATH')) exit();?>		<div id="content">
			<div id="content-header">
				<h1>菜单</h1>
				<div class="btn-group">
					<a href="<?php echo U('Index/addMenu');?>" class="btn btn-large tip-bottom" title="新建一个菜单项"><i class="icon-file"></i>添加菜单</a>
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
								<h5>菜单列表</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>上级菜单</th>
											<th>菜单名称</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
												<td style="text-align:center;"><?php echo ($item["id"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["pid"]); ?></td>
												<td style="text-align:center;"><?php echo ($item["title"]); ?></td>
												<td>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</tbody>
								</table>							
							</div>
						</div>
					</div>
				</div>