<?php 
$this->load->view('admincs/general/head_view');
$this->load->view('admincs/general/body_view');
?>

<div class="container product-feature feature-cover dating-feature">
	<div class="row container relative-row row-profile-cover explore-container"></div>
	<div class="row row-profile-cover">
		<div class="span11">
		
			<h2>Search for <i>"<?php echo $q; ?>"</i></h2>
		
			<?php
			if (count($results) > 0){
			
				if ($type == 1){
			?>
			
			<ul class="nav nav-tabs" id="tabMenu">
				<li class="active"><a href="#member_info" data-toggle="tab">Member Info</a></li>
				<li><a href="#order_info" data-toggle="tab">Order Info</a></li>
				<li><a href="#payment_info" data-toggle="tab">Payment Info</a></li>
			</ul>	
			
			<div class="tab-content">
				<div class="tab-pane active" id="member_info">	
					
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>Member Id</th>
								<th>Member Name</th>
								<th>Member Username</th>
								<th>Member Email</th>
								<th>Phone Number</th>
								<th>Photo</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($results as $result){
							?>
								
							<tr>
								<td><a href="<?php echo base_url() . "admincs/home/search/user/" . $result->member_id; ?>"><?php echo $result->member_id; ?></a></td>
								<td><?php echo $result->member_name; ?></td>
								<td><?php echo $result->member_username; ?></td>
								<td><?php echo $result->member_email; ?></td>
								<td><?php echo $result->phone_number; ?></td>
								<td><img src="<?php echo $this->filemanager->getPath($result->album1, "300x300"); ?>" alt="<?php echo $result->member_name; ?>" /></td>
							</tr>	
								
							<?php
							}
							?>
						</tbody>
					</table>
				
				</div>
				
				<div class="tab-pane" id="order_info">	
				
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>#Order Hash</th>
								<th>Date</th>
								<th>Payment Status</th>
								<th>Total Customer Price</th>
								<th>Uniqcode</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($results as $result){
							?>
								
							<tr>
								<td><a href="<?php echo base_url() . "admincs/home/search/order/" . $result->order_hash; ?>"><?php echo $result->order_hash; ?></a></td>
								<td><?php echo date('d M Y, H:i', strtotime($result->created_timestamp)); ?></td>
								<td class="payment_status"><?php echo $result->payment_status; ?></td>
								<td>IDR <?php echo number_format($result->total_customer_price, 2); ?></td>
								<td><?php echo $result->uniqcode; ?></td>
								<td>
								<?php
								switch($result->payment_status){
									case "checkout" : // button resend email confirmation
										echo '<a href="#" class="btn btn-info btn-ajax" data-type="checkout" data-orderhash="'.$result->order_hash.'">Resend Confirmation</a>';
										break;
									case "paid" : // button confirm payment
										echo '<a href="#" class="btn btn-warning btn-ajax" data-type="paid" data-orderhash="'.$result->order_hash.'">Confirm Payment</a>';
										break;
									case "confirmed" :
										echo '<a href="#" class="btn btn-success" data-type="confirmed">Confirmed</a>';
										break;
								}
								?>
								</td>
							</tr>	
								
							<?php
							}
							?>
						</tbody>
					</table>
			
				
				</div>
				
				<div class="tab-pane" id="payment_info">	
					
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>From Bank</th>
								<th>Bank Account Name</th>
								<th>Destination Bank</th>
								<th>Note</th>
								<th>Photo KTP</th>
								<th>Customer Price</th>
								<th>Date Of Payment</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($results as $result){
								if (empty($result->bank_account_name)) {
									echo "<tr><td>Belum ada confirmasi pembayaran</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>"; 
									break;
								}
							?>
								
							<tr>
								<td><?php echo $result->from_bank; ?></td>
								<td><?php echo $result->bank_account_name; ?></td>
								<td><?php echo $result->destination_bank; ?></td>
								<td><?php echo $result->note; ?></td>
								<td><img src="<?php echo $this->filemanager->getPath($result->ktp, "300x300"); ?>" alt="<?php echo $result->member_name; ?>" /></td>
								<td>IDR <?php echo number_format($result->customer_price, 2); ?></td>
								<td><?php echo date('d M Y, H:i', strtotime($result->datepayment)); ?></td>
							</tr>	
								
							<?php
							}
							?>
						</tbody>
					</table>
					
				</div>
				
			</div>
			
			
			<?php 
				}else if ($type == 0){
					
			?>
			
			<ul class="nav nav-tabs" id="tabMenu">
				<li class="active"><a href="#member_info" data-toggle="tab">Member Info</a></li>
			</ul>	
			
			<div class="tab-content">
				<div class="tab-pane active" id="member_info">	
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>Member Id</th>
								<th>Member Name</th>
								<th>Member Username</th>
								<th>Member Email</th>
								<th>Phone Number</th>
								<th>Photo</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($results as $result){
							?>
								
							<tr>
								<td><a href="<?php echo base_url() . "admincs/home/search/user/" . $result->member_id; ?>"><?php echo $result->member_id; ?></a></td>
								<td><?php echo $result->member_name; ?></td>
								<td><?php echo $result->member_username; ?></td>
								<td><?php echo $result->member_email; ?></td>
								<td><?php echo $result->phone_number; ?></td>
								<td><img src="<?php echo $this->filemanager->getPath($result->album1, "300x300"); ?>" alt="<?php echo $result->member_name; ?>" /></td>
							</tr>	
								
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			
			<?php
				
				}else if ($type == 2){
					
			?>
			
			<ul class="nav nav-tabs" id="tabMenu">
				<li class="active"><a href="#member_info" data-toggle="tab">Member Info</a></li>
				<li class=""><a href="#order_info" data-toggle="tab">Order Info</a></li>
			</ul>	
			
			<div class="tab-content">
				<div class="tab-pane active" id="member_info">	
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>Member Id</th>
								<th>Member Name</th>
								<th>Member Username</th>
								<th>Member Email</th>
								<th>Phone Number</th>
								<th>Photo</th>
							</tr>
						</thead>
						<tbody>
							<?php
							
							$member_id = "";
							foreach($results as $result){
								
								if ($result->member_id != $member_id){
							?>
								
							<tr>
								<td><a href="<?php echo base_url() . "admincs/home/search/user/" . $result->member_id; ?>"><?php echo $result->member_id; ?></a></td>
								<td><?php echo $result->member_name; ?></td>
								<td><?php echo $result->member_username; ?></td>
								<td><?php echo $result->member_email; ?></td>
								<td><?php echo $result->phone_number; ?></td>
								<td><img src="<?php echo $this->filemanager->getPath($result->album1, "300x300"); ?>" alt="<?php echo $result->member_name; ?>" /></td>
							</tr>	
								
							<?php
									$member_id = $result->member_id;
								}
							
							}
							?>
						</tbody>
					</table>
				</div>
				
				<div class="tab-pane " id="order_info">	
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th>#Order Hash</th>
								<th>Date</th>
								<th>Payment Status</th>
								<th>Total Customer Price</th>
								<th>Uniqcode</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($results as $result){
							?>
								
							<tr>
								<td><a href="<?php echo base_url() . "admincs/home/search/order/" . $result->order_hash; ?>"><?php echo $result->order_hash; ?></a></td>
								<td><?php echo date('d M Y, H:i', strtotime($result->created_timestamp)); ?></td>
								<td class="payment_status"><?php echo $result->payment_status; ?></td>
								<td>IDR <?php echo number_format($result->total_customer_price, 2); ?></td>
								<td><?php echo $result->uniqcode; ?></td>
								<td>
								<?php
								switch($result->payment_status){
									case "checkout" : // button resend email confirmation
										echo '<a href="#" class="btn btn-info btn-ajax" data-type="checkout" data-orderhash="'.$result->order_hash.'">Resend Confirmation</a>';
										break;
									case "paid" : // button confirm payment
										echo '<a href="#" class="btn btn-warning btn-ajax" data-type="paid" data-orderhash="'.$result->order_hash.'">Confirm Payment</a>';
										break;
									case "confirmed" :
										echo '<a href="#" class="btn btn-success" data-type="confirmed">Confirmed</a>';
										break;
								}
								?>
								</td>
							</tr>	
								
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				
			</div>
			
			<?php
					
				}
			
			}else{ ?>
			<p>No Information</p>
			<?php } 
			//echo $this->db->last_query();
			?>
		</div>
	</div>
</div>

<?php
$this->load->view('admincs/general/footer_body_view');
$this->load->view('admincs/general/footer_view');
?>
