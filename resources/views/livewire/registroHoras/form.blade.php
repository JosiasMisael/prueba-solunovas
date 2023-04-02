@include('common.modalHead')
<form>
<div class="row">
    <div class="col-md-6">
        <label class="form-label">Catalogo de horas</label>
        <div class="input-group">
            <select class="form-control" wire:model='catalogo' >
                <option value="Elegir" selected>seleccione</option>
                @foreach ($catalogos as $catalogo)
            <option value="{{$catalogo->id}}">{{ $catalogo->tarea}} ({{$catalogo->horas_estimadas}} horas estimadas)</option>
            @endforeach
            </select>
          </div>

        @error('categoria')
        <span class="text-danger er">{{ $message }}</span>
       @enderror
    </div>
    <div class="col-sm-5">
        <label class="form-label">Cantidad horas</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">
                  </span>
                </span>
            </div>
            <input type="text" wire:model='cantidad_horas' class="form-control" placeholder="Cantidad horas trabajadas">
        </div>
        @error('cantidad_horas')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>

</form>
@include('common.modalFooter')
