<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style>
        div {
            text-align: center
        }
    </style>
</head>
<body>
    
<div class="visible-print text-center">
	<h1> QR Code Kode Barang: {{ $id }} </h1>
     
    {!! QrCode::size(250)->generate($id); !!}
</div>
    
</body>
</html>