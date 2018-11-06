<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Permintaan Barang</title>
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
  	<h4 class="center-text">PERMINTAAN BARANG</h4>
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
        <tr>
          <td>Nomor</td>
          <td>:</td>
          <td>Tangal</td>
          <td>: </td>
          
        </tr>
        <tr>
          <td>Project</td>
          <td>: </td>
          <td>Department</td>
          <td>: </td>

        </tr>
        <tr>
          <td>Pt</td>
          <td>: </td>
          <td>SPK</td>
          <td>: </td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
        </tr>
      </thead>
    </table>
    <br/>
   
      <table width="100%" border="1pt" align="center" class="tg">
        <thead>
          <tr>
            <th>
              No.
            </th>
            <th>
              Keterangan
            </th>
            <th>
              Konversi
            </th>
            <th>
              Satuan
            </th>
          </tr>
        </thead>
          <tbody>
          <?php $rowspan=1;$tempname=''; ?>
          @for($i = 0; $i < sizeof($arrsatuan); $i++)
          
          <?php
            $item = $arritem[$i];
            print "<tr>";
              if($arrResults[$item]['printed']=='no')
              {
                  ?>
                  <td class="center-text" rowspan="{{ $arrResults[$item]['rowspan'] }}">{{ $i+1 }}</td>
                  <td class="center-text" rowspan="{{ $arrResults[$item]['rowspan'] }}">{{ $item }}</td>
                  <?php
                  $arrResults[$item]['printed'] = 'yes';
              }
              ?>
              <td class="center-text">{{ $arrkonversi[$i] }}</td>
              <td class="center-text">{{ $arrsatuan[$i] }}</td>
            </tr>
          @endfor
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
          <th><h1>&nbsp;</h1></th>
          <th><h1>&nbsp;</h1></th>
        </tr>
      </thead>
    </table>
  </body>
</html>