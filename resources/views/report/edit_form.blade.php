
<fieldset>
    <div class="form-container">
<legend> REPORT EDIT</legend>
	<div class="form-group">
		
        <div class="col-md-2">
            <label class="required">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $report->title ?? '' }}" required/>
        </div>

        <br>
        
        <div class="col-md-3">
            <label class="required">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $report->description ?? '' }}" required/>
        </div>
        
        
        <div class="col-md-3">
			<select name="profiles[]" id="profiles" multiple required="required">
				@foreach($profiles as $profile)
                <option value="{{ $profile->id }}" {{ in_array($profile->id, $profiles_id) ? 'selected' : '' }}>
                    {{ $profile->first_name }} {{ $profile->last_name }}
                </option>
				@endforeach
			</select>
        </div>
        
        
		
		
        

	
	</div>
</div>

</fieldset>