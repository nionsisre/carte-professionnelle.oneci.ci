<div class="form-group">
    {!! (isset($title)) ? $title.' : <br/><br/>' : "" !!}
    <div class="col-sm-12 container clearfix">
        @foreach ($options as $option)
            <div class="col-sm-6 ckbox ckbox-success form-group one-half column-last">
                <input type="radio" name="{{ $name }}" id="{{ $option['id'] }}" value="{{ $option['value'] }}" style="width:auto;box-shadow:none" {{ $option['checked'] ? 'checked="checked"' : '' }}>
                <label for="{{ $option['id'] }}" style="display:inline-block;padding-right:2em" class="col-sm-5"><b>{!! (isset($option['icon'])) ? '&nbsp; <i class="'.$option['icon'].'"></i>' : "" !!}</i>&nbsp; {{ $option['label'] }}</b></label>
            </div>
        @endforeach
    </div>
    <br>
</div>
