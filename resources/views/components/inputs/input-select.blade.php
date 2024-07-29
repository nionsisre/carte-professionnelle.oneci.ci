<div class="form-group">
    <label class="col-sm-2 control-label">{{ $label }}{!! ($required && $required == "true") ? '<span style="color:#d9534f">*</span>' : '' !!} :</label>
    <div class="col-sm-10">
        <select name="{{ $name }}" id="{{ $name }}-input" class="form-control" {{ $required ? 'required' : '' }} style="width:{{ $width }}">
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </select>
    </div>
    <br>
</div>
