<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cetak Barang Retur</title>
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
  	<h4 class="center-text">PENGEMBALIAN BARANG</h4>
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
          <td>: {{ $BarangMasukHibah->no }}</td>
          <td>Tanggal</td>
          <td>: {{ date('d-m-Y',strtotime($BarangMasukHibah->tanggal_hibah)) }}</td>
        </tr>
        <tr>
          <td>Refrensi</td>
          <td>: {{ $BarangMasukHibah->no_refrensi }}</td>
           <td>Penerima</td>
            <td>: {{ $BarangMasukHibah->user_recepient->user_name }}</td>
        </tr>
        <tr>
          <td>Kepada</td>
        </tr>
        <tr>
          <td>Proyek</td>
          <td>: {{ $BarangMasukHibah->from_project->name }}</td>
          
        </tr>
        <tr>
          <td>PT</td>
          <td>: {{ $BarangMasukHibah->from_pt->name }}</td>
        </tr>
      </thead>
    </table>
    <br/>
    <table width="100%" border="1pt" align="center" class="tg">
                
              <thead style="background: #3FD5C0;">
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Item Barang</th>
                  <th class="text-right">Retur</th>
                  <th class="text-right">Harga(Rp.)</th>
                  <th class="text-right">Total</th>
                  <th class="text-center">Satuan</th>
                  <th class="text-center">Description</th>
                </tr>
              </thead>
              <tbody>
                @if(count($detailsbarangmasuk) > 0)
                  @foreach($detailsbarangmasuk as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->items->name }}</td>
                    <td style="text-align: right;">{{ $value->total_reject or '0' }}</td>
                    <td style="text-align: right;">Rp.{{ number_format($value->price,0,',','.') }}</td>
                    <td style="text-align: right;">Rp.{{ number_format($value->price*$value->total_reject,0,',','.') }}</td>

                    <td>{{ is_null($value->item_satuan) ? $value->item_satuan_id : $value->item_satuan->name }}</td>
                    <td>{{ $value->description or 'reject' }}</td>
                    
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="7" style="text-align: center;">Empty</td>
                  </tr>

                @endif
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
            {{ $BarangMasukHibah->user_recepient->user_name }}
          </th>
          <th>
            <h1>&nbsp;</h1>
            
          </th>
        </tr>
      </thead>
    </table>
  </body>
</html>