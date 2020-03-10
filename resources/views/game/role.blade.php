@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <div class="form-group">
                <label>Choose your Role:</label>
                <select class="form-control" name="role">
                    @foreach($roles as $key => $role)
                        <option value="{{ $key }}">{{ $role }}</option>
                    @endforeach
                </select>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Choose</button>
        </form>
    </div>
@endsection
