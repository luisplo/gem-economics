<div class="grid grid-cols-1 gap-4 justify-items-center">
    <h3 class="font-semibold text-4xl">Crea una {{ $title }}</h3>
    <br>
    <div class="form-control w-1/2">
        <label class="label">
            <span class="label-text">Nombre</span>
        </label>
        <input id="name" name="name" type="text"
            class="input input-bordered @error('name') input-error @enderror" />
        @error('name')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>
    <div class="form-control w-1/2">
        <label class="label">
            <span class="label-text">Descripción</span>
        </label>
        <textarea id="description" name="description"
            class="textarea textarea-bordered h-24 @error('description') textarea-error @enderror"></textarea>
        @error('description')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>
    <div class="form-control w-1/2">
        <label class="label">
            <span class="label-text">Gemas</span>
            <span class="label-text-alt">Este campo representa el valor de la {{ $title }}</span>
        </label>
        <input id="value" name="value" type="number"
            class="input input-bordered @error('frequencies_id') input-error @enderror" />
        @error('value')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>
    <div class="form-control w-1/2">
        <label class="label">
            <span class="label-text">Intervalo</span>
        </label>
        <select id="intervals_id" name="intervals_id"
            class="select select-bordered @error('intervals_id') select-error @enderror">
            <option disabled selected>Seleciona una opción</option>
            @foreach ($intervals as $interval)
                <option value="{{ $interval->id }}">{{ $interval->name }}</option>
            @endforeach
        </select>
        @error('intervals_id')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>
    <div class="form-control w-1/2">
        <label class="label">
            <span class="label-text">Frecuencia del intervalo</span>
        </label>
        <input id="frequency" name="frequency" type="number"
            class="input input-bordered @error('frequency') input-error @enderror" />
        @error('frequency')
            <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </label>
        @enderror
    </div>
    <br>
    <button class="btn w-1/2" type="submit">Guardar</button>
</div>
