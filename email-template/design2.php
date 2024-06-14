<?php 

function returnTemplate($data){
    return ("
<html xmlns='http://www.w3.org/1999/xhtml'>

<body topmargin='0' rightmargin='0' bottommargin='0' leftmargin='0' marginwidth='0' marginheight='0' width='100%' style='border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
	background-color: #fbfbfb;
	color: #000000;'
	bgcolor='#fbfbfb'
	text='#000000'>

<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0' style='margin:15px 0;border-collapse: collapse; border-spacing: 0; width: 100%;' class='background'><tr><td align='center' valign='top' style='border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;'
	bgcolor='#fbfbfb' >

<table border='0' cellpadding='0' cellspacing='0' align='center'
	bgcolor='#fff' style='border-collapse: collapse; border-spacing: 0; padding: 0; width:100%; max-width: 600px; min-width: 300px;
	border-bottom: 7px solid #fee860;
	border-top: 7px solid #fee860;
    background-image: linear-gradient(#cf7eb3, #fee860), linear-gradient(#cf7eb3, #fee860);
    background-size:7px 100%;
    background-position:0 0, 100% 0;
    background-repeat:no-repeat;' class='container'>

	
	<tr>
	
		<td align='left' valign='top' style='border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;'>
		<center>
      <a href><img src='https://xqn91.mjt.lu/img/xqn91/b/s2sq/00thn.png' alt width='301' height='70' style='margin-bottom:15px;margin-top:15px' /></a><br></center>
         
		</td>
	</tr>
   
	<tr>
	<td align='left' valign='top' style='border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 18px; font-weight: normal; line-height: 1.6;
			padding-top: 25px;
			color: #222;
			font-family: Gorgia;' class='header'>
    <p style='color:#e54a5f;font-family:Great vibes;font-size:48px;text-align:center !important;padding:0;margin:0'><b> Thanks Giving</b></p>
    
				<p style='font-family: Roboto Slab;'>Dear  Team,<br>
<br>
Greetings from BugendaiTech!<br><br>

This Thanksgiving, we almost have too many blessings to count. Without a doubt, one of them is working with you. We appreciate you and want to say thank you indeed. Owing you a massive debt of appreciation for the help throughout the year; without you, we could not have reached this point. Working with you makes our job fantastic and highly enthralling. 
<br><br>
  Elevated from the previous year we have expanded our services in <b>Salesforce/Hubspot/Magento CRM customization and integration, CMS development and support, Web and App development,</b> and <b>Data Science and Analytics,</b> including <b>AI/ML.</b> We have more than 250  projects under our belt and 140+ qualified resources. We have not just widened our roots to one country, but to five in total i.e. <b>USA, India, London, UAE, Germany</b>
 
<br><br>
    

  We live for a motto to replenish with what we reap and for the same we are working for an initiative <b>BugendaiNoble.</b> Working a little harder to give back to humanity.
<br><br>
  
  On this note, cherishing the heights we have attained together.<br><br>
  <b>We wish you a pleasant holiday!</b>
  <br><br>
  
  
  
     <a href='https://www.bugendaitech.com/unsubscribe.php?temp=".base64_encode($data['template'])."&camp=".$data['campaign_name'].".&list_id=".$data['list_id']."'>unsubscribe</a>
     <img  src='https://www.bugendaitech.com/marketing-panel/updatemailstatus.php?id=".base64_encode($data['id'])."' style='width:0px;display:none'>
		</td>

	


</td>
</tr>
  
   
</table></table>

</body>
</html>");
}

?>