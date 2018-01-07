@component('mail::message')
# Introduction

Thank you for registering with us!



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
Content: {{ $data['content']     }}<br />
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent