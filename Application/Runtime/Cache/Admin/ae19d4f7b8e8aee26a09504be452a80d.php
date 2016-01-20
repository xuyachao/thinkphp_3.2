<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>后台管理</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo _PUBLIC_;?>\css\bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo _PUBLIC_;?>\css\bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo _PUBLIC_;?>\css\fullcalendar.css" />	
		<link rel="stylesheet" href="<?php echo _PUBLIC_;?>\css\unicorn.main.css" />
		<link rel="stylesheet" href="<?php echo _PUBLIC_;?>\css\unicorn.grey.css" class="skin-color" />
		
		<script src="<?php echo _PUBLIC_;?>/js/jquery.min.js"></script>
	</head>
	<body>
		
		<div id="header">
			<h1><a href="./dashboard.html">后台管理</a></h1>	
		</div>
		
		<div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#">new message</a></li>
                        <li><a class="sInbox" title="" href="#">inbox</a></li>
                        <li><a class="sOutbox" title="" href="#">outbox</a></li>
                        <li><a class="sTrash" title="" href="#">trash</a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
                <li class="btn btn-inverse"><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
              
		<div id="sidebar">
			<ul>
				<li class="active"><a href="buttons.html"><i class="icon icon-th-list"></i> <span>欢迎页</span></a></li>
				<?php if(is_array($menuArray)): $i = 0; $__LIST__ = $menuArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($i % 2 );++$i; if($opt["sub"] != 0): ?><li class="submenu">
							<a href="#"><i class="icon icon-th-list"></i> <span><?php echo ($opt["title"]); ?></span><span class="label"><?php echo ($opt["size"]); ?></span></a>
							<ul>
								<?php if(is_array($opt["sub"])): $i = 0; $__LIST__ = $opt["sub"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($item['url']);?>"><?php echo ($item["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</li>
					<?php else: ?>
						<li><a href="<?php echo U($opt['url']);?>"><i class="icon icon-th-list"></i> <span><?php echo ($opt["title"]); ?></span></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		
		</div>