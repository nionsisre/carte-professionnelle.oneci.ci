<div class="form-group column-last {{ $column }}">
    <label class="col-sm-2 control-label">{{ $label }}{!! ($required && $required == "true") ? '<span style="color:#d9534f">*</span>' : '' !!} :</label>
    <div class="col-sm-10">
        <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ $required ? 'required="required"' : '' }} autocomplete="off" style="text-transform:uppercase;width:{{ $width }};text-align:center">
    </div>
    <br>
</div>
