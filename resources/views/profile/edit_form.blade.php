
<fieldset>
    <div class="form-container">
<legend> PROFILE EDIT</legend>
	<div class="form-group">
		
        <div class="col-md-2">
            <label class="required">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $profile->first_name ?? '' }}" required/>
        </div>
        <br>
        
        <div class="col-md-3">
            <label class="required">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $profile->last_name ?? '' }}" required/>
        </div>
        
        <div class="col-md-2">
            <label class="required">Date of Birth</label>
            <input type="date" id="dob" name="dob" class="form-control" value="{{ $profile->dob ?? '' }}" required/>
        </div>
        
        <div class="col-md-3">
            <label class="required">Gender</label>
            <select name="gender" id="gender" class="form-control">
                <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $profile->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        
		
		
        

	
	</div>
</div>

</fieldset>