@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Listing</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($users as $user)
                        <li class="list-group-item">
                            <h4 class="list-group-item-heading">{{ $user->name }}</h4>
                            @if (isset($user->image))
                                <img src="{{ asset('storage/' . $user->image->path) }}" class="img-responsive" style="width: 25%;" alt="">
                            @endif
                            @if (isset($user->interests))
                                <ul>
                                    @foreach ($user->interests as $interest)
                                        <li>{{ $interest->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
