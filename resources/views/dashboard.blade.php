
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bodyContainer">

        @if (auth()->user()->isAdmin ==0)

        <h1 class="tableTitle p-3">{{__('Mijn Baby Lijsten')}}</h1>

            <form action="{{ route('makeList') }}" method="GET" class="btnMakeListForm">
                <button type="submit" class="btnMakelist text-lg rounded bg-[#51B1DB] font-bold text-white shadow-md  shadow-white">
                    {{__("Maak Een Lijst!")}}
                </button>
            </form>

            @if (count($lists) == 0)
                <div class="listsContainer">
                    <h1 class="text-white">{{__('Nog Geen Baby Lijsten')}}</h1>
                </div>
            @endif

            @foreach ($lists as $item)
                <div class="listsContainer ">
                    <div class="listCard lg:w-1/4 md:w-2/5 sm:w-4/5 m-auto bg-white color-[#001220]">
                        <h1 class="">{{$item->listName}}</h1>

                        <a href="{{'list/'.$item->id}}">{{__('Bekijk de Lijst')}}</a>
                    </div>
                </div>
            @endforeach

        @endif
        @if (auth()->user()->isAdmin ==1)
            <h1 class="tableTitle p-3">{{__('Alle Baby Lijsten')}}</h1>
            <table class="tableCats">
                <tr class="tableCels">
                    <th>{{__('Lijst Naam')}}</th>
                    <th>{{__('Email Maker')}}</th>
                    <th>{{__('Verwijderen')}}</th>
                </tr>
                @foreach ($lists as $item)
                    <tr class="tableCels">
                        <td>{{ $item->listName }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>
                            <form method="POST" action="deleteList/{{$item->id}}">
                                @csrf
                                <button type="submit" class="btnCats bg-[#990e0e]">{{__('Verwijder Lijst')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </>
</x-app-layout>
