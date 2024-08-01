<div class="form-group" id="{{ $name }}-field">
    <div class="col-sm-10">
        <div class="box">
            <input type="file" name="{{ $name }}" id="{{ $name }}-input"
                   class="inputfile" accept="application/pdf, image/jpeg, image/png" {{ $required ? 'required' : '' }}
                   style="display: none">
            <label for="{{ $name }}-input" class="atcl-inv hoverable"
                   style="background-color: #bdbdbd6b;padding: 2em;border: 1px dashed black;border-radius: 1em; width: 20em;"><i
                    class="fad fa-{{ $icon }} fa-3x mr10"
                    style="padding: 0.2em 0;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger le document…</span></label>
        </div>
    </div><br/>
    <label for="{{ $name }}-input" class="col-sm-2 control-label">
        <em>Le document à charger doit être un scan <b>recto verso</b> du document <b>sur la même face</b> au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
            avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.</em>
    </label>
    <br/>
</div>
