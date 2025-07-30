@extends('master')

@section('content')

    <link href="{{ asset('assets_dash/css/confirmation.css') }}" rel="stylesheet">
    <section class="verification-section">
        <div class="verification-container">
            <div class="verification-icon">
                <i class="fas fa-home"></i> 
            </div>

            <h1>تم إرسال رابط التحقق</h1>

            {{-- <p>لقد أرسلنا رابط تحقق إلى بريدك الإلكتروني <strong>example@email.com</strong>. يرجى التحقق من صندوق الوارد الخاص بك.</p> --}}
   {{-- <p>لقد أرسلنا رابط تحقق إلى بريدك الإلكتروني {{ $email }}. يرجى التحقق من صندوق الوارد الخاص بك.</p> --}}
      <p>لقد أرسلنا رابط تحقق إلى بريدك الإلكتروني  يرجى التحقق من صندوق الوارد الخاص بك.</p>


      {{-- هناااا مش زابط معي , ولازم احدد هنا الgarde --}}
         <a href="{{ route('client.login') }}">
    <button class="btn-home">
        العودة إلى الصفحة الرئيسية
    </button>
</a>

        </div>
    </section>
@endsection
