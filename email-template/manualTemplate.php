<?php 

function returnTemplate1($data){
    $add="";
    
    // if($_POSTsalutation)
    $salutation= explode("-", $data['salutation']);
    if(isset($salutation[0])){
        $add= "<p> ".$salutation[0]." ".$data['person_name'] ."</p>";    
    }
    $sign='';
    
    $basepath='https://corp2corpreq.com/';
    // old logo- cropped-Logo1.jpg
   
    return ("
<!DOCTYPE html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='x-apple-disable-message-reformatting'>
    <title>LAIBA Technologies</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body style='margin:0;padding:0;background-color: #F1F1F1;padding-top: 10px;padding-bottom: 10px;font-family: Roboto;'>
    <div style='margin: 0px auto;width: 700px;overflow: hidden;border: 1px solid #000000;background-color: white;'>
        <div style='text-align: center;' >
            <a href='https://laibatechnology.com/' target='_blank'>
            <img width='700' src='".$basepath."images/Corptocorp-logo.png' alt='header-banner' style='width:200px' />
            </a>
        </div>
        <div style='border-bottom: 2px solid #07187a; margin-bottom: 10px;'></div>
         <div style='padding:10px 25px ; '>
        
            ".$add." ".$data['content']." ".$sign."
        </div>
        <div style='border-bottom: 2px solid #07187a; margin-bottom: 10px;'></div>
        <!-- footer  -->
        <div style='display: flex; padding: 10px; align-items: center;justify-content: center; '>
            <div style='width: 50%;'>
                <div style='text-align: center;'>
                    <a style='color: #07187a;font-weight: bold;text-decoration: none;' href='https://corp2corpreq.com' target='_blank'>www.corp2corpreq.com</a>
                </div>
            </div>
            <div style='width: 50%;'>
                <div style='text-align: center;'>
                    <a href='#' target='_blank'>
                        <img width='35' src='".$basepath."images/fb.png' alt='fb' /></a>
                    <a href='' target='_blank'>
                        <img width='35' src='".$basepath."images/insta.png'
                            alt='instagram' /></a>
                    <a href='' target='_blank'>
                        <img width='35' src='".$basepath."images/yt.png' alt='youtube' /></a>
                    <a href='#' target='_blank'>
                        <img width='35' src='".$basepath."images/in.png' alt='linkedin' /></a>
                    <a href='' target='_blank'>
                        <img width='35' src='".$basepath."images/tw.png' alt='twitter' />
                    </a>
                </div>
            </div>
        </div>
        <!-- unsubscribe -->
        <div style='background-color: #ffffff;color: #000000;'>
            <div style='padding:.5rem; font-size: 14px; text-align: center;' >
                Sent by: Corp2Corp 
            </div>
            <div style='padding:.5rem; font-size: 14px; text-align: center;' >
            <a href='#' target='_blank' style='color:#000'>Unsubscribe</a> from receiving marketing and promotion emails
            </div>
            <div style='padding:.5rem; font-size: 14px; text-align: center;' >
            <a href='#' target='_blank' style='color:#000'>Privacy Policy</a> | <a href='' target='_blank'   style='color:#000'>Terms & Conditions</a>
            </div>
        </div>  
    </div>
</body> 
</html>");
}

?>