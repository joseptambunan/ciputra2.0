<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Qr Code</title>
    <style type="text/css">
    	.center-text{
			text-align:center;
		}
    </style>
  </head>
  <body>
  	<h4 class="center-text"></h4>
    <br/>
    
    @foreach (json_decode($informations) as $key => $value)
        <div style="width:200px; height:200px; text-align:center; display:inline-block; margin:0 0px 0px 0;">
          <img src="data:image/png;base64, 
            {!! base64_encode(QrCode::errorCorrection('L')->format('png')->size(75)->
            generate(json_encode($value))) !!}" />
            <br/>
            <small>{{ $value->description }}</small>
        </div>
        @if(($key+1) % 3 == 0 )
          <br/>
        @endif
    @endforeach
   <script type="text/javascript"> //try { this.print(); } catch (e) { window.onload = window.print; } </script>
  </body>
</html>