@extends('layouts.app')

@section('content')
    <slack-resource-index
            :tags="{{$tags}}"
    ></slack-resource-index>
@endsection
