@extends('layouts.baseV2')

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="card">
        <div class="card-body">
            <div class="flex flex-row justify-between items-center">
                <h1 class="font-extrabold text-lg">Equipments List</h1>
                 <div class="flex items-center">
                    <label for="search" class="text-sm font-medium leading-6 text-gray-900 mt-2 mr-5">Search :</label>
                    <div class="relative rounded-md shadow-sm">
                        <form method="get">
                            <div class="ounded-md shadow-sm">
                                <input id="search" name="search" type="text" value="{{(request('search') ?? '')}}" placeholder="Search for Equiptment" class="py-2 appearance-none block w-full  md:w-full px-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 " />
                            </div>
                        </form>
                    </div>
                    @if(auth()->user()->type == '1001')
                    <a href="#" class="btn-bs-success text-sm ml-10">Add +</a>
                    @endif
                </div>
                
            </div>

            <table class="table-auto w-full mt-5 text-right">

                <thead>
                    <tr>
                        <td class="py-4 font-extrabold text-sm text-left">equipment name</td>
                        <td class="py-4 font-extrabold text-sm text-left">ref. code</td>
                        <td class="py-4 font-extrabold text-sm text-left">available quantity</td>
                        @if(auth()->user()->type == '1001')
                        <td class="py-4 font-extrabold text-sm text-left">action</td>
                        @endif
                    </tr>
                </thead>

                <tbody>

                    <!-- item -->
                    <tr class="">
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            item 1
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left">112<span class="num-2"></span></td>
                        <td class="py-4 text-xs text-gray-600 text-left"> <span class="num-3"></span></td>
                         @if(auth()->user()->type == '1001')
                        <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="1">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-1">
                                    <a href="#" class="btn-gray bg-green-500 hover:bg-green-700 py-2 px-4 rounded-md btn-bs-info">stock</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-primary">view</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-success">edit</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-danger">delete</a>
                                    <hr>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <!-- end item -->

                    <!-- item -->
                    <tr class="">
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            item 2
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left">112<span class="num-2"></span></td>
                        <td class="py-4 text-xs text-gray-600 text-left"> <span class="num-3"></span></td>
                        @if(auth()->user()->type == '1001')
                        <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="2">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-2">
                                    <a href="#" class="btn-gray bg-green-500 hover:bg-green-700 py-2 px-4 rounded-md btn-bs-info">stock</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-primary">view</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-success">edit</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-danger">delete</a>
                                    <hr>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <!-- end item -->

                    <!-- item -->
                    <tr class="">
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            item 3
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left">112<span class="num-2"></span></td>
                        <td class="py-4 text-xs text-gray-600 text-left"> <span class="num-3"></span></td>
                         @if(auth()->user()->type == '1001')
                         <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="3">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-3">
                                    <a href="#" class="btn-gray bg-green-500 hover:bg-green-700 py-2 px-4 rounded-md btn-bs-info">stock</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-primary">view</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-success">edit</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-danger">delete</a>
                                    <hr>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <!-- end item -->

                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
