<body>
<!-- navigation -->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a href="<?php echo base_url(); ?>" class="brand logo">Twobecome.us</a>
			<div class="nav-collapse">
				
				<ul class="nav">
					<li><p class="navbar-text"><i>Customer Service: cs@twobecome.us</i></p></li>
					<li class="divider-vertical"></li>
					<li>
						<form class="form-search navbar-search pull-left" method="post" action="<?php echo base_url(); ?>admincs/home/search">
							<input type="text" class="search-query span3" placeholder="Search email, name or #orderhash" name="q">
							<button type="submit" class="btn btn-warning" name="search_submit" value="1">Search</button>
						</form>
					</li>
				</ul>
				
			</div>
		</div>
	</div>
</div>