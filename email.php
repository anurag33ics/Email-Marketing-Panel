<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php'; 
require_once 'src/SimpleXLSX.php';
function resetPassLinkEmail($username,$check){
	//$this->load->library('email');
	$to_email = $username; 
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->Host = "in-v3.mailjet.com";
	$mail->SMTPAuth = true;
	$mail->Username = '1bba2b0e634f06f9adad202eb080e6c5';
	$mail->Password = '488b6ac179fe18f5e19f475063f9dab4';
	$mail->SetFrom("job@corp2corpreq.com","corp2corpreq ", 0);
	$mail->Port = 80;
	$mail->addAddress($to_email);
	$mail->isHTML(true);
	$mail->Subject = "Email Template";
	$mail->Body=email_template($username,$check);
	 //
		if($mail->send())
         return 1;
        else
         return 0;
}

function sendTestEmailMethod($data){
	//$this->load->library('email');
    // include($data->filepath);
    require_once($data['filepath']);
	 $to_email = $data['email']; 
	$mail = new PHPMailer(true);
	$mail->IsSMTP();
	$mail->Host = "in-v3.mailjet.com";
	$mail->SMTPAuth = true;
	$mail->Username = '1bba2b0e634f06f9adad202eb080e6c5';
	$mail->Password = '488b6ac179fe18f5e19f475063f9dab4';
	$mail->SetFrom("job@corp2corpreq.com","corp2corpreq ", 0);
	$mail->Port = 80;
	$mail->addAddress($to_email);
	$mail->isHTML(true);
	$mail->Subject = $data['subject'];
	$mail->Body= returnTemplate($data);
	 //
		if($mail->send())
         return 1;
        else
         return 0;
}


function email_template($username,$check){
if($check=="Month Calendar") {
 $first_part="<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <meta name='viewport' content='width=device-width'>
        <!--[if !mso]><!-->
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <!--<![endif]-->
        <title></title>
        <!--[if !mso]><!-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <!--<![endif]-->
        <style type='text/css'>
            body {
                margin: 0;
                padding: 0;
            }
    
            table,
            td,
            tr {
                vertical-align: top;
                border-collapse: collapse;
            }
    
            * {
                line-height: inherit;
            }
    
            a[x-apple-data-detectors=true] {
                color: inherit !important;
                text-decoration: none !important;
            }
        </style>
        <style type='text/css' id='media-query'>
            @media (max-width: 620px) {
    
                .block-grid,
                .col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important;
                }
    
                .block-grid {
                    width: 100% !important;
                }
    
                .col {
                    width: 100% !important;
                }
    
                .col_cont {
                    margin: 0 auto;
                }
    
                img.fullwidth,
                img.fullwidthOnMobile {
                    max-width: 100% !important;
                }
    
                .no-stack .col {
                    min-width: 0 !important;
                    display: table-cell !important;
                }
    
                .no-stack.two-up .col {
                    width: 50% !important;
                }
    
                .no-stack .col.num2 {
                    width: 16.6% !important;
                }
    
                .no-stack .col.num3 {
                    width: 25% !important;
                }
    
                .no-stack .col.num4 {
                    width: 33% !important;
                }
    
                .no-stack .col.num5 {
                    width: 41.6% !important;
                }
    
                .no-stack .col.num6 {
                    width: 50% !important;
                }
    
                .no-stack .col.num7 {
                    width: 58.3% !important;
                }
    
                .no-stack .col.num8 {
                    width: 66.6% !important;
                }
    
                .no-stack .col.num9 {
                    width: 75% !important;
                }
    
                .no-stack .col.num10 {
                    width: 83.3% !important;
                }
    
                .video-block {
                    max-width: none !important;
                }
    
                .mobile_hide {
                    min-height: 0px;
                    max-height: 0px;
                    max-width: 0px;
                    display: none;
                    overflow: hidden;
                    font-size: 0px;
                }
    
                .desktop_hide {
                    display: block !important;
                    max-height: none !important;
                }
            }
        </style>
    </head>
    <body class='clean-body' style='margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #ffffff;'>
        <!--[if IE]><div class='ie-browser'><![endif]-->
        <table class='nl-container' style='table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;' cellpadding='0' cellspacing='0' role='presentation' width='100%' bgcolor='#ffffff' valign='top'>
            <tbody>
                <tr style='vertical-align: top;' valign='top'>
                    <td style='word-break: break-word; vertical-align: top;' valign='top'>
                        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color:#ffffff'><![endif]-->
                        <div style='background-color:transparent;'>
                            <div class='block-grid ' style='min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;'>
                                <div style='border-collapse: collapse;display: table;width: 100%;background-color:transparent;'>
                                    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px'><tr class='layout-full-width' style='background-color:transparent'><![endif]-->
                                    <!--[if (mso)|(IE)]><td align='center' width='600' style='background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
                                    <div class='col num12' style='min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;'>
                                        <div class='col_cont' style='width:100% !important;'>
                                            <!--[if (!mso)&(!IE)]><!-->
                                            <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;background:#e9e4de'>
                                                <!--<![endif]-->
                                                <div class='img-container center autowidth' align='center' style='padding-right: 0px;padding-left: 0px;'>
                                                    <img src='https://xqn91.mjt.lu/img/xqn91/b/x4ki/jl02.png' alt='' width='100%' />
                                                    
                                                    <div class='main-box' style='background-color:#fff;margin:0px 25px;padding:10px 25px;'>
                                                        
                                                    
                                                        <p style='text-align:left;font-family: 'Poppins';line-height:1.8;font-size:16px;'>Hello BugendaiOhana,</p>
                                                        <p style='text-align:left;font-family: 'Poppins';line-height:1.9;font-size:14px;'>Please find our calendar as attached in the email for the month of November '21. <br><br>
    
    
                                                         </p>
                                                         <br><br>
                                 <a href='#'><img src='https://xqn91.mjt.lu/img/xqn91/b/0qp8/xr6i8.png' alt='' width='100%' alt='' style='border:1px solid #f1f1f1;'/></a><br><br><br><br>
                                                         <h2 style='text-align:left;font-family: great vibes;padding:0px;margin:0px;'>Thanks </h2>
                                                          <p style='text-align:left;font-family: 'Poppins';font-size:14px;padding:0px;margin:0px;'>Team BugendaiTech</p>
                                                          <p style='text-align:left;padding:0px;margin:5px 0px 0px 0px;'><a href='https://bugendaitech.com/' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj1g.png' width='30%'></a></p>
                                                         <br>
                                                    </div>
                                                    <div class='social_box' style='display:block;padding: 35px 35px 10px 35px;'>
                                                        <p style='font-family: 'Poppins';line-height:0;font-size:18px;font-weight:600;text-align:right;margin:0px;position: relative;left: -10px'>
                                                        Follow Us
                                                        </p>
                                                        <p style='text-align:right;'>
                                                        <a href='https://www.linkedin.com/company/bugendaitech/' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj16.png' width='30px' style='margin:0px 3px'></a>
                                                        <a href='https://twitter.com/BugendaiTech' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj1i.png' width='30px' style='margin:0px 3px'></a>
                                                        <a href='https://www.facebook.com/BugendaiTech' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj1j.png' width='30px' style='margin:0px 3px'></a>
                                                        <a href='https://instagram.com/BugendaiTech' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj1k.png' width='30px' style='margin: 0px 3px'></a>
                                                        <a href='https://in.pinterest.com/BugendaiTech/' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj1r.png' width='30px' style='margin:0px 3px'></a>
                                                        <a href='https://www.youtube.com/channel/UC-gLoWK24iQ4VnsyB926pdw' target='_blank'><img src='https://xqn91.mjt.lu/img/xqn91/b/otr/sj18.png' width='30px' style='margin: 0px 3px'></a>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <!--[if (!mso)&(!IE)]><!-->
                                            </div>
                                            <!--<![endif]-->
                                        </div>
                                    </div>
                                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                    <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                </div>
                            </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
            </tbody>
        </table>
        <!--[if (IE)]></div><![endif]-->
    </body>
    </html>";   
}

return ($first_part);  
}

 
?>

 