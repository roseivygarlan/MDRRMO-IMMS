@extends('layouts.baseV2')

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="card">
        <div class="card-body">
            <div class="flex flex-row justify-between items-center">
                <h1 class="font-extrabold text-lg">activity logs</h1>
            </div>

            <table class="table-auto w-full mt-5 text-right">

                <thead>
                    <tr>
                        <td class="py-4 font-extrabold text-sm text-left">Activity</td>
                        @if(auth()->user()->type <> '1010')
                        <td class="py-4 font-extrabold text-sm text-left">User Name</td>
                        @endif
                        <td class="py-4 font-extrabold text-sm text-left">Date</td>
                    </tr>
                </thead>

                <tbody>

                    <!-- item -->
                    <tr class="">
                        @if(auth()->user()->type <> '1010')
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            Delete item 1 ref. code: 112<span class="num-2"></span>
                        </td>
                        @else
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            Barrowed item 1 ref. code: 112<span class="num-2"></span>
                        </td>
                        @endif
                        @if(auth()->user()->type <> '1010')
                        <td class="py-4 text-xs text-gray-600 text-left">User1</td>
                        @endif
                        <td class="py-4 text-xs text-gray-600 text-left">September 1, 2024 01:00 PM</td>
                        <!-- <td class="p-6 whitespace-nowrap flex flex-row px-6 py-4 gap-5 text-xs text-gray-600"> 
                            <a href="#" class="btn-gray bg-green-500 hover:bg-green-700 py-2 px-4 rounded-md">restock</a>
                            <a href="" class="btn btn-sm ">view</a>
                            <a href="" class="btn btn-sm ">edit</a>
                            <a href="" class="btn btn-sm ">delete</a>
                        </td> -->
                    </tr>
                    <!-- end item -->

                    <!-- item -->
                    <tr class="">
                        @if(auth()->user()->type <> '1010')
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            Stored a new item 2 ref. code: 112<span class="num-2"></span>
                        </td>
                        @else
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            Returned item 2 ref. code: 112<span class="num-2"></span>
                        </td>
                        @endif
                        @if(auth()->user()->type <> '1010')
                        <td class="py-4 text-xs text-gray-600 text-left">User2</td>
                        @endif
                        <td class="py-4 text-xs text-gray-600 text-left">September 1, 2024 01:10 PM</td>
                        <!-- <td class="p-6 whitespace-nowrap flex flex-row px-6 py-4 gap-5 text-xs text-gray-600"> 
                            <a href="#" class="btn-gray bg-green-500 hover:bg-green-700 py-2 px-4 rounded-md">restock</a>
                            <a href="" class="btn btn-sm ">view</a>
                            <a href="" class="btn btn-sm ">edit</a>
                            <a href="" class="btn btn-sm ">delete</a>
                        </td> -->
                    </tr>
                    <!-- end item -->

                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
