@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header here -->
Contact from a visiting guest.
        @endcomponent
    @endslot

    {{-- Body --}}
    <!-- Body here -->
{{ $data['content']     }}<br />
<br />
{{ $data['name']   }}<br />
Phone:   {{ $data['phone']       }}<br />
Email:   {{ $data['fromEmail']   }}<br />

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            <!-- subcopy here -->
            This is the contact page from Feduciary.com 
        @endcomponent
    @endslot


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
footer
        @endcomponent
    @endslot
@endcomponent