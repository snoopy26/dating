<body>
<!-- navigation -->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="<?php echo base_url(); ?>" class="brand logo">Twobecome.us</a>
			<div class="nav-collapse">
				
				<ul class="nav">
					<li><p class="navbar-text"><i>Customer Service: cs@twobecome.us</i></p></li>
				</ul>
				
				
				
				<ul class="nav pull-right">
					<?php 
					$member = $this->session->userdata('2becomeus_login');
					
					$uri = $this->uri->segment_array();
					$explore_sel = $profile_sel = "";
					if (!empty($uri[1])){
						switch($uri[1]){
							case "explore" : $explore_sel = "active";break;
							case "profile" : $profile_sel = "active";break;
						}
					}
					
					if (empty($member)){ 
					?>
					<li><a href="<?php echo base_url() . "auth/signup"; ?>"><b>Free Register</b></a></li>
					<?php }else{ ?>
					
					<li class="<?php echo $explore_sel; ?>"><a href="<?php echo base_url(); ?>explore">Explore</a></li>
					<li class="divider-vertical"></li>
					<li class="dropdown <?php echo $profile_sel; ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Profile</b><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url() . 'profile/index/' . $member->member_username; ?>">View my profile page</a></li>
							<li class="divider"></li>
							<li><a href="#">Messages</a></li>
							<li class="divider"></li>
							<li><a href="#">Settings</a></li>
							<li><a href="<?php echo base_url() . "auth/signout" ?>">Sign Out</a></li>
						</ul>
					</li>
					
					<?php }?>
					<li class="divider-vertical"></li>
					
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Support</b><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">About</a></li>
							<li class="divider"></li>
							<li><a href="#">FAQ</a></li>
							<li class="divider"></li>
							<li><a href="#">Customer Service</a></li>
						</ul>
					</li>
					
					<li class="divider-vertical"></li>
					<?php if (!empty($member)){  ?>
					<li>
						<form class="navbar-search pull-left" action="">
							<input type="text" class="search-query span2" placeholder="Search">
						</form>
					</li>
					<?php } ?>
				</ul>
				
				
				
			</div>
		</div>
	</div>
</div>