<?php

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikelen') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">
        <div class="fixedBox">
            <h1>{{ __('Shops') }}</h1>

            <div class="shopLink">
                <a class="mimiLink" href="#mimi" >
                    {{ __('Mimi Baby') }}
                </a>
            </div>
            <div class="shopLink">
                <a class="mimiLink" href="#kabine" >
                    {{ __('Kabine') }}
                </a>
            </div>
            <div class="shopLink">
                <a class="mimiLink" href="#corner" >
                    {{ __('Baby Corner') }}
                </a>
            </div>
        </div>

        <h1 id="mimi" class="tableTitle p-3">{{__("Mimi Baby")}}</h1>
        <div class="artikelenGrid grid lg:grid-cols-4 md:grid-cols-3  sm:grid-cols-1 lg:w-8/12  md:w-8/12 sm: w-full m-auto text-center bg-white mt-5">
            @if (count($mimiArticles) == 0)
                <div class="">
                    <h1>{{__('Nog Geen Artikelen Gescraped')}}</h1>
                </div>



            @endif
            @foreach ($mimiArticles as $item)
            <form action="{{ route('add') }}" method="POST">
                @csrf
                <div class="aticleCard p-2 bg-white m-3">
                    <div class="imgCont text-center">
                        <img class="imgArticle w-2/4 m-auto" src="{{ $item->image }}" alt="{{ __('Geen Foto Beschikbaar') }}">
                    </div>
                    <div>
                        <span>{{$item->name}}</span> <br>
                        <span>{{ __('€ ') . $item->price}}</span>

                    </div>
                    <input name="id" type="hidden" value="{{$id}}">
                    <input name="articleId" type="hidden" value="{{$item->id}}">
                    <button type="submit" class="text-md p-2 rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">Voeg Toe</button>
                </div>
            </form>
            @endforeach
        </div>

        <h1 id="kabine" class="tableTitle p-3">{{__("Kabine")}}</h1>
        <div class="artikelenGrid grid lg:grid-cols-4 md:grid-cols-3  sm:grid-cols-1 lg:w-8/12  md:w-8/12 sm: w-full m-auto text-center bg-white mt-5">

            @if (count($kabineArticles) == 0)
                <div class="">
                    <h1>{{__('Nog Geen Artikelen Gescraped')}}</h1>
                </div>

            @endif
            @foreach ($kabineArticles as $item)
            <form action="{{ route('add') }}" method="POST">
                @csrf
                <div class="aticleCard p-2 bg-white m-3">
                    <div class="imgCont text-center">
                        <img class="imgArticle w-2/4 m-auto" src="{{ $item->image }}" alt="{{ __('Geen Foto Beschikbaar') }}">
                    </div>
                    <div>
                        <span>{{$item->name}}</span> <br>
                        <span>{{ __('€ ') . $item->price}}</span>

                    </div>
                    <input name="id" type="hidden" value="{{$id}}">
                    <input name="articleId" type="hidden" value="{{$item->id}}">
                    <button type="submit" class="text-md p-2 rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">Voeg Toe</button>
                </div>
            </form>
            @endforeach
        </div>

        <h1 id="corner" class="tableTitle p-3">{{__("Baby Corner")}}</h1>
        <div class="artikelenGrid grid lg:grid-cols-4 md:grid-cols-3  sm:grid-cols-1 lg:w-8/12  md:w-8/12 sm: w-full m-auto text-center bg-white mt-5">

            @if (count($cornerArticles) == 0)
                <div class="">
                    <h1>{{__('Nog Geen Artikelen Gescraped')}}</h1>
                </div>

            @endif
            @foreach ($cornerArticles as $item)
            <form action="{{ route('add') }}" method="POST">
                @csrf
                <div class="aticleCard p-2 bg-white m-3">
                    <div class="imgCont text-center">
                        <img class="imgArticle w-2/4 m-auto" src="{{ $item->image }}" alt="{{ __('Geen Foto Beschikbaar') }}">
                    </div>
                    <div>
                        <span>{{$item->name}}</span> <br>
                        <span>{{ __('€ ') . $item->price}}</span>

                    </div>
                    <input name="id" type="hidden" value="{{$id}}">
                    <input name="articleId" type="hidden" value="{{$item->id}}">
                    <button type="submit" class="text-md p-2 rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">Voeg Toe</button>
                </div>
            </form>
            @endforeach
        </div>

    </div>
</x-app-layout>
