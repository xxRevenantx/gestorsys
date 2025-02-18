<div>


    @isset ( $editLink )
        <a href="{{ $editLink }}" class="btn bg-yellow-500 text-black">
            <i class="fa-solid fa-pen-to-square "></i>
        </a>
    @endif

    @isset ( $deleteLink )

            <button onclick="eliminarSupervisor({{ $supervisor->id }})" class="btn btn-link">
                <i class="fa-solid fa-trash"></i>
            </button>

    @endif
</div>
