<?php
namespace App\Http\Controllers;

use Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function sendVerificationEmail(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'no_hp' => 'required|string',
        ]);

        // Log informasi untuk debugging
        Log::info("Processing OTP for email: " . $request->email . " and phone: " . $request->no_hp);

        try {
            // Generate OTP
            $otp = $this->otp->generate($request->email, 'numeric', 6, 10);
            Log::info("OTP generated: " . $otp->token);

            $email = $request->email;

            // Prepare email content
            $emailData = [
                'email' => $email,
                'title' => 'Your Email Verification',
                'otp' => $otp->token,
            ];

            // Send email
            Mail::send('mailVerification', ['data' => $emailData], function ($message) use ($emailData) {
                $message->to($emailData['email'])->subject($emailData['title']);
            });

            Log::info("OTP sent to email: " . $email);

            return response()->json([
                'email' => $emailData['email'],
                'success' => true,
                'message' => 'OTP has been sent to your email.',
                'token' => $otp->token,
                'email_sent' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("Failed to send OTP: " . $e->getMessage());

            return response()->json([
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