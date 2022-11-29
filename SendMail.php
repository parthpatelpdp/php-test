<?php
header('Content-type: application/json');
if($_SERVER['HTTP_REFERER'] !== $_SERVER['HTTP_X_FORWARDED_PROTO'].'://parthpatelpdp.000webhostapp.com/'){die('{"ok":false,"error":"unauthorized access"}');}
$url = ("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$parts = parse_url($url);
parse_str($parts['query'], $query);
$name = $query['name'];
$mail = $query['mail'];
$msg = $query['msg'];
$MYmail = "www.parthpatelpdp@gmail.com";

if ($name == "") {die('{"ok":false,"error":"name is not defined"}'); }
if ($mail == "") {die('{"ok":false,"error":"mail is not defined"}'); }
if ($msg == "") {die('{"ok":false,"error":"msg is not defined"}'); }

    $headers = 'From: Customer Enquiry - parthpatelpdp <customer@parthpatelpdp.000webhostapp.com>' . "\r\n" . 
               'MIME-Version: 1.0' . "\r\n" .
               'Content-Type: text/html; charset=utf-8';
    $subject = 'Customer Enquiry - parthpatelpdp';
    $MainBody = '<html>
          <table align="center" width="100%" border="0" cellspacing="10" cellpadding="10" style="border:2px solid #000;border-radius:20px;padding:5px;font-size:20px;">
            <tbody>
            <tr>
            <th colspan="2" style="border: 1px solid #000;border-radius: 100px;font-size: 22px;color: #000;padding:5px;">Customer Enquiry</th>
            </tr>
            <tr>
                <th style="border:1px solid #000;font-size: 20px;color: #000;padding:5px;">Name</th>
                <td style="border:1px solid #000;font-size: 20px;color: #000;padding:5px;">'. $name .'</td>
            </tr>
            <tr>
                <th style="border:1px solid #000;font-size: 20px;color: #000;padding:5px;">Email ID</th>
                <td style="border:1px solid #000;font-size: 20px;color: #000;padding:5px;"><a href="mailto:'. $mail .'" style="color:#000;">'. $mail .'</a></td>
            </tr>
            <tr>
                <th style="border:1px solid #000;font-size:20px;color:#000;vertical-align: top;padding:5px;">Message</th>
                <td style="border:1px solid #000;font-size: 20px;color: #000;padding:5px;"><pre style="margin: 0;font-family: arial, sans-serif;">'. $msg .'</pre></td>
            </tr>
            </tbody>
            </table>
    </html>';
    
    $result = mail($MYmail, $subject, $MainBody, $headers);
    die('{"ok":true,"response":"' . $result . '"}');

?>