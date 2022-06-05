<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>List</title>
</head>
<body class="bodyValidation">
    <h1 class="tableTitle">
        {{$list->listName}}
    </h1>

    <div class="artikelenGrid grid lg:grid-cols-4 md:grid-cols-3  sm:grid-cols-1 lg:w-8/12  md:w-8/12 sm: w-full m-auto text-center bg-white mt-5">
        @foreach ($listArticles as $item)
        <div class="aticleCard p-2 bg-white m-3">

            <div class="imgCont text-center">
                <img class="imgArticle w-2/4 m-auto" src="{{ $item->article->image }}" alt="{{ __('Geen Foto Beschikbaar') }}">
            </div>
            <div>
                <span>{{$item->article->name}}</span> <br>
                <span>{{ __('€ ') . $item->article->price}}</span>
            </div>

            <form method="post" action="store">
                @csrf
                <input type="hidden" name="itemId" value="{{$item->id}}">
                <button class="buttonBuy">{{__('Koop')}}</button>
            </form>

        </div>
        @endforeach
{{--         <table class="tableCats">
            @foreach ($cartItems as $item)
                <tr class="tableCels">
                    <td>{{ $item->name }}</td>
                    <td>{{ '€' . $item->price }}</td>
                    <td>
                        <form method="POST" action="deleteList/{{$item->id}}">
                            @csrf
                            <button type="submit" class="btnCats bg-[#990e0e]">{{__('Verwijder Lijst')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table> --}}
    </div>

</body>
</html>
