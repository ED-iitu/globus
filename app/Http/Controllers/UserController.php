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
                // Recipient
                $to = 'pelivan96e@gmail.com';

// Sender
                $from = 'pelivan96e@gmail.com';
                $fromName = 'Globus-Almaty';

// Email subject
                $subject = 'Request from renter';

// Attachment file
                $file = $_FILES['attachment']['name'];

// Email body content
                $htmlContent = ' 
    <h3>PHP Email with Attachment by CodexWorld</h3> 
    <p>This email is sent from the PHP script with attachment.</p> 
';

// Header for sender info
                $headers = "From: $fromName" . " <" . $from . ">";

// Boundary
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Headers for attachment
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

// Multipart boundary
                $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

// Preparing attachment
                if (!empty($file) > 0) {
                    if (is_file($file)) {
                        $message .= "--{$mime_boundary}\n";
                        $fp = @fopen($file, "rb");
                        $data = @fread($fp, filesize($file));

                        @fclose($fp);
                        $data = chunk_split(base64_encode($data));
                        $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                            "Content-Description: " . basename($file) . "\n" .
                            "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    }
                }
                $message .= "--{$mime_boundary}--";
                $returnpath = "-f" . $from;

// Send email
                $mail = @mail($to, $subject, $message, $headers, $returnpath);

// Email sending status

                if ($mail) {
                    return response([
                        'success' => 'sent successfully',
                    ], 200);
                } else {
                    return response([
                        'error' => 'error',
                    ], 200);
                }
            } else {
                echo "no file posted";
            }
        }
    }

}