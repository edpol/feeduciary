@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Contact from Feeduciary.com</span>
        @endcomponent
    @endslot

    To:		{{ $data['email']        }} ({{ $data['email'] }})<br />
    From:   {{ $data['name']         }} ({{ $data['name']  }})<br />
    <br />

    @component('mail:panel', ['url' => 'http:/feeduciary.loc/email/verify?token='{{$data['token']}}])
    	Click here to verify your email address
	@endcomponent

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url').'/contact'])
            [Review your info @ Feeduciary.com](http://{{ $data['server_name'] }}/advisors/{{ $data['id'] }} "Feeduciary.com")
        @endcomponent
    @endslot
@endcomponent