@extends('app')
@section('content')
<div class="row">
    <div class="col s12 container">
        <div class="panel panel-default">
            <div class="card-panel purple darken-1">
                <h3>User</h3>
            </div>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection