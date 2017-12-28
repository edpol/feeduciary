@component('mail::message')
# Introduction

Contact from a visiting guest.

@component('mail::button', ['url' => 'http://feeduciary.com'])
Feeduciary.com
@endcomponent
<br />

@component('mail::panel', ['url' => ''])
Panel Text <br />
Name:    {{ $data['name']        }}<br />
Title:   {{ $data['title']       }}<br />
Advisor: {{ $data['advisorName'] }}<br />
From:    {{ $data['fromEmail']   }}<br />
Phone:   {{ $data['phone']       }}<br />
Subject: {{ $data['subject']     }} <br />
Message: {{ $data['content']     }}<br />
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
