@component('mail::message')
# Reminder for your task

This is just test for reminding you for the task

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
