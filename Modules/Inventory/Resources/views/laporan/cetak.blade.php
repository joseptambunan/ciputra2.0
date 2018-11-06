<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Posisi Persediaan</title>
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
    
    <h2 class="center-text">MALL CIPUTRA CIBUBUR</h2>
    <h3 class="center-text">DAFTAR POSISI PERSEDIAAN</h3>
    <h5 class="center-text">PT. SINAR BAHANA MULYA
            Gedung Mall Ciputra Cibubur Lt.3
            Jl. Alternatif Cibubur - Cileungsi Km. 4 Jatikarya, Bekasi 17435
            Phone : (021) 845-93193 Fax:(021) 845-93192</h5>

    <table width="100%" align="center" class="tg1">
      <thead>
  
       </thead>
       <div class="panel-body">

        <div class="col-lg-1 col-md-1 col-xs-6">
         
          
        </div><br/><br/><br/>
      </div><div>
       <table width="100%" border="1pt" align="center" class="tg">
        <thead style="background: #3FD5C0;">
          <tr>
            <th>Nama Barang</th>
            <th>Qty Aktual</th>
            <th>Stock Min</th>
            <th>Satuan Besar</th>
            <th>Konvensi</th>
            <th>Satuan Minimal</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($BarangkeluarDetail as $key=>$value)
            <tr>           
              <td class="center-text"><?php echo $value->nama_barang;?></td>
              <td class="center-text"><?php echo $value->qty_Aktual;?></td>
              <td class="center-text"><?php echo $value->stock_min;?></td>
              <td class="center-text"><?php echo $value->nama_satuan;?></td>
              <td class="center-text"><?php echo $value->Satuan_terkecil;?></td>
              <td class="center-text"><?php echo $value->Jumlah_barang;?></td>             
            </tr>
          @endforeach
        </tbody>
     </table>
    </div>
  </body>
</html>