<?php

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scraper') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">
        <form method="POST" action="{{ route('scrape.categories') }}" class="flex justify-center items-center flex-col h-5/6 mt-40">
            @csrf
            <select name="shop" class="w-2/5 p-2 text-lg rounded-lg mb-20">
                @foreach ($shops as $shop)
                    <option value="{{ $shop->url }}">{{$shop->name}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn p-2  w-2/5 text-lg rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">Scrape</button>
        </form>

    </div>
</x-app-layout>
