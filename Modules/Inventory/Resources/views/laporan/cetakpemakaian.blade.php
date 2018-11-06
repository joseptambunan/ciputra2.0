<!DOCTYPE html>
  <html lang="EN">
    <head>
      <title>Laporan</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
      <h4 style="text-align:center;"><strong>PEMAKAIAN BARANG</strong></h4>
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
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Barang</th>
          <th>Sumber</th>
          <th>Tujuan</th>
          <th>Total</th>
          <th>Satuan</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          sort($result);
          $arrRowspan = [];
          foreach ($result as $key => $value) {
            # code...
            if(isset($arrRowspan[$value['peruntukan']]['count']))
            {
              $arrRowspan[$value['peruntukan']]['count']+=1;
            }else
            {
              $arrRowspan[$value['peruntukan']]['count']=1;
            }
          }

          $peruntukan = '';

        ?>
        @foreach($result as $key => $value)
          <tr>
            @if($peruntukan != $value['peruntukan'])
              <td rowspan="{{ $arrRowspan[$value['peruntukan']]['count'] }}"><?php echo $value['peruntukan']; $peruntukan = $value['peruntukan'];?></td>
            @endif
            <td>{{ $value['nama_barang'] }}</td>
            <td>{{ $value['sumber'] }}</td>
            <td>{{ $value['ditujukan'] }}</td>
            
            <td>{{ $value['total'] }}</td>
            <td>{{ $value['satuan'] }}</td>
            <td>{{ $value['deskripsi'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
</html>