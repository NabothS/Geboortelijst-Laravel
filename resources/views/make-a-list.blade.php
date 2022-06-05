<?php

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maak Een Lijst') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">
        <div class="formContainer">
            <form class="makeListForm lg:w-5/12 md:w-8/12 sm:w-11/12" method="POST" action="{{ route('makeList') }}">
                @csrf

                <label for="name">{{__('Naam van lijst')}}</label>
                <input name="name" type="text" required placeholder="Lijst Van Sarah" class="lg:w-5/12 md:w-8/12 sm:w-full">

                <label for="password">{{__('Wachtwoord')}}</label>
                <input name="password" type="password" required class="lg:w-5/12 md:w-8/12 sm:w-full">

                <button type="submit" class="btnMakelist text-lg rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white lg:w-5/12 md:w-8/12 sm:w-full">
                    {{__("Bevestig")}}
                </button>

            </form>
        </div>

    </div>
</x-app-layout>
