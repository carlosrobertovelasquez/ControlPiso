<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h2>Hola {{$name}} ,Bienvenido a Control de Piso</h2>
	<p>Por favor Confirmar tu correo electronico</p>
	<p>Para ello simplemente debes hacer click en el siguiente enlace:</p>
	<a href="{{url('/verify/'.$confirmation_code)}}">
	Click para confirmar correo electronico
</body>
</html>