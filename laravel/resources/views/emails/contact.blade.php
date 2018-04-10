@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Contact from a guest</span>
        @endcomponent
    @endslot

    {{ $data['content']     }}<br />
    <br />
    {{ $data['name']   }}<br />
    Phone:   {{ $data['phone']       }}<br />
    Email:   {{ $data['fromEmail']   }}<br />

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => 'http://feeduciary.com/contact'])
            [Feeduciary/contact](http://feeduciary.com/contact "Contact Us Page")
        @endcomponent
    @endslot
@endcomponent