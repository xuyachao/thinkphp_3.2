<?php if (!defined('THINK_PATH')) exit();?>		<div id="content">
			<div id="content-header">
				<h1>菜单</h1>
			</div>	
			<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>添加菜单项</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" method="post" action="<?php echo U('Index/addMenu');?>" novalidate="novalidate" >
									
									<div class="control-group">
										<label class="control-label">上级菜单</label>
										<div class="controls">
											<select name="pid">
												<option value="0" />一级菜单
												<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($opt["id"]); ?>" /><?php echo ($opt["title"]); endforeach; endif; else: echo "" ;endif; ?>
												
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">菜单名称</label>
										<div class="controls">
											<input type="text" name="title"  />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">链接地址</label>
										<div class="controls">
											<input type="text" name="url"  />
										</div>
									</div>
									
									<div class="form-actions">
										<input type="submit" value="添 加" class="btn btn-primary" />
									</div>
								</form>
							</div>
						</div>
					</div>	
				</div>