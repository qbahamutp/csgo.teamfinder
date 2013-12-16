@extends('layouts.master')
@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="well">
		<a href="{{ action('PostController@create') }}" class="btn btn-primary">Add new Post</a>
			<h2>Filters</h2>
			{{ Form::open() }}
				{{ Form::label('region', 'Region') }}
				{{ Form::select('region', array(
				    'Europe' => array('5' => 'EU / East', '6' => 'EU / Central', '7' => 'EU / North', '8' => 'EU /West'),
				    'North America' => array('1' => 'NA / West', '2' => 'NA / Central', '3' => 'NA / East'),
				    'South America' => array('4' => 'South America'),
				    'Asia' => array('9' => 'Asia'),
				    'Australia' => array('10' => 'Australia')
					), '6',  ['class' => 'form-control']) }}
				{{ Form::label('lookingfor', 'Looking For') }}
				{{ Form::select('lookingfor', array(
				    'Players' => array('5' => '5 v 5', '6' => '3 v 3', '7' => '2 v 2'),
				    'Type' => array('1' => 'Competitive / League', '2' => 'Valve MatchMaking', '3' => 'Mixes / Gathers', '4' => 'Casual / Friends')
					), '6',  ['class' => 'form-control']) }}
				{{ Form::label('skill', 'Skill') }}
				{{ Form::select('skill', array(
					'1' => 'Low', 
					'2' => 'Low / Mid',
					'3' => 'Mid',
					'4' => 'Mid / High',
					'5' => 'High'
					), '2',
					['class' => 'form-control']) }}

			{{ Form::close() }}

		</div>
	</div>

	<div class="col-md-7">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else

		@foreach($posts as $post)
		<div class="col-md-12">
			<div class="well post clearfix">
				<h2><a href="{{ action('UserController@show', [$post->id]) }}">{{ $post->user->username }}</a></h2>
				<div class="well well-sm">
					<img src="{{ $post->user->rank->img }}" class="rank">
				</div>
				<div class=" col-md-6">
					<h4>Looking for</h4>
						<ul>
						@foreach($post->lookingfors as $lookingfor)
							<li>{{$lookingfor->name}}</li>
						@endforeach
						</ul>

				</div>
				<div class="col-md-6">
					<h4>Goal</h4>
						<p>{{ $post->goal }}</p>
					<h4>Contact me</h4>
						<p>{{ $post->contact }}</p>
					
				</div>
				<div class="clearfix">
					<a href="{{ action('PostController@show', [$post->id]) }}" class="btn btn-primary pull-right">Read More...</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-md-2">
		<div class="well">
			<h4>Sponsors</h4>
		</div>
	</div>
	<div class="clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

@stop