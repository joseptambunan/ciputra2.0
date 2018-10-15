<table width="100%">
  <tr>
	<td class="padding" width="5%"><table width="100%" class="">
	  <tr>
		<td class="padding" vertical-align="bottom"><div align="center">
			@if(strpos($pt->name,'Ciputra') !== false)
			<img src="../../images/logo-ciputra_original.png" alt="logo" class="logo-default" style='height:57%' />
			@else
			<img src="../../images/logo-ciputra_original_text.png" alt="logo" class="logo-default" style='height:57%' />
			@endif
		  	
		</div></td>
	  </tr>
	</table></td>
	<td class="padding" width="68%" valign="bottom"><span style="font-size: 25px;"><strong> {{ $pt->name or 'PT Name' }} </strong></span></td>
	<td class="padding" width="15%">&nbsp;</td>
  </tr>
</table>