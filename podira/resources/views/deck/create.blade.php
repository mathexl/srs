<html>
	<head>
		<title>Create a new course.</title>
	</head>
	<body>
		<h1>Current courses.</h1>
		@if($user->decks)
			@foreach($user->decks as $deck)
			<p>
				{{$deck}}
				<a href="/deck/{{$deck->id}}/learn">Learn</a>
				<a href="/deck/{{$deck->id}}/review">Review</a>
			</p>
			@endforeach
		@endif
		<h1>Create a new course.</h1>
		<form method="POST" action="/deck/store">
		    {!! csrf_field() !!}
		    <div>
		        Name
		        <input type="text" name="name" value="{{ old('name') }}">
		    </div>

		    <div>
		        <button type="submit">Create</button>
		    </div>
		</form>
	</body>
</html>