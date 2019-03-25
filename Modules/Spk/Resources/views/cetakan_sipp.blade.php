<style type="text/css">
  #dvContents_spk{
    font-size:8px;
  }

  @media print body {
    font-size:8px;
  }

  @media print {
    .result {page-break-after: always;}
  }
</style>
<div id="head_Content_sipp">

  <div id="dvContents_sipp" class="result" style="display: none;">
  	<img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image">
  	<h3><strong>{{ $spk->tender->project->name }}</strong></h3>
    <table width="100%" style="border-collapse:collapse" class='table' id='form_spk'>
      
      	<tr>
      		<td>{{ $spk->tender->project->city->name or '' }}, {{ date("d/M/Y",strtotime($spk->tender->menangs->last()->created_at))}}</td>
      	</tr>
      	<tr>
      		<td>
      			<table style="width: 100%">
      				<tr>
      					<td style="width: 30%;">Nomor Surat : </td>
      					<td>{{ $spk->tender_rekanan->sipp_no or ''}}</td>
      				</tr>
      				<tr>
      					<td style="width: 30%;">Nomor Tender : </td>
      					<td>{{ $spk->tender->no or ''}}</td>
      				</tr>
      				<tr>
      					<td style="width: 30%;">Perihal : </td>
      					<td><strong><i><u>Penunjukan Pemenang {{ $spk->tender->name or ''}}</u></i></strong></td>
      				</tr>
      			</table>
      		</td>
      	</tr>
      	<tr>
      		<td>
      			<span>Kepada Yth</span><br/>
      			<span><strong>{{ $spk->rekanan->name or ''}}</strong></span><br/>
      			<p>{{ $spk->rekanan->surat_alamat or ''}}</p>
      			<span>{{ $spk->rekanan->telp or ''}}</span><br/>
      			<span>{{ $spk->rekanan->cp_name}}</span>
      		</td>
      	</tr>
      	<tr>
      		<td>
      			<h4><strong>Dengan Hormat</strong></h4>
      			<p>Mengacu pada penawaran Saudara untuk proyek tersebut diatas, dengan ini diinformasikan bahwa setelah melalui tahapan Klarifikasi dan Negoisasi pada tanggal <strong>{{ date("d/M/Y", strtotime($spk->tender->created_at)) }}</strong>, kami telah menetapkan untuk penyerahan pelaksanaan pekerjaan <strong>{{ $spk->tender->name }}</strong> kepada <strong>{{ $spk->rekanan->name }}</strong></p>
      			<p>Untuk nilai pekerjaan sebesar <strong>Rp.{{ number_format($spk->tender->menangs->first()->nilai)}}</strong> Includ. Jasa, Pph & Excl.PPn, sedangkan hal-hal lebih detail lainnya akan dituangkan ke dalam Surat Perintah Kerja(SPK) yang segera kami buat. Cetak MOU harga satuan mengikat sampai dengan {{ date("d/M/Y", strtotime($spk->finish_date))}}</p>
      			<p>Demikian kami sampaikan untuk segera dilaksanakan sesuai dengan ketentuan-ketentuan yang disepakati</p>
      		</td>
      	</tr>
      	<tr>
      		<td>
      			<br/><br/>
      			<h4>Hormat Kami</h4>
      			<br/><br/>
      			<u>
      				@if ( $spk->tender != "" )
      				@foreach ( $spk->tender->approval->histories as $key => $value )
      					@if ( $value->no_urut == 5 )
      					{{ $value->user->user_name }}
      					@endif
      				@endforeach
      				@endif
      			</u><br/>
      			<strong>General Manager</strong>
      		</td>
      	</tr>
    </table>
  </div>
</div>