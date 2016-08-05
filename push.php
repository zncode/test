<?php


//手机注册应用返回唯一的deviceToken
$deviceToken = 'a2e506babee9300169498035bdc1525b4974de6dbf72da5757e1e75952ab62d4';
//ck.pem通关密码
$pass = '87DuetDevPush';   
//消息内容
$message = 'A test message!';
//badge我也不知是什么
$badge = 4;
//sound我也不知是什么（或许是推送消息到手机时的提示音）
$sound = 'default';
//建设的通知有效载荷（即通知包含的一些信息）
$body = array();
$body['aps'] = array('alert' => $message);
//把数组数据转换为json数据
$payload = json_encode($body);
echo strlen($payload),"\r\n";
 
//下边的写法就是死写法了，一般不需要修改，
//唯一要修改的就是：ssl://gateway.sandbox.push.apple.com:2195这个是沙盒测试地址，ssl://gateway.push.apple.com:2195正式发布地址
$ctx = stream_context_create();
$pem = dirname(__FILE__) .'/'.'87.pem';
stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);  
stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
$fp = stream_socket_client('tls://gateway.sandbox.push.apple.com:2195',$err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
if (!$fp) {
    print "Failed to connect $err $errstr\n";
    return;
}
else {
   print "Connection OK\n<br/>";
}
// send message
$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
print "Sending message :" . $payload . "\n";  
fwrite($fp, $msg);
fclose($fp);
/*
35 Connection OK 
Sending message :{"aps":{"alert":"A test message!"}} 
*/