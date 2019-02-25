@extends('index')
@section('content')
<div class="banner_idea">
	<img src="{{asset('upload/hinhanh/'.$data->photo)}}">
	<h2>{{$data->name}}</h2>
</div>
@endsection