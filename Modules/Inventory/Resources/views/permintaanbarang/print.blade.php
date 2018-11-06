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
          <td>: {{ $permintaan->no }}</td>
          <td>Tangal</td>
          <td>: {{ date('d/m/Y',strtotime($permintaan->created_at)) }}</td>
          
        </tr>
        <tr>
          <td>Project</td>
          <td>: {{ $permintaan->project->name }}</td>
        </tr>
        <tr>
          <td>Department</td>
          <td>: {{ $permintaan->department->name }}</td>
        </tr>
        <tr>
          <td>Pt</td>
          <td>: {{ $permintaan->pt->name }}</td>
          <td>SPK</td>
          <td>: {{ $permintaan->spk->no or '-' }}</td>
        </tr>

        <tr>
          <td>Deskripsi</td>
          <td>: {{ $permintaan->description or '-'}}</td>
        </tr>
      </thead>
    </table>
    <br/>
    @if(count($permintaan->details) > 0)
      <table width="100%" border="1pt" align="center" class="tg">
        <thead style="background: #3FD5C0;">
          <tr>
            <th>
              No.
            </th>
            <th>
              Item Barang
            </th>
            <th>
              Qty
            </th>
            <th>
              Satuan
            </th>
            <th>
              Deskripsi
            </th>
          </tr>
        </thead>
          <tbody>
          <?php $no=1; ?>
          @for($count = 0;$count < count($permintaan->details);$count++)
            <tr>
              <td class="center-text">{{ $no }}</td>
              <td class="center-text">{{ $permintaan->details[$count]->item->name or 'Kosong' }}</td>
              <td class="right-text">{{ $permintaan->details[$count]->quantity }}</td>
              <td class="center-text">{{ $permintaan->details[$count]->satuan->name or 'Kosong' }}</td>
              <td class="center-text">{{ $permintaan->details[$count]->description }}</td>
              <?php $no++; ?>
            </tr>
          @endfor
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