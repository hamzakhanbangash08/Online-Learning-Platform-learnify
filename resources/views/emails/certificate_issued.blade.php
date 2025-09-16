@component('mail::message')
# Congratulations {{ $user->name }}!

You have successfully passed **{{ $quiz->title ?? 'the quiz' }}**.

You can download your certificate from the attachment or by clicking the button below.

<a href="{{ asset($certificate->file_path) }}" 
   download="certificate.pdf"
   class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
   ⬇️ Download Certificate
</a>



<p>{!! nl2br(e(setting('email_signature', "Best regards,\n".config('app.name')))) !!}</p>
@endcomponent
