<div>


    @isset ( $editLink )
        <a href="{{ $editLink }}" class="btn bg-yellow-500 text-black">
            <i class="fa-solid fa-pen-to-square "></i>
        </a>
    @endif


    @isset ( $viewLink )

        <a href="{{$viewLink}}" class="btn bg-blue-500 text-white">
            <i class="fa-solid fa-eye"></i>
        </a>

    @endisset


</div>
