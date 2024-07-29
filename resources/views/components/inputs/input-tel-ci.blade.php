<div class="form-group column-last {{ $column }}" id="{{ $name }}-field">
    <div class="col-sm-12">
        <label class="col-sm-2 control-label">{{ $label }}{!! (isset($required) && $required == "true") ? '<span style="color:#d9534f">*</span>' : '' !!} :</label>
        <div class="col-sm-10">
            <span style="width: 2em">+ 225</span>&nbsp;<input type="text" class="form-control msisdn" id="{{ $name }}-input" name="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxlength }}" {{ (isset($required) && $required == "true") ? 'required="required"' : '' }} autocomplete="off" style="width: {{ $width }}; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;" />
        </div>
        <br>
    </div>
</div>
