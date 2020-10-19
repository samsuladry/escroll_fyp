<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.container {
  position: relative;
  text-align: center;
  color: white;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}
</style>
</head>
<body>


<div class="container">
  <img src="{{asset('cert.png')}}" alt="Snow" style="width:80%; height: 50%;" >
  <div class="centered">
  	<!-- <img  src="#" height="100" width="100"> -->
  	<h3>By the authority of the Senate it is hereby certified that</h3>
  	<h1 style="margin-top: 1em;">{{$student->name}}</h>
  	<h3>Having fulfilled all the requirements and having passed all the prescribed examinations has been conferred the degree of</h3>

  	<h1 style="margin-top: 1em;">{{$student->field}}</h> <br>
	
  	

  		<div style="float: left;margin-top: 3em;">
  		<img  src="{{ asset("storage/$rector_sign") }}" height="150" width="150">
  		<img  src="{{ asset("storage/$dean_sign") }}" height="150" width="150">

  		</div>
  		
  		<img style="margin-top: 3em; float: right;" src="{{asset('qrcode.png')}}" height="150" width="150">
  	

  </div>
</div>

</body>
</html> 
