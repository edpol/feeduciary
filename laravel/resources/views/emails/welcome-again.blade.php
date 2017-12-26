@component('mail::message')
# Introduction

Thank you for registering with us!



@component('mail::button', ['url' => 'http://feeduciary.com'])
Feeduciary.com
@endcomponent
<br />

@component('mail::panel', ['url' => ''])
Panel Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
