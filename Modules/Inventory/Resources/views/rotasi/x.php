<div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">From Location</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
				    	<select class='form-control select2' name='from_location_id' id='from_location_id'>
							<option value=''>Pilih</option>
							@foreach($Locations as $key => $location)
								<option value='{{ $location->id }}'>{{ $location->description }}</option>
							@endforeach
						</select>
				    </div>
			  	</div>

			  	<div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">To Location</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
				    	<select class='form-control select2' name='to_location_id' id='to_location_id'>
							<option value=''>Pilih</option>
							@foreach($Locations as $key => $location)
								<option value='{{ $location->id }}'>{{ $location->description }}</option>
							@endforeach
						</select>
				    </div>
			  	</div>