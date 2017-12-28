@component('Mail::message')
# Message

Here is a message from one of our guests


@component('Mail::button', ['url' => 'http://feeduciary.com'])
Feeduciary.com
@endcomponent
<br />

@component('Mail::panel', ['url' => ''])
{{ $content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
