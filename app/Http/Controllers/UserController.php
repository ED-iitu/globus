<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 23.05.2021
 * Time: 04:37
 */

namespace App\Http\Controllers;

use App\Facility;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $facilities = Facility::all()->where('lang', '=', 'ru');

        return view('user.create', [
            'facilities' => $facilities
        ]);
    }

    public function store(Request $request)
    {

        $user = new User();

        $user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'facility_id' => $request->facility_id
        ]);

        $user_id = User::select('id')->where('email', $request->email)->first();

        $user->facilities()->attach($request->facility_id, [
            'user_id' => $user_id->id,
            'facility_id' => $request->facility_id
        ]);


        return redirect()->back()->with('success', 'Пользователь успешно добавлен');
    }

    public function destroy(User $user)
    {
        if($user->delete()){
            User::query()->where(['id' => $user->id])->delete();
        }


        return redirect()->back()->with('success', 'Пользователь успешно удалена');
    }

    public function sendEmail()
    {
        if(isset($_POST) && !empty($_POST)) {
            if(!empty($_FILES['attachment']['name'])) {
                $file_name = $_FILES['attachment']['name'];
                $temp_name = $_FILES['attachment']['tmp_name'];
                $file_type = $_FILES['attachment']['type'];

                $base = basename($file_name);

                $extension = substr($base, strlen($base)-4, strlen($base));

                $allowed_extensions = array(".doc", "docx", ".pdf", ".zip", ".png", ".txt");
                //check that this file type is allowed
                if(in_array($extension,$allowed_extensions)) {
                    //mail essentials
                    $from = 'pelivan96e@gmail.com';
                    $to = 'pelivan96e@gmail.com';
                    $subject = 'Заявка от арендатора';
                    $message = '';

                    //things u need
                    $file = $temp_name;
                    $content = chunk_split(base64_encode(file_get_contents($file)));
                    $uid = md5(uniqid(time()));  //unique identifier

                    //standard mail headers
                    $header = "From: ".$from;
                    $header .= "Reply-To: ". 'pelivan96e@gmail.com';
                    $header .= "MIME-Version: 1.0";


                    //declare multiple kinds of email (plain text + attch)
                    $header .="Content-Type: multipart/mixed; boundary=\"".$uid;
                    $header .="This is a multi-part message in MIME format.";

                    //plain txt part

                    $header .= "--".$uid;
                    $header .= "Content-type:text/plain; charset=iso-8859-1";
                    $header .= "Content-Transfer-Encoding: 7bit";
                    $header .= $message;


                    //attch part
                    $header .= "--".$uid;
                    $header .= "Content-Type: ".$file_type."; name=\"".$file_name;
                    $header .= "Content-Transfer-Encoding: base64";
                    $header .= "Content-Disposition: attachment; filename=\"".$file_name;
                    $header .= $content;  //chucked up 64 encoded attch


                    //sending the mail - message is not here, but in the header in a multi part

                    if(mail($to, $subject, $message, $header)) {
                        return response([
                            'success' => 'Успешно отправлено',
                        ], 200);

                    }else {
                        return response([
                            'fail' => error_get_last()['message'],
                        ], 200);
                    }
                }else {
                    echo "file type not allowed"; }    //echo an html file
            }else {
                echo "no file posted";
            }
        }
    }

}