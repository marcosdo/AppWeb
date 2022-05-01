<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>

    
</head>

<body>
<aside>
    Banner de anuncios.
    <div id="actua">
     
    </div>
</aside>


<script src = "//code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  function actualizar(){$('#actua').load('anuncioAleatorio.php');}
   //Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",1000);
</script>
</body>
</html>