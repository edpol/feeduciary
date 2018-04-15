@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Thank you !!</span>
        @endcomponent
    @endslot

	Thank you {{ $user->name }} for registring with Feeduciary.com<br />
	

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => 'http://feeduciary.com/contact'])
            [Review your info @ Feeduciary.com](http://{{ $data['server_name'] }}/advisors/{{ $user->id }} "Feeduciary.com")
        @endcomponent
    @endslot
@endcomponent
