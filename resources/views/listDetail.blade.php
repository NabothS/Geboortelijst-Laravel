<?php

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Detail') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">
        <h1 class="tableTitle p-3">{{$babyList->listName}}</h1>
        <h1 class="lstURL">{{$babyList->listUrl}}</h1>
        <form action="{{ route('addArticles') }}" method="POST" class="btnMakeListForm">
            @csrf
            <input name="id" type="hidden" value="{{$babyList->id}}">
            <button type="submit" class="btnMakelist text-lg rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">
                {{__("Voeg Artikelen Toe")}}
            </button>
        </form>

        <div class="artikelenGrid grid lg:grid-cols-4 md:grid-cols-3  sm:grid-cols-1 lg:w-8/12  md:w-8/12 sm: w-full m-auto text-center bg-white mt-5">
            @foreach ($articles as $item)
            <div class="aticleCard p-2 bg-white m-3">
                @if (auth()->user()->id == $babyList->userId)
                <form method="POST" action="{{ 'delete/'.$item->id}}">
                    @csrf
                    <button class="trashcanA">
                        <i class="fa-solid fa-trash-can trashcan"></i>
                    </button>
                </form>
                @endif

                <div class="imgCont text-center">
                    <img class="imgArticle w-2/4 m-auto" src="{{ $item->article->image }}" alt="{{ __('Geen Foto Beschikbaar') }}">
                </div>
                <div>
                    <span>{{$item->article->name}}</span> <br>
                    <span>{{ __('€ ') . $item->article->price}}</span>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
