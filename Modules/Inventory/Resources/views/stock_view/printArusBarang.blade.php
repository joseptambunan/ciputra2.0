<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Arus Barang</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
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
     <h3 class="center-text">LAPORAN ARUS BARANG</h3>
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

   
    <h3 align="center"> {{ $projectname }}</h3>
    <h4 align="center">Per {{ date('d F Y',strtotime(now())) }}</h4>

    <table class="table table-striped">
    <thead style="background-color: #3FD5C0;">
      <tr>
        <th>Item</th>
        <th>Stock Masuk</th>
        <th>Stock Keluar</th>
        <th>Stock Aktual</th>
        <th>Satuan</th>
      </tr>
    </thead>
  <tbody>
    @foreach($query as $key => $value)
    <tr>
      <td>{{ $value->item_name }}</td>
      <td class="right-text">{{ number_format($value->total_masuk,2,",",".") }}</td>
      <td class="right-text">{{ number_format($value->total_keluar,2,",",".") }}</td>
      <td class="right-text">{{ number_format($value->saldo,2,",",".") }}</td>
      <td>{{ $value->name_satuan }}</td>
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
