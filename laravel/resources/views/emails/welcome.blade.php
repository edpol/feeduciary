@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Thank you !!</span>
        @endcomponent
    @endslot

	Thank you for registering with feeduciary.com {{ $data['name'] }} {{ $data['email'] }}<br />

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => 'http://feeduciary.com/contact'])
            [Review your info @ Feeduciary.com](http://{{ $data['server_name'] }}/welcome/{{ $data['id'] }} "Feeduciary.com")
        @endcomponent
    @endslot
@endcomponent
