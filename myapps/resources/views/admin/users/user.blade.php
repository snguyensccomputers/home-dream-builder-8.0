@extends('../admin/layouts/default')

@section('header')
    @include('admin/header')
@stop

@section('navbar')
    @include('admin/navbar')
@stop

@section('sidebar')
    @include('admin/sidebar')
@stop

@section('content')

    <section>
    <div class="content-wrapper">

        <div class="content-heading">

            Update User

            <small>Update your account using the form below!</small>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="block-center mt-xl wd-xl">
                    <!-- START panel-->
                    <div class="panel panel-dark panel-flat">
                        <div class="panel-heading text-center">

                        </div>
                        <div class="panel-body">
                            {{ Form::open(['url' => 'admin/user/' . $id . '/update', 'files' => false, 'class' => 'mb-lg', 'autocomplete' => 'off']) }}

                            <div class="form-group has-feedback">
                                {{ Form::label('email', 'Email Address: ', array('class'=>'sr-only')) }}
                                {{ Form::text('email', null, array('placeholder'=>'Email Address', 'class'=>'form-control')) }}
                                <span class="fa fa-envelope form-control-feedback text-muted"></span>
                                {{ $errors->first('email', '<div class=error>:message</div>') }}
                            </div>

                            <div class="form-group has-feedback">
                                {{ Form::label('password', 'Password: ', array('class'=>'sr-only')) }}
                                {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control')) }}
                                <span class="fa fa-lock form-control-feedback text-muted"></span>
                                {{ $errors->first('password', '<div class=error>:message</div>') }}
                            </div>

                            <div>
                                {{ Form::submit('Update User', array('class'=>'btn btn-block btn-primary bg-orange mt-lg')) }}
                            </div>

                            <div class="form-error">{{ $errors->first('login') }}</div>

                            {{ Form::close() }}

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    </section>

@stop

@section('footer')
    @include('admin/footer')
@stop
