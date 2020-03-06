@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" class="w-50 mr-auto ml-auto mt-5">
            @csrf
            <div class="form-group">
                <label>Type below your room name</label>
                <input type="text" name="name" class="form-control" placeholder="Room name">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
