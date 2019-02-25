@extends('index')
@section('content')
<?php 
    $setting = Cache::get('setting');
    $banner = DB::table('slider')->where('com','home')->get();
?>


@endsection
