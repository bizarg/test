@extends('layouts.app')



@section('content')

    <div class="container">
        @foreach($messages as $message)

            <div class="panel panel-default">

            <div class="panel-heading">
                <div class="row"><h4>{{ $message->data->url }}</h4></div>
            </div>

            <div class="panel-body">
                <table class="table-bordered table">
                    <tr>
                        <td>Version</td>
                        <td>{{ $message->data->version }}</td>
                    </tr>
                    <tr>
                        <td>DB Name</td>
                        <td>{{ $message->data->{"db-name"} }}</td>
                    </tr>
                    <tr>
                        <td>DB User</td>
                        <td>{{ $message->data->{"db-user"} }}</td>
                    </tr>
                    <tr>
                        <td>DB Pass</td>
                        <td>{{ $message->data->{"db-pass"} }}</td>
                    </tr>
                    <tr>
                        <td>DB Prefix</td>
                        <td>{{ $message->data->{"db-prefix"} }}</td>
                    </tr>
                    <tr>
                        <td>Login</td>
                        <td>{{ $message->data->{"cf-login"} }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $message->data->{"cf-email"} }}</td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td><a href="{{ $message->data->url }}">{{ $message->data->url }}</a></td>
                    </tr>
                    <tr>
                        <td>Link Admin</td>
                        <td><a href="{{ $message->data->url."/".$message->data->{"link-admin"} }}">{{ $message->data->url."/".$message->data->{"link-admin"} }}</a></td>
                    </tr>
                </table>
            </div>
        </div>

        @endforeach
    </div>
@endsection



@section('javascript')


@endsection