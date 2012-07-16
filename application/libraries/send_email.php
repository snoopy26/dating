<?php

class Send_email{
	
	public $ci;
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->library('phpmailer');
	}
	
	function sendEmailFinishRegister($fullname, $email, $title, $url, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
											Terima kasih, and telah berhasil mendaftarkan diri anda ke Twobecome.us. Sekarang anda harus melakukan verifikasi email anda disini <a href="'.$url.'">'.$url.'</a> dan tahap selanjutnya anda diharuskan melengkapi data-data anda.
										</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											JL. Kebun Jeruk Raya No.9  |   +62 85273255261   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
		
	}
	
	
	function sendEmailFinishVerificationInformation($fullname, $email, $title, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
											<b>Your account has been created and active — now it will be easier than ever to find your love and mate.</b>
										</p>
										<p>Sekarang anda sudah dapat login Twobecome.us di <a href="'.base_url().'">sini</a>, dengan menggunakan alamat email ini '.$email.'.</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											JL. Kebun Jeruk Raya No.9  |   +62 85273255261   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
		
	}
	
	
	
	
	function sendEmailTransferPayment($fullname, $email, $title, $sub_title = "Twobecome.us", $link = ""){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">  
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
										Anda harus membayar dating sejumlah Rp.350.000,- dengan cara bank transfer ke rekening di bawah ini:
										<br />
										<div class="banks">
											<img src="'.base_url().'img/ico_bca.png" width="82" height="31">
											<img src="'.base_url().'img/ico_prima.png" width="44" height="31"><br>
											<span>Nama</span> <strong>PT. Twobecomeus</strong><br>
											<span>Bank</span> <strong>BCA</strong><br>
											<span>Cabang </span> <strong>Jakarta</strong><br>
											<span>No Rekening</span> <strong>52 6032 2488</strong>
										</div>
										</p>
										<p>Apabila anda sudah membayar, lakukan konfirmasi ke link berikut ini <a href="'.$link.'">'.$link.'</a></p>
										<p>
											<a href="'.base_url().'login" style="border: 1px solid #f4db4c; background: #fff8cf; color: #db821a; padding: 8px 10px; display: block; text-decoration: none;">'.base_url().'login</a>
										</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
		
	}
	
	function sendEmailConfirmationPayment($fullname, $email, $title, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
											Terima kasih anda telah membayar. Sekarang admin kami sedang memproses pembayaran anda.
										</p>
										<p>
											<a href="'.base_url().'login" style="border: 1px solid #f4db4c; background: #fff8cf; color: #db821a; padding: 8px 10px; display: block; text-decoration: none;">'.base_url().'login</a>
										</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
		
	}
	
	function sendEmailCancelPayment($fullname, $email, $title, $sub_title = "Twobecome.us", $status){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
											Anda membatalkan payment dengan status yang live : <b>'.$status.'</b>
										</p>
										<p>
											<a href="'.base_url().'login" style="border: 1px solid #f4db4c; background: #fff8cf; color: #db821a; padding: 8px 10px; display: block; text-decoration: none;">'.base_url().'login</a>
										</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
	}
	
	function sendProcessCheckout($fullname, $email, $title, $kode_uniq, $order_hash, $total, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
Terima kasih anda telah mengajukan pembelian di Twobecome.us<br />
Email ini BUKAN BUKTI PEMBAYARAN YANG SAH. <br />
<br />
Silakan selesaikan transaksi anda sesuai dengan informasi dibawah ini.<br />

---------------------------------------------------<br />
Informasi Pembayaran<br />
---------------------------------------------------<br />
Uniqcode    : IDR '.$kode_uniq.' <br />
Order Hash    : #'.$order_hash.' <br />
Total       : IDR '.$total.' <br />
No Rekening : 1150410807 <br />
Nama  		: Anton Junaidi <br />
Bank  		: BCA <br />
Cabang  	: Jakarta <br />
---------------------------------------------------<br />
<br />
<br />
**Anda harus men-transfer sejumlah uang sesuai dengan nominal diatas (sudah termasuk kode unik), jika tidak maka kami akan membutuhkan waktu 5 hari kerja untuk memproses transaksi anda.
<br />

Setelah anda berhasil melakukan transfer, anda dapat melakukan konfirmasi pembayaran dengan mengisi formulir konfirmasi di '.base_url().'checkout/confirm_payment?orderhash='.$order_hash.' 					
</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
	}
	
	function sendRememberProcessCheckout($fullname, $email, $title, $kode_uniq, $order_hash, $total, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
Kepada pelanggan yang terhormat di sini kami ingin mengkonfirmasikan ulang mengenai pembelian di Twobecome.us

Silahkan Cantumkan :

- Nomor Order Hash. <b>Contoh : OrderHash:#'.$order_hash.'</b>
- Nama Pentransfer
- Jumlah Transfer. <b>Ingat, Harus di tambahkan Kode Uniq nya. Contoh, Jumlah Transfer : '.$total.'</b>
- Nama Bank

Sebisa mungkin cantumkan Bukti Transfer untuk mempermudah pengecekan.
</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
	}
	
	function sendProcessConfirmPayment($fullname, $email, $title, $order_hash, $payment_date, $bank_asal, $bank_tujuan, $account_name, $amount, $note, $sub_title = "Twobecome.us"){
		$message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Email Notification</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Deon Sukma">
	<!-- Date: 2011-09-20 -->
</head>
<body>

	<table width="100%" cellpadding="0" cellspacing="0" bgcolor="edf2f5">
		<tr>
			<td>

	<table cellpadding="20" cellspacing="0" width="600" align="center">
		<tr>  
			<td>&nbsp;</td>  
		</tr>
	</table><!-- top message -->  

	<tr>  
	    <td>  
	        <table id="header" cellpadding="0" cellspacing="0" align="center">   
	            <tr>  
	                <td width="560" bgcolor="ffffff" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #555555; padding: 20px 15px; border: 1px solid #dadada; line-height: 18px">
										<p>
											Dear <b>'.$fullname.',</b> 
										</p>
										<p>
Pelanggan yang Terhormat, Terima kasih anda telah mengajukan pembelian di Twobecome.us<br />
<br />
Anda telah melakukan konfirmasi pembayaran dengan metode manual transfer Order Hash # '.$order_hash.', berikut ini detail konfirmasi anda:
<br />
---------------------------------------------------<br />
Informasi Konfirmasi Pembayaran<br />
---------------------------------------------------<br />
Tanggal Bayar       : '.$payment_date.'<br />
Bank Asal           : '.$bank_asal.'<br />
Bank Tujuan  	    : '.$bank_tujuan.'<br />
Nama Akun           : '.$account_name.'<br />
Jumlah Transfer     : '.$amount.'<br />
Catatan             : '.$note.'<br />
KTP					: Team kami akan memeriksa KTP anda, hal ini untuk memudahkan kami dalam pemeriksaan kebenaran data anda.<br />
---------------------------------------------------<br /><br />

Email ini BUKAN BUKTI PEMBAYARAN YANG SAH. Transaksi dinyatakan valid jika sejumlah nominal atas nama akun tersebut telah masuk ke dalam account Twobecome.us
</p>
										<p>
											If you need help, you can always contact our <a href="#" style="text-decoration: none; color: #267aba">Customer Support</a>. Thank You. 
										</p>
										<p>
											Best Regards, <br><br>
											PT. Twobecomeus
										</p>
									</td>  
	            </tr>  
	            <tr>  
	                <td width="570" align="center" bgcolor="edf2f5" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #929fa9;">
										<p>
											KS Tubun Raya No.83 Jakarta Barat 14110  |   +62 21 5365 3305   |   cs@twobecome.us
										</p>
										<p>
											Find Us on <a href="#" style="text-decoration: none; color: #267aba">Facebook</a> &amp; Follow Us on <a href="#" style="text-decoration: none; color: #267aba">Twitter</a> 
										</p>
									</td>  
	            </tr>  
	        </table>
	    </td>  
	</tr>
			</td>
	</tr>

	</table>

</body>
</html>
		';
		
		$this->phpmailer_tmpl($message, $email, $title, $sub_title);
	}
	
	function phpmailer_tmpl($message, $email, $title, $sub_title = 'Twobecome.us'){
		$this->ci->phpmailer->IsMail();
		$this->ci->phpmailer->AddAddress($email);
		$this->ci->phpmailer->Subject = $title .' | '. $sub_title;
		$this->ci->phpmailer->MsgHTML($message);
		$this->ci->phpmailer->AddReplyTo('noreply@twobecome.us', $title .' | '. $sub_title);
		$this->ci->phpmailer->SetFrom('noreply@twobecome.us', $title .' | '. $sub_title);
		$this->ci->phpmailer->Send();
	}
	
}

?>