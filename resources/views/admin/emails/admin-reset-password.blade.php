@component('mail::message')
# Reset Password
Welecom {{$data['data']->name}} <br>
The body of your message.

@component('mail::button', ['url' => admin_url('reset-password/'.$data['token'])])
Reset password
@endcomponent
Or <br>
copy this link<br>
<a href="{{admin_url('reset-password/'.$data['token'])}}">{{admin_url('reset-password/'.$data['token'])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
