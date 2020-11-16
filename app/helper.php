<?php 


function getIdentity(){
	return registerAs()[\Auth::user()->role->role_id];
}

function registerAs(){
	return array(
		'1' => 'Admin', 
		'2' => 'Student', 
	);
}

function options(){
	return array(
		'1' => 'a', 
		'2' => 'b', 
		'3' => 'c', 
		'4' => 'd', 
		'5' => 'e', 
	);
}

function shuffle_assoc($list) {
  if (!is_array($list)) return $list;

  $keys = array_keys($list);
  shuffle($keys);
  $random = array();
  foreach ($keys as $key)
    $random[$key] = $list[$key];

  return $random;
}

function sendExamPaperMail($view,$data)
{
    $from_mail = $data['from_user']->email;
    $to_mail = $data['to_user']->email;
    $subject = $data['subject'];
    $mail=\Mail::send($view, $data, function ($message) use ($to_mail,$subject){
        $message->from('sakib2439@gmail.com', 'Online Exam')
        		->to($to_mail)
          	->subject($subject);
    });
}