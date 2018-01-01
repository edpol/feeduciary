@component('mail::message')
# Message

Contact from a visiting guest.

@component('mail::button', ['url' => 'http://feeduciary.com'])
Feeduciary.com
@endcomponent
<br />

@component('mail::panel', ['url' => 'http://feeduciary.com'])
{{ $data['content']     }}<br />
<br />
{{ $data['name']   }}<br />
Phone:   {{ $data['phone']       }}<br />
Email:    {{ $data['fromEmail']   }}<br />
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
