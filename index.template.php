<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 * @create dhayzon 
 * @version 2.0
 */

//colocar la funcion php antes del cierre de php  
function chat_win(){

	global $scripturl, $memberContext,$txt, $settings,$context;

loadMemberData($context['user']['id']);
loadMemberContext($context['user']['id']);

if (!empty($memberContext[$context['user']['id']]['avatar']['href']))
$avatar = $memberContext[$context['user']['id']]['avatar']['href'];
else
 $avatar =   $settings['images_url'].'/theme/default.png';


if (!empty( $context['user']['id']) && !empty( $context['user']['name'])){
$userId = $context['user']['id'];
$userName = $context['user']['name'];}
else{
$userName =  $txt['guest_title'];}


$data = array(
  'id' => $userId,
  'name' => $userName,
  'avatar' =>   $avatar,
  'expiration' => round(microtime(true) * 1000) + 60*60*1000 // in millisecond
);

$data = json_encode($data);

$blocksize = 16;

$secret = $settings['chat_secret'];
$md5 = md5($secret);

// Strictly maintains the length of key and iv
$key = substr($md5, 0, 16);
$iv = substr($md5, 16, 16);

// We need to pad the input manually to match with the server-side's padding scheme
$pad = $blocksize - (strlen($data) % $blocksize);
$data = $data . str_repeat(chr($pad), $pad);

$encryptedSession = bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv));

echo'<div class="block_fm">
<div class="block_content_fm centertext">
<!-- Begin chatwing.com chatbox -->
	<iframe src="http://chatwing.com/dhayzon?custom_session='.$encryptedSession.'" width="100%" height="370" frameborder="0" scrolling="0">Please contact us at info@chatwing.com if you cant embed the chatbox</iframe>
	<!-- End chatwing.com chatbox -->
	</div></div>';

}
