<?php

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorieën') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">
        <h2 class="tableTitle p-3">Mimi Baby</h2>
        <table class="tableCats">
            @foreach ($mimiCategories as $category)
                <tr class="tableCels">
                    <td>{{ $category->category }}</td>
                    <td>
                        <form method="POST" action="{{ route('scrape.articles')}}">
                            @csrf
                            <button type="submit" class="btnCats bg-[#51B1DB]">Scrape all articles</button>
                            <input type="hidden" name="url" value="{{ $category->url }}">
                            <input type="hidden" name="category" value="{{ $category->category }}">
                            <input type="hidden" name="shop" value="{{ $category->shopName }}">

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h2 class="tableTitle p-3">Kabine</h2>
        <table class="tableCats">
            @foreach ($kabineCategories as $category)
                <tr class="tableCels">
                    <td>{{ ucfirst($category->category) }}</td>
                    <td>
                        <form method="POST" action="{{ route('scrape.articles')}}">
                            @csrf
                            <button type="submit" class="btnCats bg-[#51B1DB]">Scrape all articles</button>
                            <input type="hidden" name="url" value="{{ $category->url }}">
                            <input type="hidden" name="category" value="{{ $category->category }}">
                            <input type="hidden" name="shop" value="{{ $category->shopName }}">

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h2 class="tableTitle p-3">Baby Corner</h2>
        <table class="tableCats">
            @foreach ($cornerCategories as $category)
                <tr class="tableCels">
                    <td>{{ $category->category }}</td>
                    <td>
                        <form method="POST" action="{{ route('scrape.articles')}}">
                            @csrf
                            <button type="submit" class="btnCats bg-[#51B1DB]">Scrape all articles</button>
                            <input type="hidden" name="url" value="{{ $category->url }}">
                            <input type="hidden" name="category" value="{{ $category->category }}">
                            <input type="hidden" name="shop" value="{{ $category->shopName }}">

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
