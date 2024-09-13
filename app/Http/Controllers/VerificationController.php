<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Otp;

class VerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function sendVerificationEmail(Request $request)
    {
        /* Generate OTP */
        $otp = $this->otp->generate($request->email, 'numeric', 6, 10);

        $data = [$request->email, $request->no_hp];

        $email = $request->email;
        $newotp = $otp->token;
        $message = $otp->message;

        /* Prepare email content */
        $emailData = [
            'email' => $request->email,
            'title' => 'Your Email Verification',
            'otp' => $otp->token,
        ];

        try {
            // Send email using Mail::send with a Mailable class (recommended)
            Mail::send('mailVerification', ['data' => $emailData], function ($message) use ($emailData) {
                $message->to($emailData['email'])->subject($emailData['title']);
            });

            // return view('imm.kodeotp', compact('email', 'newotp', 'message'));
            // return redirect()->route('imm.kodeotp')->with('success', 'Project created successfully');
            // return view('imm.kodeotp', compact('posts', 'tags', 'categories','backendUrl'));
            return response([
                'email' => $emailData['email'],
                'success' => $otp->status,
                'message' => $otp->message,
                'token' => $otp->token,
                'email_sent' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response([
                'email' => $request->email,
                'success' => false,
                'message' => 'Failed to send OTP via email: ' . $e->getMessage(),
                'token' => null,
                'email_sent' => false,
            ]);
        }
    }

    public function showVerificationForm(Request $request)
    {
        $email = session('email');
        return view('imm3', compact('email'));
    }

    public function verifyCode(Request $request)
    {
        $email = $request->email;
        $otpCode = $request->otp_code;

        // Validate email and OTP code (optional)
        // You can add validation rules here to ensure email is valid format and OTP code has a certain length, etc.

        $verified = $this->otp->validate($email, $otpCode);


        if (!$verified->status) {
            // OTP is invalid, handle failed verification
            return response([
                'success' => false,
                'message' => 'Kode OTP salah. Silakan coba lagi.',
            ]);
        } else {
            // OTP is valid, process successful verification logic
            return response([
                'success' => true,
                'message' => 'OTP verification successful!',
                'email'=> $email,
                'otp'=> $otpCode,
            ]);
        }
    }

    public function showOtpVerification(Request $request)
    {
        $email = $request->query('email');
        $telepon = $request->query('telepon');
        return view('imm.kodeotp', compact('email', 'telepon'));
    }
}