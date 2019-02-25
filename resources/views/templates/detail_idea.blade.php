@extends('index')
@section('content')
@if($data->background !='')
<div class="banner_idea">
	<img src="{{asset('upload/news/'.$data->background)}}">
</div>
@endif
<div class="content_detail_idea">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-12 left">
				<h1 class="name_idea">{{$data->name}}</h1>
				<p class="date-create">{{date('d/m/Y', strtotime($data->created_at))}}</p>
				<div class="detail_content_post_idea">
					{!! $data->content !!}
				</div>
			</div>
			<div class="col-md-3 col-xs-12">
				@foreach($hot_news as $hot)
				<div class="media">
					<a class="pull-left" href="{{url('y-tuong/'.$hot->alias.'.html')}}">
						<img class="media-object" src="{{asset('upload/news/'.$hot->photo)}}" width="60" height="60" alt="Image">
					</a>
					<div class="media-body">
						<h4 class="media-heading"><a href="{{url('y-tuong/'.$hot->alias.'.html')}}" title="{{$hot->name}}">{{$hot->name}}</a></h4>
						<p class="date-create">{{date('d/m/Y', strtotime($hot->created_at))}}</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection