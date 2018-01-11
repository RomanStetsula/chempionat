@extends('base');

@section('content')
    <h3>{{  $player->full_name }}</h3>
    <h5>{{  $player->birth }}</h5>
    <h4>{{  $player->ava }}</h4>
    <h4>{{  $player->height }}</h4>
    <h4>{{  $player->weight }}</h4>
    <h4>{{  $player->position }}</h4>
    <h4>{{  $player->team_id}}</h4>
    <h4>{{  $player->number }}</h4>
@endsection