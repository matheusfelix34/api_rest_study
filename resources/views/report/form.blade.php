
<fieldset>
    <div class="form-container">
<legend> REPORT REGISTRATION</legend>
	<div class="form-group">
		<div class="col-md-2">
			<label class="required">Title </label>
			<input type="text" id="title" name="title" class="form-control" value=""   required="required"/>
		</div>
		<br>
		
		<div class="col-md-3">
			<label class="required">Description</label>
			<input type="text" id="description" name="description" class="form-control" value=""  required="required"/>
		</div>
		<br>
		
        <div class="col-md-3">
			<select name="profiles[]" id="profiles" multiple required="required">
				@foreach($profiles as $profile)
					<option   value="{{ $profile->id }}">{{ $profile->first_name }} {{ $profile->last_name }} </option>
				@endforeach
			</select>
        </div>
		
		
        

	
	</div>
</div>

</fieldset>