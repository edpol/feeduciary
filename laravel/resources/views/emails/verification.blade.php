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
<a href="{{ $data['server_name'] }}/signup/verify/{{$data['token']}}">
click here to verify your email address
</a>.
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url').'/contact'])
            [Feeduciary.com]({{ $data['server_name'] }})
        @endcomponent
    @endslot
@endcomponent