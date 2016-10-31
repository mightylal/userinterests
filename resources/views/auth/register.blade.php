@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data" id="registerForm">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" data-validation="required" autofocus>
                                <p id="name-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" data-validation="email">
                                <p id="email-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" data-validation="required" data-validation="number">
                                <p id="phone-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" data-validation="required dimension mime" data-validation-allowing="jpg, png" data-validation-dimension="max800x600">
                                <p id="image-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="interests" class="col-md-4 control-label">Interests</label>

                            <div class="col-md-6">
                                @if (count($interests) > 0)
                                    @foreach ($interests as $interest)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="interests[]" class="interests" value="{{ $interest->id }}" data-validation="checkbox_group" data-validation-qty="1-3"> {{ $interest->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                                <p id="interests-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" data-validation="length" data-validation-length="min6">
                                <p id="password-error" class="text-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-validation="confirmation" data-validation-confirm="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script>
        $(function () {
            $('#phone').mask('(000) 000-0000');

            $.validate({
                modules: 'security, file'
            });
        });
    </script>
    <script src="{{ asset('js/register.js') }}"></script>

@endsection
