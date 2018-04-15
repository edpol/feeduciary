@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Thank you for registering with Feeduciary.com</span>
        @endcomponent
    @endslot

	Name:    {{ $data['name']        }}<br />
{{ $user->name }} {{ $user->id }}

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => 'http://feeduciary.com/contact'])
            [Review your info @ Feeduciary.com](http://{{ $data['server_name'] }}/advisors/{{ $data['id'] }} "Feeduciary.com")
        @endcomponent
    @endslot
@endcomponent
