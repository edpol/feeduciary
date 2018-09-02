<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '221529688673606'); 
fbq('track', 'PageView');
@if (isset($fb_pixel_search) && $fb_pixel_search)
// first time you pullup search on page 1
	fbq('track', 'Search');
@endif
@if (isset($fb_pixel_view_content) && $fb_pixel_view_content)	
// if you view details of advisor
	fbq('track', 'ViewContent');
@endif
@if (isset($fb_pixel_lead) && $fb_pixel_lead)	
// when you verify your email
	fbq('track', 'Lead');
@endif

</script>
<noscript>
<img height="1" width="1" src="https://www.facebook.com/tr?id=221529688673606&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->