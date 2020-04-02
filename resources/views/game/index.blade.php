@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <game-sheet :user='@json($user)' :translation='@json($translation)'></game-sheet>
    </div>
@endsection
