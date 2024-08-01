<div class="form-group column-last {{ $column }}" id="{{ $name }}-field">
    <label class="col-sm-2 control-label" id="{{ $name }}-input">{{ $label }}{!! ($required && $required == "true") ? '<span style="color:#d9534f">*</span>' : '' !!} :</label>
    <div class="col-sm-10">
        <input type="date" id="{{ $name }}-input" name="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}" required="required" min="{{ $min }}" max="{{ $max }}" style="width:{{ $width }};text-align:center">
    </div>
    <br>
</div>
