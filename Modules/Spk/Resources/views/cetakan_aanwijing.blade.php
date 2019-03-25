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
<div id="head_Content_aanwijing">
	 <div id="dvContents_aanwijing" class="result" style="display: none;">
	 	@if ( $spk->tender->aanwijing != "" )
	 	<center><h3><strong>BERITA ACARA PENJELASAN TENDER</strong></h3></center>
	 	<center><h3><strong>{{ $spk->tender->name or ''}}</strong></h3></center>
	 	<table width="100%">
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">Hari/ Tanggal</td>
	 			<td>{{ date("d/M/Y", strtotime($spk->tender->aanwijing->tanggal))}}</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">Hari/ Tanggal</td>
	 			<td>{{ date("H:i", strtotime($spk->tender->aanwijing->waktu))}} - selesai</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">Tempat</td>
	 			<td>{{$spk->tender->aanwijing->tempat }}</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">Resume</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">1. Masa Pelaksanaan</td>
	 			<td>{{ $spk->tender->aanwijing->masa_pelaksanaan}}</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">2. Masa Pemeliharaan</td>
	 			<td>{{ $spk->tender->aanwijing->masa_pemeliharaan}}</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">3. Jaminan Penawaran</td>
	 			<td>{{ $spk->tender->aanwijing->jaminan_penawaran}}</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">4. Jaminan Pelaksanaan</td>
	 			<td>{{ $spk->tender->aanwijing->jaminan_pelaksanaan}}</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">5. Sistem Pembayaran</td>
	 			<td>
	 				<ul>
	 					@foreach ( $spk->termyn as $key => $value )
	 					@if ( $key == 0 )
	 						<li>Tagihan pertama {{ $value->termin }} % dapat ditagihkan setelah spk ditandatangani kedua belah pihak.Pada saat pengambilan giro kontraktor harus menyerahkan progress lapangan sebesar {{ $spk->min_progress_dp}} %.</li>
	 					@else
	 						<li>Tagihan ke {{ $key + 1}} {{ $value->termin }} %</li>
	 					@endif
	 					@endforeach

	 					@foreach ( $spk->retensis as $key => $value )
	 					<li>Retensi sebesar {{ $value->percent * 100 }} % setelah {{ $value->hari }} hari</li>
	 					@endforeach
	 				</ul>
	 			</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">6. Lama Pembayaran</td>
	 			<td>
	 				<p>Lama pembayaran	:<br/>
					21 hari kalender untuk tagihan pertama<br/>
					28 hari kalender untuk progress kerja<br/>
					(terhitung sejak berkas tagihan diterima lengkap tanpa ada 
						kesalahan)</p>
	 			</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">7. Denda Keterlambatan</td>
	 			<td>{{ $spk->tender->aanwijing->denda }} %o (satu per mil) sehari keterlambatan,max 5% dari nilai kontrak</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">8. Material On Site</td>
	 			<td>0% (tidak diperhitungkan dalam progress)</td>
	 		</tr>
	 		<tr>
	 			<td style="width: 30%;vertical-align: top;">9. Tata cara pemasukan penawaran sebagai berikut	:</td>
	 			<td>
	 				<ul>
	 					<li>Penawaran disampaikan dalam amplop tertutup.</li>
	 					<li>Penawaran dibuat rangkap 2 ( 1 asli dan 1 copy ).</li>
	 					<li>Surat penawaran pelaksanaan pekerjaan.</li>
	 					<li>Bill of Quantities.</li>
	 					<li>Schedule pelaksana atau kurva S.</li>
	 					<li>Rekomendasi / usulan subkontraktor ( bila ada ).</li>
	 					<li>Analisa harga satuan ( lengkap ).</li>
	 					<li>Metode pelaksanaan.</li>
	 					<li>Struktur organisasi lapangan lengkap dengan CV.</li>
	 					<li>Rekomendasi/usulan material yang akan digunakan ( berupa data teknis dan brosur ).</li>
	 					<li>Disket.</li>
	 				</ul>
	 			</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">
	 				10. Surat penawaran pelaksanaan pekerjaan diajukan paling lambat pada {{ date("d/M/Y",strtotime($spk->tender->penawaran1_date)) }} jam 16.00.WIB,ditujukan kepada : <br/>
	 				<center><span>Panitia Lelang {{ $spk->tender->name }}</span><br/>
	 				<span>{{ $spk->tender->project->name or '' }}</span><br/>
	 				<span>{{ $spk->rekanan->group->supps->first()->pt->name or '' }}</span><br/>
	 				<p>{{ $spk->rekanan->group->supps->first()->project->address or '' }}</p><br/></center>
	 			</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">11. Berita acara rapat penjelasan sementara  akan diberikan salinannya setelah selesainya rapat penjelasan hari ini.</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">12. Sifat kontrak adalah Lump Sump fixed price, kecuali adanya perubahan desain, segala sesuatu perbedaan yang ada antara gambar,bq dan spesifikasi belum tentu menjadi pekerjaan tambah kurang.</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">13. Apabila terdapat perbedaan antara gambar,spesifikasi dan BQ, maka yang menentukan adalah owner.</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">14. Kontraktor wajib mempelajari seluruh dokumen tender yang sudah diberikan, apabila setelah rapat penjelasan tender ini masih ada pertanyaan tambahan baik yang bersifat teknis maupun non teknis masih diberikan waktu untuk melakukan pertanyaan (batas waktu pertanyan sampai dengan {{ date("d/M/Y",strtotime($spk->tender->penawaran1_date)) }} jam 16.00 BBWI. Segala salah interprestasi terhadap specifikasi, gambar dan atau bq akan menjadi tanggung jawab kontraktor sepenuhnya.Kontraktor dianggap telah memahami dan mengerti seluruh isi dokumen yang ada).</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">15. Peninjauan lapangan dilakukan bersama sama setelah selesainya rapat penjelasan (perlu/tidak).</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">16. Kontraktor pada tanggal {{ date("d/M/Y", strtotime($spk->tender->aanwijzing_date))}} telah menerima dokumen tender Pembangunan Ruko RCW VI sebagai berikut : 
	 				@if ( $spk->tender->tender_document != "")
	 				<ul>
	 				@foreach ( $spk->tender->tender_document as $key => $value )
	 					<li>{{ $value->document_name }} tertanggal {{ date("d/M/Y",strtotime($value->created_at)) }}</li>
	 				@endforeach
	 				</ul>
	 				@endif
	 			</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">17. Penawaran yang diajukan atas dasar 1 (satu) set sesuai dengan yang tertulis dalam dokumen tender.</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">18. Kontraktor diijinkan untuk menempatkan 2 tenaga kerja sebagai tenaga keamanan atau penjaga gudang di dalam lokasi proyek. Untuk menghindari hal hal yang tidak diinginkan kontraktor wajib melaporkan siapa saja yang akan tinggal dalam lokasi proyek kepada PT SBM (akan dibuatkan KTP Proyek)</td>
	 		</tr>
	 		<tr>
	 			<td colspan="2">19. Kontraktor akan menerima lapangan dalam kondisi sesuai kondisi lapangan.</td>
	 		</tr>
	 	</table>
	 	@endif
	 </div>
</div> 