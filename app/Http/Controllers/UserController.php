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
        if ($user->delete()) {
            User::query()->where(['id' => $user->id])->delete();
        }


        return redirect()->back()->with('success', 'Пользователь успешно удалена');
    }

    public function sendEmail()
    {
        if (isset($_POST) && !empty($_POST)) {
            if (!empty($_FILES['attachment']['name'])) {
                $uploaddir = '/uploads';
                $filename = $_FILES['attachment']['name'];
                $path = $_FILES['attachment']['name'];
                $file = $uploaddir .'/'. $filename;


                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $filename;

                if(move_uploaded_file($uploaddir, $dest_path))
                {
                    echo 'File is successfully uploaded.';
                }
                else
                {
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                $mailto = 'pelivan96e@gmail.com';
                $subject = 'Request from renter';
                $message = 'Message from renter';

                $content = file_get_contents($dest_path);
                $content = chunk_split(base64_encode($content));

                // a random hash will be necessary to send mixed content
                $separator = md5(time());

                // carriage return type (RFC)
                $eol = "\r\n";

                // main header (multipart mandatory)
                $headers = "From: name <pelivan96e@gmail.com>" . $eol;
                $headers .= "MIME-Version: 1.0" . $eol;
                $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
                $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
                $headers .= "This is a MIME encoded message." . $eol;

                // message
                $body = "--" . $separator . $eol;
                $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
                $body .= "Content-Transfer-Encoding: 8bit" . $eol;
                $body .= $message . $eol;

                // attachment
                $body .= "--" . $separator . $eol;
                $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
                $body .= "Content-Transfer-Encoding: base64" . $eol;
                $body .= "Content-Disposition: attachment" . $eol;
                $body .= $content . $eol;
                $body .= "--" . $separator . "--";

                //SEND Mail
                if (mail($mailto, $subject, $body, $headers)) {
                    echo "mail send ... OK"; // or use booleans here
                } else {
                    echo "mail send ... ERROR!";
                    print_r( error_get_last() );
                }
            } else {
                echo "no file posted";
            }
        }
    }

}