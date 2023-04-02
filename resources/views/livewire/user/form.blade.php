@include('common.modalHead')
<form>
    <div class="row">
        <div class="col-sm-8">
            <label class="form-label">Nombre </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit">

                        </span>
                    </span>
                </div>
                <input type="text" wire:model='nombre' class="form-control" placeholder="Ingrese su nombre">
            </div>
            @error('nombre')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <label class="form-label">Correo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit">
                        </span>
                    </span>
                </div>
                <input type="text" wire:model='correo' class="form-control" placeholder="ejemplo@gmail.com">
            </div>
            @error('correo')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row mt-3">
       @role('Supervisor')
        <div class="col-md-6">
            <label class="form-label">Rol</label>
            <div class="input-group">
                <select class="form-control" wire:model='role'>
                    <option selected>Seleccione</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('role')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>

        @endrole
        {{-- @role('Empleado')
        <div class="col-md-6">
            <label class="form-label">Contraseña</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <span class="fas fa-edit">
                        </span>
                    </span>
                </div>
                <input type="password" wire:model='password' class="form-control" placeholder="**************">
            </div>
            @error('password')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
        @endrole --}}
    </div>
</form>
@include('common.modalFooter')
