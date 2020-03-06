@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <input name="string" type="hidden" value="{{ $string }}">
            <div class="form-group">
                <label>Repeat this to confirm delete: <b>{{ $string }}</b></label>
                <input name="string_confirm" type="text" class="form-control" placeholder="confirm delete">
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
            <button type="submit" class="btn btn-danger">delete</button>
        </form>
    </div>
@endsection
