<!DOCTYPE html>
<html lang="EN">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Persediaan Barang</title>
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
  	<h4 class="center-text">LAPORAN PERSEDIAAN BARANG</h4>
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
          <td>Project</td>
          <td>: {{ $projectname }}</td>
        </tr>

      </thead>
    </table>
    <br/>
    
    <table class="tg" id="table_data" border="1"> 
  
    <thead style="background-color: #3FD5C0;">
      <tr>
        <th>Kategori</th>
        <th>Item</th>
        <th>Qty Aktual</th>
        <th>Qty Tersedia</th>
        <th>Satuan</th>
      </tr>
    </thead>
  <tbody>
    <?php
    $obj = [];
      foreach($stocks as $cell => $value){
        if(isset($obj[$value->category]['count']))
        {
          $obj[$value->category]['count']+=1;
        }
        else
        {
          $obj[$value->category]['count']=1;
        }
      }
    $category ='';
    ?>
    @foreach($stocks as $key => $value)
    <tr>
      
      @if($category != $value->category)
        <td rowspan="{{ $obj[$value->category]['count'] }}">{{ $value->category }}</td>
        <?php 
          $category = $value->category;
        ?>
      @endif
      <td>{{ $value->item_name }}</td>
      <td class="right-text">{{ round($value->stock_afterkonversi,0) }}</td>
      <td class="right-text">{{ is_null($value->stock_avaible) ? round($value->stock_afterkonversi,0) : round($value->stock_avaible,3) }}
      </td>
      <td>{{ $value->satuan_beforekonversi }}</td>
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

    
    <script type="text/javascript">
     // $(document).ready(function()
      //{
          /*$('#table_data').DataTable({
              paging:false,
              "columnDefs": [
                  {targets:[0],visible:false}
                  ],
                "order": [[0,'asc']],//,
                    "drawCallback": function ( settings ) {
                        var api = this.api();
                        var rows = api.rows( {page:'current'} ).nodes();
                        var last=null;
                        api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                $(rows).eq( i ).before(
                                    '<tr class="group success"><td colspan="5" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
                                );
             
                                last = group;
                            }
                        });
                    }
              });*/
      //});
    </script>
  </body>
</html>
