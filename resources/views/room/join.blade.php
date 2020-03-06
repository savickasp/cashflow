@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" class="w-50 mr-auto ml-auto mt-5">
            @csrf
            <div class="form-group">
                <label>To join you need to ask room admin for code</label>
                <input type="text" name="invite_code" class="form-control" placeholder="room join code" value="{{ $fillable['invite_code'] ?? ''}}">
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

