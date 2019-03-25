<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3><center><strong>SYARAT- UMUM PERJANJIAN PEMBORONGAN<br/>{{ $data->pt->name or '' }} dengan {{ $data->rekanan->group->name or ''}}</strong></center></h3>
<hr/>
<center><h3>SUPP No : <strong>{{ $data->no }}</strong></h3></center>

<p style="font-size: 13px;margin-left: 80px;margin-right: 80px;text-align: justify;">Kami yang bertanda tangan di bawah ini :
{{ $data->pt->name or ''}}, berkedudukan di {{ $data->pt->address or ''}}, dalam hal ini diwakili oleh {{ $data->user_penandatangan->user_name }} / {{ $jabatan }}, sehingga oleh dan karenanya berhak menandatangani Perjanjian ini untuk dan atas nama {{ $data->pt->name or ''}}, selanjutnya disebut sebagai PIHAK PERTAMA.</p>
<center>bersama</center>
<p style="font-size: 13px;margin-left: 80px;margin-right: 80px;text-align: justify;">
Kontraktor {{ $data->rekanan->name or ''}}, berkedudukan di {{ $data->rekanan->surat_alamat or ''}}, dalam hal ini diwakili oleh {{ strtoupper($data->rekanan->group->cp_name) }} ({{ strtoupper($data->rekanan->group->cp_jabatan)}}), sehingga oleh dan karenanya berhak menandatangani Perjanjian ini untuk dan atas nama Kontraktor {{ $data->rekanan->name or ''}}, selanjutnya disebut sebagai PIHAK KEDUA.
Pihak Pertama dan Pihak kedua bersama-sama disebut sebagai para pihak telah sepakat untuk melaksanakan ketentuan-ketentuan yang ada dalam Syarat Umum Perjanjian Pemborongan ( SUPP ) sebagai berikut :</p>

<center><span><strong>Pasal 1<br/>Jenis Lokasi Pekerjaan</strong></span></center>
<table width="100%" style="margin-left: 30px;margin-right: 80px;font-size: 13px;">
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">1.1</span></td>
		<td style="vertical-align: top;">
			PIHAK PERTAMA memberi Pekerjaan kepada PIHAK KEDUA dan PIHAK KEDUA bersedia menerima pekerjaan tersebut dari PIHAK PERTAMA untuk melaksanakan Pemborongan di Proyek CIPUTRA GROUP berdasarkan gambar pelaksanaan, rencana kerja dan syarat-syarat (RKS) dan uraian detail spesifikasi teknis (spesifikasi material dan metode kerja) untuk jenis dan lokasi pekerjaan terlampir pada masing-masing Surat Perintah Kerja (SPK) yang merupakan bagian yang tidak terpisahkan dari perjanjian ini.
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">1.2</span></td>
		<td style="vertical-align: top;text-align: justify;">			
			Dalam pekerjaan tersebut, sudah termasuk semua pekerjaan-pekerjaan kecil lainnya yang selayaknya harus dilaksanakan sebagai kelengkapan dan kesempurnaan pekerjaan yang berkaitan dengan sistem dan fungsi walaupun pekerjaan-pekerjaan kecil ini tidak terlihat atau dinyatakan dengan jelas pada gambar-gambar, Dokumen Tender atau Dokumen Kontrak.</p>
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">1.3</span></td>
		<td style="vertical-align: top;text-align: justify;">			
			PIHAK KEDUA dilarang mengalihkan kepada PIHAK LAIN baik sebagian dan atau seluruh pekerjaan, tanpa persetujuan tertulis dari PIHAK PERTAMA.
		</td>
	</tr>
</table>



<center><span><strong>Pasal 2<br/> NILAI, WAKTU  & JENIS KONTRAK PEKERJAAN</strong></span></center><br/>
<table width="100%" style="margin-left: 30px;margin-right: 80px;font-size: 13px;">
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">2.1</span></td>
		<td style="vertical-align: top;text-align: justify;">
			Nilai dan jenis kontrak baik remeasure, atau fixed unit price, atau Lumpsum fixed price, akan ditentukan dan disepakati melalui proses klarifikasi, negosiasi dan tertera dalam Surat Perintah Kerja (SPK) antara PIHAK PERTAMA dan PIHAK KEDUA (baik melalui proses tender maupun penunjukan langsung).
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">2.2</span></td>
		<td style="vertical-align: top;text-align: justify;">			
			Waktu pelaksanaan pekerjaan diuraikan pada masing-masing SPK yang ada. Dalam Hal ada pekerjaan tambah/kurang seperti yang dimaksud pada pasal perjanjian, mempengaruhi waktu pelaksanaan pekerjaan, maka PIHAK KEDUA berhak mengajukan perpanjangan waktu yang lamanya akan ditentukan dan disetujui oleh PIHAK PERTAMA
		</td>
	</tr>
	<tr>
		<td style="vertical-align: top;"><span style="font-size: 13px;">2.3</span></td>
		<td style="vertical-align: top;text-align: justify;">			
			Harga satuan pekerjaan yang terlampir pada SPK dan BQ Revisi mengikat selama SPK tersebut masih berlaku dan belum berakhir  , termasuk untuk pekerjaan tambah/kurang pada SPK tersebut seperti yang diatur dalam  pada pasal  Perjanjian.
		</td>
	</tr>
</table>



</body>
</html>