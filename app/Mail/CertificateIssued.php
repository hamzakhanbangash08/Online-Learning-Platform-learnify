<?php

namespace App\Mail;

use App\Models\Certificate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificateIssued extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Certificate $certificate;

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    // public function build()
    // {
    //     $quizTitle = $this->certificate->quiz->title ?? 'Your Certificate';
    //     $filename  = basename($this->certificate->file_path);

    //     // attach from public disk
    //     $fullPath = storage_path('app/public/' . $this->certificate->file_path);

    //     $mail = $this->subject("Your certificate — {$quizTitle}")
    //                  ->markdown('emails.certificate_issued')
    //                  ->with([
    //                     'user' => $this->certificate->user,
    //                     'quiz' => $this->certificate->quiz,
    //                     'certificate' => $this->certificate,
    //                  ]);

    //     if (file_exists($fullPath)) {
    //         // attach actual PDF file
    //         $mail->attach($fullPath, [
    //             'as'   => $filename,
    //             'mime' => 'application/pdf'
    //         ]);
    //     }

    //     return $mail;
    // }


    // 
  public function build()
{
    $quizTitle = $this->certificate->quiz->title ?? 'Your Certificate';
    $filename  = basename($this->certificate->file_path);

    // certificates folder directly public ke andar hai
    $fullPath = public_path('certificates/' . $filename);

    $mail = $this->from(
                setting('from_email', config('mail.from.address')),
                setting('from_name', config('mail.from.name'))
            )
            ->subject("Your certificate — {$quizTitle}")
            ->markdown('emails.certificate_issued')
            ->with([
                'user'        => $this->certificate->user,
                'quiz'        => $this->certificate->quiz,
                'certificate' => $this->certificate,
                'signature'   => setting('email_signature', "Best regards,\n".config('app.name')),
            ]);

    if (file_exists($fullPath)) {
        $mail->attach($fullPath, [
            'as'   => $filename,
            'mime' => 'application/pdf',
        ]);
    }

    return $mail;
}

}
