@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Contact from Feeduciary.com</span>
        @endcomponent
    @endslot

    To:		{{ $data['advisorName']  }} ({{ $data['advisorEmail'] }})<br />
    From:   {{ $data['name']         }} ({{ $data['guestEmail']   }})<br />
    <br />
		    {{ $data['content']      }}<br />
    <br />
    Phone:  {{ $data['phone']        }}<br />

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => 'http://feeduciary.com/contact'])
            [Review your info @ Feeduciary.com](http://{{ $data['server_name'] }}/advisors/{{ $data['id'] }} "Feeduciary.com")
        @endcomponent
    @endslot
@endcomponent