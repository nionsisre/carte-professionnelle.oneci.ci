<div class="form-group">
    <label class="col-sm-2 control-label">{{ $label }}<span style="color:#d9534f">*</span>:</label>
    <div class="col-sm-10">
        <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }}>
    </div>
    <br>
</div>
