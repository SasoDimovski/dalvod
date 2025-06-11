<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ url('app_admin/css/login/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('app_admin/css/login/style.css')}}">
    <script type="text/javascript" src="{{url('app_admin/js/login/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('app_admin/js/login/bootstrap.min.js')}}"></script>
</head>

<body>
    <div>
        <p>{!! __('users.mail-registration.hi')!!} <strong>{!!$name!!} {!!$surname!!}</strong>,<p>
        {!!__('users.mail-registration.made')!!} <strong>{!!__('global.title')!!}</strong><br>
         {!!__('users.mail-registration.username')!!} <strong>{!!$username!!}</strong><br>
         {!!__('users.mail-registration.link')!!} <a href="{!!$url!!}">{!!$url!!}</a><p>
        <p> {!!__('users.mail-registration.note')!!}<br>
        {!!__('users.mail-registration.expire',['name'=>config('config.registration_link_valid')])!!}<p>
         <p>{!!__('users.mail-registration.link_app')!!}: <a href="{!!__('global.url')!!}">{!!__('global.url')!!}</a></p>
        <p>{!!__('users.mail-registration.regards')!!}<br><strong>{!!__('global.title')!!}</strong></p>

    </div>
</body>

</html>
