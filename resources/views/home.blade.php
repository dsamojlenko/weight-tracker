<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            @if ($message = Session::get('error'))
                <div class="absolute top-0 left-0 w-full h-screen z-10 bg-gray-100 opacity-75"></div>

                <div class="absolute top-0 left-0 w-full h-screen z-10 flex items-center justify-center">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 z-50" role="alert">
                        <strong class="font-bold">Nice try, fatty!</strong>
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                </div>

            @endif
            <div class="flex-none sm:flex h-screen">
                <div class="w-full sm:w-1/2 md:w-1/3 xl:w-1/6 p-4 border-r border-gray-300 sm:h-full bg-gray-100">
                    <h2 class="relative text-2xl mb-4">
                        Phil
                        <div class="absolute text-base bottom-0 pb-1 right-0">
                            @if($phil['today'])
                                Today: {{ $phil['today']->weight }}@if($phil['change'])({{ $phil['change'] }})@endif
                            @else
                                Not yet recorded today
                            @endif
                        </div>
                    </h2>

                    <form action="/user/2/weight" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="2">
                        <div class="relative">
                            <input type="text" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <button type="submit" class="absolute right-0 top-0 p-2"><span class="sr-only">Submit</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="h-6 w-6"><path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM10 8H6v4h4v2.5l4.5-4.5L10 5.5V8z"/></svg>
                            </button>
                        </div>
                    </form>

                    <div class="hidden sm:block">
                        <table class="mt-4 table-fixed w-full">
                            <thead>
                                <tr>
                                    <th class="w-1/2 text-left">Date</th>
                                    <th class="w-1/2 text-left">Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phil['weights'] as $weight)
                                    <tr>
                                        <td>{{ $weight->created_at->format('M d') }}</td>
                                        <td>{{ $weight->weight }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full sm:hidden md:block md:w-1/3 xl:w-2/3 md:p-4 md:h-full p-4">
                    <h2 class="text-2xl mb-4">The Chart</h2>

                    <progress-chart :datasets="{{ $data }}" :labels="{{ $labels }}"></progress-chart>
                </div>
                <div class="relative w-full sm:w-1/2 md:w-1/3 xl:w-1/6 p-4 border-l border-gray-300 sm:h-full bg-gray-100">
                    <h2 class="relative text-2xl mb-4">
                        Dave
                        <div class="absolute text-base bottom-0 pb-1 right-0">
                            @if($dave['today'])
                                Today: {{ $dave['today']->weight }}@if($dave['change'])({{ $dave['change'] }})@endif
                            @else
                                Enter your weight
                            @endif
                        </div>
                    </h2>

                    <form action="/user/1/weight" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="1">
                        <div class="relative">
                            <input type="text" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <button type="submit" class="absolute right-0 top-0 p-2"><span class="sr-only">Submit</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="h-6 w-6"><path d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601 0-5.302-4.299-9.6-9.6-9.6zm-.001 17.2a7.6 7.6 0 1 1 0-15.2 7.6 7.6 0 1 1 0 15.2zM10 8H6v4h4v2.5l4.5-4.5L10 5.5V8z"/></svg>
                            </button>
                        </div>
                    </form>

                    <div class="hidden sm:block">
                        <table class="mt-4 table-fixed w-full">
                            <thead>
                                <tr>
                                    <th class="w-1/2 text-left">Date</th>
                                    <th class="w-1/2 text-left">Weight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dave['weights'] as $weight)
                                    <tr>
                                        <td>{{ $weight->created_at->format('M d') }}</td>
                                        <td>{{ $weight->weight }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
