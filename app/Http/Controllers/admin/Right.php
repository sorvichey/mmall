<?php

namespace App\Http\Controllers\admin;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use DB;
use Auth;
use PHPMailer\PHPMailer\PHPMailer;
class Right
{
    public static function check($permission_name, $action) {
    	$role_id = Auth::user()->role_id;
    	$q = DB::table('role_permissions')
                ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
                ->select('role_permissions.list','role_permissions.insert','role_permissions.delete','role_permissions.update')
                ->where(['role_permissions'.'.role_id' => $role_id, 'permissions.name' => $permission_name]);

        switch ($action) {
        	case 'i':
        		$q = $q->where('role_permissions.insert', 1);
        		break;
        	case 'u':
        		$q = $q->where('role_permissions.update', 1);
        		break;
        	case 'd':
        		$q = $q->where('role_permissions.delete', 1);
        		break;
    		case 'l':
        		$q = $q->where('role_permissions.list', 1);
        		break;	
        	default:
        		break;
        }
	   
       	return ($q->count() > 0?'1':'0');
    }
    public static function branch($id)
    {
        $arr = array();
        $data = DB::table('user_branches')->where('user_id', $id)->get();
        foreach($data as $b)
        {
            array_push($arr, $b->branch_id);
        }
        return $arr;
    }

    public static function send_email($send_to, $id)
    {
        $a = url('/buyer/service/reset/'.$id);
        if (!filter_var($send_to, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        }
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "gator4170.hostgator.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "service@masterjobscambodia.com";
            $mail->Password = "Khmer@123";
            $mail->setFrom("service@mmall.com", "MMall");
            $mail->Subject = "MMall: Reset Your Password";
            $mail->MsgHTML("<p>Please click the link below to reset your password.</p><p><a href='{$a}'>{$a}</a></p>");
            $mail->addAddress($send_to, $send_to);
            $mail->send();
        } catch (phpmailerException $e) {
//            dd($e);
        } catch (Exception $e) {
//            dd($e);
        }
        return 1;
    }

    public static function send_email_activated($send_to, $id)
    {
        $a = url('/buyer/service/activated/'.$id);
        if (!filter_var($send_to, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        }
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "gator4170.hostgator.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "service@masterjobscambodia.com";
            $mail->Password = "Khmer@123";
            $mail->setFrom("service@mmall.com", "MMall");
            $mail->Subject = "MMall: Please activated your account";
            $mail->MsgHTML("<p>Please click the link below to activated your account.</p><p><a href='{$a}'>{$a}</a></p>");
            $mail->addAddress($send_to, $send_to);
            $mail->send();
        } catch (phpmailerException $e) {
//            dd($e);
        } catch (Exception $e) {
//            dd($e);
        }
        return 1;
    }

    public static function send_email_shop_owner_activated($send_to, $id)
    {
        $a = url('/owner/service/activated/'.$id);
        if (!filter_var($send_to, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        }
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "gator4170.hostgator.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "service@masterjobscambodia.com";
            $mail->Password = "Khmer@123";
            $mail->setFrom("service@mmall.com", "MMall");
            $mail->Subject = "MMall: Please activated your account";
            $mail->MsgHTML("<p>Please click the link below to activated your account.</p><p><a href='{$a}'>{$a}</a></p>");
            $mail->addAddress($send_to, $send_to);
            $mail->send();
        } catch (phpmailerException $e) {
        } catch (Exception $e) {
        }
        return 1;
    }

    public static function send_email_shop_owner_recovery($send_to, $id)
    {
        $a = url('/owner/service/reset/'.$id);
        if (!filter_var($send_to, FILTER_VALIDATE_EMAIL)) 
        {
            return 0;
        }
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "gator4170.hostgator.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "service@masterjobscambodia.com";
            $mail->Password = "Khmer@123";
            $mail->setFrom("service@mmall.com", "MMall");
            $mail->Subject = "MMall: Reset Your Password";
            $mail->MsgHTML("<p>Please click the link below to reset your password.</p><p><a href='{$a}'>{$a}</a></p>");
            $mail->addAddress($send_to, $send_to);
            $mail->send();
        } catch (phpmailerException $e) {
        } catch (Exception $e) {
        }
        return 1;
    }

}