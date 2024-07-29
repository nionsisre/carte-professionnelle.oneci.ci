<div class="form-group {{ $column }} column-last">
    <label class="col-sm-2 control-label">
        {{ $title }}{!! ($required && $required == "true") ? '<span style="color:#d9534f">*</span>' : '' !!} :
    </label>
    <span style="display: none" id="err-toast"></span>
    <div class="col-sm-10">
        <select class="form-control good-select"
                id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required="required"' : '' }}
                style="width:{{ $width }}; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
            <option value="" selected disabled>{{ $label }}</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </select>
    </div><br/>
</div>
