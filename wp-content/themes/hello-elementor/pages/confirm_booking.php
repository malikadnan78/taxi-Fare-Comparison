<?php

function sendBookingConfirmationEmail($id) {
	global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM wp_booking where id=$id order by pickdate ASC");

	$body = '
	<div style="margin:0;padding:0;min-width:100%;background-color:#f2f2f2;font-family:Helvetica,Arial,sans-serif;font-weight:300">
<font color="#888888"></font>
<table style="background-color:#f2f2f2;margin:0;padding:0;border-collapse:collapse!important;height:100%!important;width:100%!important" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="padding:4px 0 10px 0" align="center">
<a href="https://britishcartransfer.co.uk/"><img  src="https://britishcartransfer.co.uk/wp-content/uploads/2022/03/Screenshot_2022-04-04_105341-removebg-preview.png" class="CToWUd"></a>
</td>
</tr>
<tr>
<td align="center">
<table style="background-color:#ffffff;margin:0;padding:0;border-collapse:collapse;border-radius:5px;width:520px" width="520" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td align="center">
<table style="background-color:#ffffff;margin:0;padding:0;border-collapse:collapse;width:420px" width="420" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:12px">&nbsp;</td>
</tr>
<tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:12px">&nbsp;</td>
</tr>
<tr>
<td align="center"><b style="background-color:#5A45CE;border-radius: 10px;padding-top:7px;padding-left:18px;padding-bottom:4px;padding-right:18px;color:#ffffff;font-weight:500;font-size:20px;text-align:center">Booking Confirmed</b></td>
</tr>
<tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:12px">&nbsp;</td>
</tr>
<tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:14px;line-height:20px" align="left"><b>Dear '.$result->firstname.' '.$result->lastname.',<br>
<br></b> Thank you for booking your taxi transfer with us. We are pleased to advise that your booking is now confirmed, as follows:<br>
<br><b>Please note that all passengers are now required to bring and wear face masks when travelling in our vehicles.</b><br>
</td>
</tr>
<tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:12px">&nbsp;</td>
</tr>
<tr>
<td align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="padding-top:11px" width="42" valign="top"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/refer.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Reference</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->reffno.'</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/price-tag.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Cost</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->cost.'</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/credit-card.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Payment By</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->paymentmethod.'</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img alt="Customer" src="https://ci4.googleusercontent.com/proxy/CvsyrpbR8dj96VhYMnOiHnsOrvDQWxH_Jf2bdGklHqfLUdR2K1P8W5Iy1TiTi9yiWNM4GFXuWsmFAWp06Z6RHaMMfgptiEdiYlY9ZvZMT7PNYS20-FTjiWwH0sgMiFhhLUHAo-psmHQ=s0-d-e1-ft#https://d1mkmy7qgnv9b6.cloudfront.net/1.19.1/images/batapi/email/booking/customer.jpg" style="font-size:8px;color:#ffffff;background-color:#f0cfcf;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Customer</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->firstname.' '.$result->lastname.' ('.$result->phone.')</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="42" valign="middle"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/electric-car.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Vehicle</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">Saloon</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/car-service.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Pick-up</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->pickdate.', '.$result->origin.'</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/car-service.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Drop/td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->returndate.', '.$result->destination.'</td>
</tr>
</tbody></table>
</td>
</tr>

<tr>
<td style="padding-top:11px" width="42" valign="top"><img alt="Luggage" src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/luggage.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Luggage</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->handluggage .' Hand luggage, '.$result->luggage.' Check-in luggage, 0 Oversize luggage.</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img alt="Drop Off" src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/location.png" style="font-size:8px;color:#ffffff;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Drop-Off</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->destination.'</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img alt="Passengers" src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/passenger.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Passengers</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">'.$result->passangers.' passenger</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-top:11px" width="42" valign="top"><img alt="Instructions" src="https://britishcartransfer.co.uk/wp-content/uploads/2022/04/instructions.png" style="font-size:8px;color:#ffffff;width:42px;height:42px" class="CToWUd"></td>
<td width="388" valign="middle">
<table width="388" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="font-size:9px;color:#808080;height:14px;padding-left:20px;text-transform:uppercase;font-family:Helvetica,Arial,sans-serif;font-weight:300;padding-top:4px" width="42">Instructions</td>
</tr>
<tr>
<td style="font-size:14px;color:#000000;height:14px;padding-left:20px;font-family:Helvetica,Arial,sans-serif;font-weight:500;width:388px;line-height:18px" width="388">Your driver will meet you with your name card at RM8 2UU.<br>
<br>
For your convenience, we will text you with the driver\'s name and mobile phone number prior to your pickup.<br><br>

However, if you are unable to contact the driver at the pickup time, please call our control centre on +44 7383 333605. <br>

<br>
<b>Book a return transfer</b></td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td colspan="2" style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:14px;line-height:18px" align="left"><b><br>
Regards,<br>
Pick Drop</b></td>
</tr>
<tr>
<td colspan="2" style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:14px" align="left">&nbsp;</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="font-family:Helvetica,Arial,sans-serif;font-weight:300;font-size:12px">&nbsp;</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="padding-bottom:88px" align="center">
<font color="#888888">
</font><font color="#888888">
</font><table width="520px" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>
	<h2 style="text-align: center;"> Book your return transfer </h2>
<a href="#" target="_blank" ><img src="https://britishcartransfer.co.uk/wp-content/uploads/2022/03/great-britain-cars-blog-1.png" style="font-size:25px;color:#ffffff;width:520px;height:120px" class="CToWUd"></a>
</td>
</tr>
<tr>
<td style="font-size:10px;color:#000000;padding:20px;text-align:left;line-height:15px" align="center">This e-mail message may contain confidential or legally privileged information and is intended only for the use of the intended recipient(s). Any unauthorised disclosure, dissemination, distribution, copying or the taking of any action in reliance on the information herein is prohibited. E-mails are not secure and cannot be guaranteed to be error free as they can be intercepted, amended, or contain viruses. Anyone who communicates with us by e-mail is deemed to have accepted these risks. Pick Drop is not responsible for errors or omissions in this message and denies any responsibility for any damage arising from the use of e-mail. Any opinion and other statement contained in this message and any attachment are solely those of the author and do not necessarily represent those of the company.<br>
Please note that the booking is not subject to VAT. A Sales receipt will be sent via email once the journey has been completed.</td>
</tr>

<tr>
<td align="center">
<font color="#888888">
</font><font color="#888888">
</font><table width="100px" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td>
<a href="#"> <img src="https://ci4.googleusercontent.com/proxy/UXL_tkOsCrQlf_sPlY-5ScltfZJPCy9HTj9AU2Zrgw6egx07e5vmJvko5qI4pqhpQu35yXZ6lzaPvEKgPT5kyzob-44pYtSDciEw-QeZBBL2DhWU-CxrPaLkTbrtWp7jOw=s0-d-e1-ft#https://d1mkmy7qgnv9b6.cloudfront.net/1.19.1/images/batapi/email/booking/f.png" class="CToWUd"></a>
</td>
<td>
<a href="#"> <img src="https://ci5.googleusercontent.com/proxy/tZOV848TYTd5edcgcC0zfgBXaXakuRDs3_Xq76gmGNkWpKr_xXl57vLQnrIy5bOpew_P25ci-a0pKHx8bngL4NqThFuF3I_6DibhprxUqcv8-L3ssuuEuK7AKk-3WcMzSQ=s0-d-e1-ft#https://d1mkmy7qgnv9b6.cloudfront.net/1.19.1/images/batapi/email/booking/t.png" class="CToWUd"></a>
</td>
<td>
<a href="#"> <img src="https://ci4.googleusercontent.com/proxy/3XjOXEgJDoqc1MfbFXp3X1YxcQAogmm9Up4c7EFWBsnL0uKzNTzlvWn8hHhgNkZ14lXZtMZqUxwcFN_s8jvzu9g1EcmGb_swrA4EZ57gM7CdxSToINh3VfqPRG4YC4ClWA=s0-d-e1-ft#https://d1mkmy7qgnv9b6.cloudfront.net/1.19.1/images/batapi/email/booking/p.png" class="CToWUd"></a><font color="#888888">
</font></td></tr></tbody></table><font color="#888888">
</font></td></tr></tbody></table><font color="#888888">
</font></td></tr>
<tr>
<td>
<p>&nbsp;</p>
</td>
</tr>
</tbody></table></div>';

	$to = $result->email;
    $subject = 'Booking Recieved';

    $headers = array('Content-Type: text/html; charset=UTF-8','From: Pick Drop <info@pickdrop.co.uk>');

	$mailsent=  wp_mail( $to, $subject, $body, $headers );

 	if ($mailsent) {
      return true;
  	} else {
      false;
  	}
}