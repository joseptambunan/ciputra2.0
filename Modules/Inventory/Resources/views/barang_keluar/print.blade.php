<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Barang Keluar</title>
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
  	<h4 class="center-text">BARANG KELUAR</h4>
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
          <td>Tanggal</td>
          <td>: {{ date('d/m/Y',strtotime($barangkeluar->date)) }}</td>
        </tr>
        <tr>
          <td>Nomor</td>
          <td>: {{ $barangkeluar->no }}</td>
        </tr>
        <tr>
          <td>Permintaan Barang</td>
          <td>: {{ $barangkeluar->permintaanbarang->no or 'Kosong' }}</td>
        </tr>
        <tr>
          <td>Department</td>
          <td>: {{ $barangkeluar->permintaanbarang->department->name or 'Kosong' }}</td>
        </tr>
        
        <tr>
          <td>Project</td>
          <td>: {{ $barangkeluar->permintaanbarang->project->name or 'Kosong' }}</td>
        </tr>
        <tr>
          <td>Pt</td>
          <td>: {{ $barangkeluar->permintaanbarang->pt->name or 'Kosong' }}</td>
        </tr>
        <tr>
          <td>SPK</td>
          <td>: {{ $barangkeluar->permintaanbarang->spk->no or 'Kosong' }}</td>
          
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>: {{ $barangkeluar->description }}</td>
        </tr>
      </thead>
    </table>
    <br/>
    @if(count($barangkeluar->barangkeluardetails) > 0)
      <table width="100%" border="1pt" align="center" class="tg">
        <thead style="background: #3FD5C0;">
          <tr>
            <th>
              No.
            </th>
            <th>
              Barang
            </th>
            <th>
              Qty
            </th>
            <th>
              Gudang
            </th>
            <th>
              Satuan
            </th>
          </tr>
        </thead>
          <tbody>
          <?php $no=1; ?>
          @foreach($barangkeluardetails as $key =>$value)
            <tr>
              <td class="center-text">{{ $key+1 }}</td>
              <td class="center-text">{{ $value->item->name }}</td>
              <td class="right-text">{{ $value->quantity }}</td>
              <td class="center-text">{{ $value->warehouse->name }}</td>
              <td class="right-text">{{ $value->satuan->name }}</td>
              <?php $no++; ?>
            </tr>
          @endforeach
          
        </tbody>
      </table>
    @endif
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