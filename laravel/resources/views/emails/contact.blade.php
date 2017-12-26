@component('Mail::message')
# Introduction

Thank you for registering with us!



@component('Mail::button', ['url' => 'http://feeduciary.com'])
Feeduciary.com
@endcomponent
<br />

@component('Mail::panel', ['url' => ''])
Panel Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
