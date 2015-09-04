<!DOCTYPE html>
<html>
<head>
	<title> {{$type}} {{$deck->name}}</title>
</head>
<body>
	<h1>Learn {{$deck->name}}</h1>
	<p>{{$question}}</p>
	<form method="POST" action="/deck/{{$deck->id}}/learn/next">
	    {!! csrf_field() !!}
	    @foreach($answers as $answer)
	    <div>	    	
	        <input type="radio" name="answer" value="{{ $answer }}">
	        {{$answer}}
	    </div>
	    @endforeach
	    <div>
	        <button type="submit">Next</button>
	    </div>
	</form>
</body>
</html>