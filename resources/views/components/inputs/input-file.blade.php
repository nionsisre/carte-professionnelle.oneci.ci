<div class="form-group">
    <label class="col-sm-2 control-label">{{ $label }}<span style="color:#d9534f">*</span>:</label>
    <div class="col-sm-10">
        <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }}>
    </div>
    <br>
</div>
<h2><i class="fa fa-balance-scale"></i> &nbsp; Décision Judiciaire :</h2>
<div class="form-group" id="attached-doc-field">
    <div class="col-sm-10">
        <div class="box">
            <input type="file" name="attached-doc" id="attached-doc-input"
                   class="inputfile" accept="application/pdf, image/jpeg, image/png"
                   style="display: none">
            <label for="attached-doc-input" class="atcl-inv hoverable"
                   style="background-color: #bdbdbd6b;padding: 2em;border: 1px dashed black;border-radius: 1em; width: 20em;"><i
                    class="fad fa-file-pdf fa-3x mr10"
                    style="padding: 0.2em 0;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><i class="fa fa-file-upload"></i> &nbsp; <span>Charger le document…</span></label>
        </div>
    </div><br/>
    <label for="attached-doc-input" class="col-sm-2 control-label">
        <em>Le document à charger doit être un scan du document  au format <b>*.pdf</b>, <b>*.jpg</b> ou <b>*.png</b>,
            avoir une résolution minimum de <b>150 dpi</b> et ne doit pas excéder <b>1 Mo</b>.</em>
    </label>
    <br/>
</div>

