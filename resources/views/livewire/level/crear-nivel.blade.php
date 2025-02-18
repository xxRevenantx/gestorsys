<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">

        <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full" role="alert">
            <p class="font-bold"><i class="fas fa-layer-group"></i> Nuevo Nivel</p>
          </div>

   </div>
   <div class="flow-root my-7">


<form wire:submit.prevent="guardarNivel">


    <div class="upload-area my-3" id="uploadArea" wire:ignore>
        <h5 class="mb-3">Arrastra y suelta tu logo aquí</h5>
        <p class="text-muted my-3">o</p>

        <label for="fileInput" class="btn bg-blue-700 me-2 mb-4 text-white" tabindex="0">
            <span class="d-none d-sm-block my-3">Subir logo</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input type="file" wire:model="imagen" id="fileInput"
             accept="image/png, image/jpeg" hidden="hidden"></label><br>

        {{-- <button class="btn btn-primary" onclick="document.getElementById('fileInput').click()">Seleccionar archivo</button> --}}
        <img id="preview" class="mt-3 d-none">
    </div>
    @error('imagen')
    <div class="text-red-500">{{ $message }}</div>
    @enderror

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="mb-5">
            <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel</label>
            <input type="text"  id="level" wire:model.live="level" placeholder="Ingrese el nivel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('level')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
            <input type="text" readonly id="slug" wire:model="slug" placeholder="Ingrese el slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('slug')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-5">
            <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagen</label>
            <input type="file" id="imagen" wire:model="imagen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('imagen')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="mb-5">
            <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Color</label>
            <input type="color" id="color" wire:model="color" placeholder="Ingrese el color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('color')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="cct" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CCT</label>
            <input type="text" id="cct" wire:model="cct" placeholder="Ingrese el CCT" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('cct')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="director_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Director</label>
            <select id="director_id" wire:model="director_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">---Seleccione un director---</option>
                @foreach($directores as $director)
                    <option value="{{ $director->id }}">{{ $director->nombre }} {{$director->apellido_paterno}} {{$director->apellido_materno}} </option>
                @endforeach
            </select>
            @error('director_id')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="supervisor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supervisor</label>
            <select id="supervisor_id" wire:model="supervisor_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">---Seleccione un supervisor---</option>
                @foreach($supervisores as $supervisor)
                    <option value="{{ $supervisor->id }}">{{ $supervisor->nombre }} {{$supervisor->apellido_paterno}} {{$supervisor->apellido_materno}}  </option>
                @endforeach
            </select>
            @error('supervisor_id')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex justify-start items-center mb-5">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
        focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Nivel
            <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
        </button>
    </div>


  </form>

   </div>
</div>


@push('scripts')

<script>
    const uploadArea = document.getElementById("uploadArea");
    const fileInput = document.getElementById("fileInput");
    const preview = document.getElementById("preview");

    uploadArea.addEventListener("dragover", (e) => {
        e.preventDefault();
        uploadArea.style.backgroundColor = "#e9ecef";
    });

    uploadArea.addEventListener("dragleave", () => {
        uploadArea.style.backgroundColor = "transparent";
    });

    uploadArea.addEventListener("drop", (e) => {
        e.preventDefault();
        uploadArea.style.backgroundColor = "transparent";
        const file = e.dataTransfer.files[0];
        if (file) {
            showPreview(file);
        }
    });

    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file) {
            showPreview(file);
        }
    });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    }
</script>


@endpush
