@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-2"><h4>Domains</h4></div>
                    <div class="col-md-2 col-md-offset-7">
                        <a class="btn btn-default" href="/" id="install">Install</a>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <form id="add_domains" class="form-horizontal" action="{{ action('InstallatronController@install') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-md-2 control-label">Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name[]" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">App</label>

                        <div class="col-md-6">
                            <select id="" class="form-control" name="version[]" value="">
                                <option value="1">version 1.0</option>
                                <option value="2">version 2.0</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="button">
                        <div class="col-md-2 col-md-offset-8">
                            <a type="submit" class="btn btn-primary add">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('javascript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {

            var form = $('#form');

            console.log(form);


            $('.add').on('click', function (e) {
                e.preventDefault();

                addFields();
            });

            $('#install').on('click', function(e){
                e.preventDefault();

                $('#add_domains').submit();
            });

            function addFields() {
                $('#button').before('<div class="form-group">\
                    <label class="col-md-2 control-label">Name</label>\
                    <div class="col-md-6">\
                    <input type="text" class="form-control" name="name[]" value="">\
                    </div>\
                    <div class="col-md-2">\
                    </div>\
                    </div>\
                    <div class="form-group">\
                    <label class="col-md-2 control-label">App</label>\
                    <div class="col-md-6">\
                    <select id="" class="form-control" name="version[]" value="">\
                    <option value="1">version 1.0</option>\
                <option value="2">version 2.0</option>\
                </select>\
                </div>\
                <div class="col-md-2">\
                <a class="btn btn-primary remove">\
                <span class="glyphicon glyphicon-minus"></span>\
                </a>\
                </div>\
                </div>\
                    </div>')

                addEventRemove();
            }

            function addEventRemove(){
                $('.remove').on('click', function (e) {
                    e.preventDefault();
                    $(this).parent().parent().remove();
                });
            }
        });
    </script>

@endsection