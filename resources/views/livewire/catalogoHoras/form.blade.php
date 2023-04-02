@include('common.modalHead')

<div class="row">
    <div class="col-sm-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                  </span>
                </span>
            </div>
            <input type="text" wire:model='tarea' class="form-control" placeholder="nombre tarea">
        </div>

        @error('tarea')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
     <div class="col-sm-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                  </span>
                </span>
            </div>
            <input type="text" wire:model='horas_estimadas' class="form-control" placeholder="Horas requeridas">
        </div>

        @error('horas_estimadas')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row mt-3">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                  </span>
                </span>
            </div>
            <input type="text" wire:model='descripcion' class="form-control" placeholder="Descripción">
        </div>
        @error('descripción')
            <span class="text-danger er">{{ $message }}</span>
        @enderror
    </div>
</div>

@include('common.modalFooter')
