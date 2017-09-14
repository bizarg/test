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

                    <div class="form-install">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="install[names][]" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">App</label>

                            <div class="col-md-6">
                                <select id="" class="form-control" name="install[versions][]" value="">
                                    <option value="newword">newword</option>
                                    <option value="wordpress">wordpress</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <a class="btn btn-primary remove">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>
                            </div>
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
                addEventRemove();
            });

            $('#install').on('click', function(e){
                e.preventDefault();

                $('#add_domains').submit();
            });

            function addFields() {
                $('#button').before('<div class="form-install">\
                <div class="form-group">\
                    <label class="col-md-2 control-label">Name</label>\
                    <div class="col-md-6">\
                    <input type="text" class="form-control" name="install[names][]" value="">\
                    </div>\
                    <div class="col-md-2">\
                    </div>\
                    </div>\
                    <div class="form-group">\
                    <label class="col-md-2 control-label">App</label>\
                    <div class="col-md-6">\
                    <select id="" class="form-control" name="install[versions][]" value="">\
                    <option value="newword">newword</option>\
                <option value="wordpress">wordpress</option>\
                </select>\
                </div>\
                <div class="col-md-2">\
                <a class="btn btn-primary remove">\
                <span class="glyphicon glyphicon-minus"></span>\
                </a>\
                </div>\
                </div>\
                </div>\
                    </div>')
            }

            function addEventRemove(){
                $('.remove').on('click', function (e) {
                    e.preventDefault();
//                    $(this).parent().parent().remove();
                    $(this).closest(".form-install").remove();
//                    console.log($(this).closest(".form-install"));
                });
            }
        });
    </script>

@endsection