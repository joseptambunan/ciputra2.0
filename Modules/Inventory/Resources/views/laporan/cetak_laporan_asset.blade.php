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
    <h3 class="center-text">LAPORAN PENYUSUTAN AKTIVA TETAP </h3>
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
                <th>Barang</th>
                
                <th>Tanggal Perolehan</th>
                <th>Umur Ekonomis (Tahun)</th>
                <th>Total Nilai Ekonomis (Rp.)</th>
                <th>Nilai Ekonomis (Rp.)</th>
                <th>Total Perolehan (Rp.)</th>
                <th>Nilai Perolehan(Rp.)</th>
                <th>Penyusutan (Rp.)</th>
                <th>Nilai Buku (Rp.)</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $arrRowspan = [];
              foreach ($Assets as $key => $value) {
                # code...
                $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
                $batas_umur_asset = floor($batas_umur/(60*60*24*365));
                $nilai_perkiraan_sisa = $value->price/($batas_umur_asset+3);
                if(isset($arrRowspan[$value->item->name]['count']))
                {
                  $arrRowspan[$value->item->name]['count']+=1;
                  $arrRowspan[$value->item->name]['sub_price_total']+=$value->price;
                  $arrRowspan[$value->item->name]['sub_total_ekonomis']+=$nilai_perkiraan_sisa;
                }else
                {
                  $arrRowspan[$value->item->name]['count']=1;
                  $arrRowspan[$value->item->name]['sub_price_total'] = $value->price;
                  $arrRowspan[$value->item->name]['sub_total_ekonomis']=$nilai_perkiraan_sisa;
                }
                
              }
              $itemname = '';
            ?>
             @foreach ($Assets as $key => $value)
                    <?php
                    $batas_umur =  strtotime($value->asset_age) - strtotime($value->created_at);
            
                    $batas_umur_asset = floor($batas_umur/(60*60*24*365));

                    $nilai_perkiraan_sisa = $value->price/($batas_umur_asset+3);

                    $umur_asset = date('n')-date('n',strtotime($value->created_at)) +1;

                    $nilai_penyusutan = floor($umur_asset/12*(($value->price-$nilai_perkiraan_sisa)/$batas_umur_asset));
                    
                    $nilai_penyusutanPerBulan = $nilai_penyusutan/12;

                    $nilai_penyusutan_final = (12-date('n',strtotime($value->created_at))+1)*$nilai_penyusutanPerBulan;
                    ?>
                    <tr>
                    @if($itemname != $value->item->name)
                      <td rowspan="{{ $arrRowspan[$value->item->name]['count'] }}"><?php echo  $value->item->name;?></td>
                    @endif
                      <td><?php echo date('d-m-Y',strtotime($value->created_at));?></td>
                      <td class="right-text"><?php echo $batas_umur_asset;?></td>
                      @if($itemname != $value->item->name)
                        <td class="right-text" rowspan="{{ $arrRowspan[$value->item->name]['count'] }}">{{ number_format($arrRowspan[$value->item->name]['sub_total_ekonomis'],2,",",".") }}</td>
                      @endif
                      <td class="right-text"><?php echo number_format($nilai_perkiraan_sisa,2,".",",");?></td>
                      @if($itemname != $value->item->name)
                      <td rowspan="{{ $arrRowspan[$value->item->name]['count'] }}" class="right-text">{{ number_format($arrRowspan[$value->item->name]['sub_price_total'],2,",",".") }}</td>
                      <?php
                         $itemname=$value->item->name;
                      ?>
                      @endif
                      <td class="right-text"><?php echo number_format($value->price,2,".",",");?></td>
                      <td class="right-text"><?php echo number_format($nilai_penyusutan,2,".",",");?></td>    
                      <td class="right-text"><?php echo number_format($value->price-$nilai_penyusutan,2,".",",");?></td>         
                    </tr>
                  @endforeach
          </tbody>
      </table>
    </div>
  </body>
</html>