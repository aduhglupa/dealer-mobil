<html>
<head>
    <title>Login</title>

    {!! Html::style('plugins/bootstrap/css/bootstrap.min.css') !!}

    {!! Html::script('plugins/jquery/jquery.min.js') !!}
    {!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}
</head>
<body>
<div class="container">
    <div class="row">
        @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp
        {!! Form::open(['url' => 'login']) !!}
        <div class="col-sm-4 col-sm-offset-4 well">
            <div class="col-sm-12">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    <span class="help-block">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    <span class="help-block">
                        {{ $errors->has('password') ? $errors->first('password') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-sm-12">
                Don't have account? Register {!! link_to('register', 'here') !!}
            </div>
            <div class="col-sm-12">
                {!! Form::submit('Login', ['class' => 'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>