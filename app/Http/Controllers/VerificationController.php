<?php
namespace App\Http\Controllers;

use Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Pastikan Anda mengimpor model User

class VerificationController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    // Mengirimkan OTP ke email
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
                'email_sent' => true,
            ]);
        } catch (\Exception $e) {
            Log::error("Failed to send OTP: " . $e->getMessage());

            return response()->json([
                'email' => $request->email,
                'success' => false,
                'message' => 'Failed to send OTP via email: ' . $e->getMessage(),
                'email_sent' => false,
            ]);
        }
    }

    // Verifikasi kode OTP yang dimasukkan user
    public function verifyCode(Request $request)
    {
        $email = $request->email;
        $otpCode = $request->otp_code;

        // Validasi OTP menggunakan library OTP
        $verified = $this->otp->validate($email, $otpCode);

        if (!$verified->status) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah. Silakan coba lagi.',
            ]);
        }

        // OTP valid, cari user berdasarkan email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.',
            ]);
        }

        // Return role dari user untuk redirect ke halaman yang sesuai
        return response()->json([
            'success' => true,
            'message' => 'OTP verification successful!',
            'role' => $user->role, // Kirim role ke frontend untuk melakukan redirect
        ]);
    }

    // Menampilkan halaman form OTP
    public function showOtpVerification(Request $request)
    {
        $email = $request->query('email');
        $telepon = $request->query('telepon');
        return view('imm.kodeotp', compact('email', 'telepon'));
    }
}
