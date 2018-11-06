<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Penyusutan Asset</title>
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
    
    <h2 class="center-text">{{ $projectname }}</h2>
    <h3 class="center-text">LAPORAN POSISI ASSET </h3>
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
                <th>DEPATEMEN</th>
                <th>BARANG</th>
                <th>UMUR EKONOMIS (Tahun)</th>
                <th>DESKRIPSI</th>
            </tr>
          </thead>
          <tbody>
            <?php
              sort($result);
              $arrRowspan = [];
              foreach ($result as $key => $value) {
                # code...
                if(isset($arrRowspan[$value['department']]['count']))
                {
                  $arrRowspan[$value['department']]['count']+=1;
                  
                }else
                {
                  $arrRowspan[$value['department']]['count']=1;
                 
                }
              }
              $departmen_name = '';
            ?>

            @foreach ($result as $key => $value)
              <tr>
              @if($departmen_name != $value['department'])
                <td rowspan="{{ $arrRowspan[$value['department']]['count'] }}"><?php echo  $value['department'];$departmen_name=$value['department'];?></td>
              @endif
                <td><?php echo $value['item_name'];?></td>
                <td class="right-text"><?php echo $value['umur_ekonomis'];?></td>
                <td>{{ $value['description'] }}</td>      
              </tr>
            @endforeach
             
          </tbody>
      </table>
    </div>
  </body>
</html>