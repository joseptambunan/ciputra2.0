<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Stok Minimum</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
    .tgfooter  {
        border-collapse:collapse;
        border-spacing:10px;
        border-color:#ccc;
        width: 100%;
        /*font-weight: bold;*/
       }
    .tg1  {  border-collapse:collapse;
        border-spacing:0;
        border-color:#ccc;
        width: 100%;
        /*font-weight: bold;*/
       }

       .tg  {  border-collapse:collapse;
        border-spacing:10px;
        border-color:#ccc;
        width: 100%;
       }
       th{
        text-align:center;
       }
    	.center-text{
			text-align:center;
		}
    .right-text{
      text-align: right;
    }
    </style>
  </head>
  <body>
  	<h4 class="center-text">LAPORAN STOK MINIMUM</h4>
    <table width="100%" align="center" class="tg1">
      <thead>
        <tr>
          <td>
            <img src="images/logo-ciputra_original_text.png" alt="logo" class="logo-default" style='height:57%' />
          </td>
          <td>
            <small>PT. SINAR BAHANA MULYA
            Gedung Mall Ciputra Cibubur Lt.3
            Jl. Alternatif Cibubur - Cileungsi Km. 4 Jatikarya, Bekasi 17435
            Phone : (021) 845-93193 Fax:(021) 845-93192</small>
          </td>
        </tr>
      </thead>
    </table>
    <br/>
    <h3 align="center">{{ $projectname }}</h3>
    <table class="table table-striped">
  
    <thead style="background-color: #3FD5C0;">
      <tr>
        <th>No</th>
        <th>Item</th>
        <th>Qty Aktual</th>
        <th>Satuan Besar</th>
        <th>Stok Min.</th>
        <th>Satuan Kecil</th>
        <th>Konversi</th>
      </tr>
    </thead>
  <tbody>
    @foreach($stocks as $key => $value)
    <tr>
      <td>{{ $key+1 }}</td>
      <td>{{ $value->item_name }}</td>
      <td class="right-text">{{ $value->total_stock }}</td>
      <td>{{ $value->satuan_name }}</td>
      <td class="right-text">{{ $value->stock_min }}</td>
      <td>{{ $value->name_satuan }}</td>
      <td class="right-text">{{ $value->konversi }}</td>
      
    </tr>
    @endforeach   
  </tbody>
</table>

    <br/>
      <table width="100%" align="center" class="tgfooter" border="1pt">
      <thead>
        <tr>
            <th>Given By</th>
            <th>Received By</th>
          </tr>
         <tr>
          <th><h1>&nbsp;</h1>{{ Auth::user()->user_name }}</th>
          <th><h1>&nbsp;</h1></th>
        </tr>
      </thead>
    </table>

  
  </body>
</html>
