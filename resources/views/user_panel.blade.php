<div class="w-full lg:w-3/12 xl:w-1/6 p-4 border-r border-gray-300 sm:h-full bg-gray-100 overflow-y-scroll">
    <h2 class="relative text-2xl mb-4">
        {{ $user['user']->name }}
        <div class="absolute text-base bottom-0 pb-1 right-0">
            @if($user['today'])
                Today: {{ $user['today']->weight }}@if($user['change'])@include('change', ['change' => $user['change']])@endif
            @else
                Enter weight
            @endif
        </div>
    </h2>

    <form action="/user/{{ $user['user']->id }}/weight" method="POST">
        @csrf
        <div class="relative">
            <label for="weight" class="sr-only">Enter weight</label>
            <input type="number" step="any" id="weight" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <button type="submit" class="absolute right-0 top-0 p-2"><span class="sr-only">Submit</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="h-6 w-6"><path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM10 8H6v4h4v2.5l4.5-4.5L10 5.5V8z"/></svg>
            </button>
        </div>
    </form>

    <div class="hidden sm:block">
        <table class="mt-4 table-fixed w-full">
            <thead>
            <tr>
                <th class="w-1/2 text-left" scope="col">Date</th>
                <th class="w-1/2 text-left" scope="col">Weight</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user['weights'] as $weight)
                <tr>
                    <td>{{ $weight->created_at->format('M d') }}</td>
                    <td>{{ $weight->weight }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>