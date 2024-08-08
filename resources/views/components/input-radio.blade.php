<div class="form-group" id="{{ $name }}-field">
    {!! (isset($title)) ? $title : "" !!}{!! ($required && $required == "true") ? '<span style="color:#d9534f">*</span> :' : '' !!} <br/><br/>
    <div class="col-sm-12 container clearfix">
        @foreach ($options as $option)
            <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                <input type="radio" name="{{ $name }}" id="{{ $option['id'] }}-input" value="{{ $option['value'] }}" style="width:auto;box-shadow:none" {{ old($name) == $option['value'] ? 'checked' : ($option['checked'] ? 'checked' : '') }}>
                <label for="{{ $option['id'] }}-input" style="display:inline-block;padding-right:2em" class="col-sm-5"><b>{!! (isset($option['icon'])) ? '&nbsp; <i class="'.$option['icon'].'"></i>' : "" !!}</i>&nbsp; {{ $option['label'] }}</b></label>
            </div>
        @endforeach
    </div>
    <br>
</div>
