<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    {!! Html::style(asset('vendor/bootstrap/css/bootstrap.min.css')) !!}
    {!! Html::style(asset('vendor/font-awesome/css/font-awesome.min.css')) !!}
</head>
<body>

<div class="col-md-offset-4 col-md-4 col-md-offset-4" style="padding-top: 30px;">
    @include('errors.error_request')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Login</h2>
        </div>
        {!! Form::open(['url' => '/admin/password/email']) !!}
        <div class="panel-body">
            <div class="form-group">
                <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                    {!! Form::email('email',null,['class' => 'form-control','placeholder' => 'Correo']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary btn-block" type="submit">
                <i class="fa fa-sign-in"></i> Resetear contraseña
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>