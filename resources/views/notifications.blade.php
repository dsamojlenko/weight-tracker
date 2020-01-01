@if ($message = Session::get('error'))
    <div class="error-modal">
        <div class="absolute top-0 left-0 w-full h-screen z-20 flex items-center justify-center">

            <div class="error-overlay absolute top-0 left-0 w-full h-screen z-10 bg-gray-100 opacity-75"></div>

            <div class="z-20 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4" role="alert">
                <strong class="font-bold">Nice try, fatty!</strong>
                <span class="block sm:inline">{{ $message }}</span>
            </div>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 z-50">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif