<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Barang Masuk Hibah</title>
    <style type="text/css">
    .tgfooter  {
        border-collapse:collapse;
        border-spacing:10px;
        border-color:#ccc;
        width: 100%;
        /*font-weight: bold;*/
       }
    .tg1  {
        border-collapse:collapse;
        border-spacing:0;
        border-color:#ccc;
        width: 100%;
        /*font-weight: bold;*/
       }

       .tg  { 
        border-collapse:collapse;
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
  	<h4 class="center-text">Laporan Barang Masuk Hibah</h4>
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
    <table width="100%" border="1pt" align="center" class="tg">
        <thead style="background-color: #3FD5C0;">
          <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">Nomor</th>
            <th colspan="2" style="text-align:center;">DARI</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">Total</th>
            <th rowspan="2">Masuk</th>
            <th rowspan="2">Retur</th>
          </tr>
          <tr>
            <th class="text-center">Proyek</th>
            <th class="text-center">PT</th>
          </tr>
      </thead>
      <tbody>
        @foreach($arrHearBarangMasuk as $key => $value)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $value['no'] }}</td>
            <td>{{ $value['from_project_name'] }}</td>
            <td>{{ $value['from_pt_name'] }}</td>
            <td>{{ $value['tanggal_hibah'] }}</td>
            <td class="right-text">{{ $value['total'] }}</td>
            <td class="right-text">{{ $value['diisi'] }}</td>
            <td class="right-text">{{ $value['reject'] }}</td>
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
          <th><h1>&nbsp;</h1>
          </th>
          <th>
            <h1>&nbsp;</h1>
            
          </th>
        </tr>
      </thead>
    </table>
  </body>
</html>