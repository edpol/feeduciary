@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <span style="color:green;">Welcome from Feeduciary.com</span>
        @endcomponent
    @endslot

Thank you for joining for Feeduciary.com!  The only website that connects investors with financial advisors based on annual fees.  <br />
<br />
To use Feeduciary, simply enter the amount of your investable assets and Feeduciary's proprietary Annual Fee Calculator will provide you with hundreds of advisors in your area ranked from lowest to highest annual fee.<br />
<br />
Please visit us regularly as we have new financial advisors joining every day.<br />
<br />
If you have questions or comments about Feeduciary, contact us at info@feeduciary.com<br />
<br />
Thank you,<br />
<br />
Feeduciary.com<br />
<br />
Let the annual fee set you free!

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer', ['url' => config('app.url').'/contact'])
            [Feeduciary.com]({{ env('APP_URL') }})
        @endcomponent
    @endslot
@endcomponent