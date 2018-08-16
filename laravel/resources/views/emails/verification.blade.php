@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Contact from Feeduciary.com</span>
        @endcomponent
    @endslot

    To:		{{ $data['name']  }} ({{ $data['email'] }})<br />
    <br />
        Hello {{ $data['name']   }}, <br />
        to access Feeduciary's free fee-based advisor search features<br />
        <a href="{{ env('APP_URL') }}/signup/verify/{{$data['token']}}">
        click here to verify your email address</a>.
    <br />
    <br />
        If the email does not arrive, please remember to check your spam folder for the email.
    <br />
    <br />
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url').'/contact'])
            [Feeduciary.com]({{ env('APP_URL') }})
        @endcomponent
    @endslot
@endcomponent