<style>
@media print {
	.result {
		@page{
			page-break-after: always;
			/*size: auto;*/
			size: 297mm 210mm;
			margin:0;
		}
   }

}	
</style>
<div id="dvContents" style="display: none;">
	<div class="result">
		<!-- PEMBATALAN TENDER REPORT -->
		<table width="100%" style="border-collapse:collapse">
		  	<tr>
				<td>@include("print.logo",['pt' => $tender->pt ] )</td>
			</tr>
		</table><br>
		<center><h3>REKOMENDASI PEMENANG TENDER</h3></center>
		<table>
			<tr>
				<td>No. Dokumen</td>
				<td>:</td>
				<td>{{ $tender->no or 'not found' }}</td>
			</tr>
			<tr>
				<td>Paket Kerjaan</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
				<td>Kawasan </td>
				<td>:</td>
				<td>{{ ucwords($tender->rab->workorder->budget_tahunan->budget->kawasan->name) }} , {{ ucwords($tender->rab->workorder->budget_tahunan->budget->project->name) }}</td>
			</tr>
		</table>
		<table style="border-collapse:collapse;width:100%;" border="1pt">
			<tr>
				<td>Peserta</td>
				<td>Alamat</td>
				<td>HP</td>
				<td>PIC</td>
				<td>DPP</td>
				<td>PPN</td>
				<td>Total</td>
				<td>Catatan</td>
			</tr>
			<tr>
				<td>
					@foreach ( $data_tender_rekanan as $each )
					<span>{{ $each->rekanan->group->name }}</span><br/><br/>
					@endforeach
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
					<span>{{ $each->rekanan->surat_alamat }}</span><br/><br/>
					@endforeach
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
					<span>{{ $each->rekanan->telp }}</span><br/><br/>
					@endforeach
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
					<span>{{ $each->rekanan->cp_name }}</span><br/><br/>
					@endforeach
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
						@foreach ( $each->penawarans as $each2 )
						<span>{{ $each2->nilai_dpp }}</span><br/><br/>
						@endforeach 
					@endforeach
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
						@foreach ( $each->penawarans as $each2 )
						<span>{{ ( 0.1 * $each2->nilai_dpp ) }}</span><br/><br/>
						@endforeach 
					@endforeach
				</td>
				</td>
				<td>
					@foreach ( $data_tender_rekanan as $each )
						@foreach ( $each->penawarans as $each2 )
						<span>{{ $each2->nilai }}</span><br/><br/>
						@endforeach 
					@endforeach
				</td>
				<td></td>
			</tr>
		</table>
		<h1>&nbsp;</h1>
		<h1>&nbsp;</h1>
		<h1>&nbsp;</h1>
		<table style="width: 100%;text-align: left;">
			<tr>
				<td>
					<div><u>{{ strtoupper($tender->createdBY->user_name) }}</u><br/>ADMIN</div>
				</td>		
				@foreach( $tender->approval->histories as $histories )

			    	@if (  $tender->approval->histories->min('no_urut') < 5 )
			    		@if( 5 == $histories->no_urut )
					    <td>
					    	<br/>
					    	<div align="center">    		
					    		<u>{{ strtoupper($histories->user->user_name) }}</u> </br>	
					    		{{ $histories->user->jabatan($tender->pt->id) }}		    		
						    </div>			    				    	
					    </td>	
					    @endif
					@else
						@if( 6 == $histories->no_urut )
					    <td>
					    	<br/>
					    	<div align="center">			
					    		<u>{{ strtoupper($histories->user->user_name) }}</u> </br> 	
					    		{{ $histories->user->jabatan($tender->pt->id) }}	    		
						    </div>			    				    	
					    </td>	
					    @endif	
			    	@endif

				    @if( $tender->approval->histories->min('no_urut') == $histories->no_urut )
				    <td>
				    	<br/>
				    	<div align="center">			
				    		<u>{{ strtoupper($histories->user->user_name) }}</u></br> 	
				    		{{ $histories->user->jabatan($tender->pt->id) }}	    		
					    </div>			    				    	
				    </td>	
				    @endif

			  	@endforeach
  			</tr>
  		</table>
  		 <table width="100%">
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td><strong>{{ ucwords($tender->rab->workorder->budget_tahunan->budget->project->name) }}</strong></td>
			  <td>&nbsp;</td>
			  <td><div align="right"><strong>C&amp;P/FR/QS/14</strong></div></td>
			</tr>
			<tr>
			  <td>Alamat : {{ ucwords($tender->rab->workorder->budget_tahunan->budget->project->address) }}</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td>Phone : {{ ucwords($tender->rab->workorder->budget_tahunan->budget->project->phone) }}</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		  </table>
	</div>
</div>