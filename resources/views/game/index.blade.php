@extends('layouts.app')

@section('content')
    <div class="container" id="app">
        <game-sheet :user='@json($user)'></game-sheet>
    </div>
@endsection
