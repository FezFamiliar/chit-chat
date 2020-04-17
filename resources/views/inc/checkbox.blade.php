<div class="toggle">
	<input type="checkbox" style="display:none;" data-id="{{ $setting->id }}">

	<label for="toggle_k90" class="{{ ($setting->setting_id != null && $setting->user_id == Auth::user()->id && $setting->setting_id == $setting->id) ? 'true_90' : ''}}">
		<div class="toggle_i">Yes</div>
		<div class="toggle_j"></div>
		<div class="toggle_k">No</div>
	</label>
</div>