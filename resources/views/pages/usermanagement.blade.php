@extends('layouts.baseV2')

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="card">
        <div class="card-body">
            <div class="flex flex-row justify-between items-center">
                <h1 class="font-extrabold text-lg">User Management</h1>
                <button class="rounded-md btn-bs-success px-3 py-2 text-sm font-semibold">Add +</button>
            </div>

            <table class="table-auto w-full mt-5 text-right">

                <div>
                    <label for="search" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Search account</label>
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <form method="get">
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="search" name="search" type="text" value="{{ (request('search') ?? '') }}" placeholder="Search here" class="py-2 appearance-none block w-1/4 md:w-full px-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                        </form>
                    </div>
                </div>

                <thead>
                    <tr>
                        <td class="py-4 font-extrabold text-sm text-left">name</td>
                        <td class="py-4 font-extrabold text-sm text-left">email</td>
                        <td class="py-4 font-extrabold text-sm text-left">phone</td>
                        <td class="py-4 font-extrabold text-sm text-left">position</td>
                        <td class="py-4 font-extrabold text-sm text-left">action</td>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                    <!-- item -->
                    <tr>
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            {{ $user->name ?? '' }}
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left lowercase">{{ $user->email ?? '' }}</td>
                        <td class="py-4 text-xs text-gray-600 text-left">{{ $user->phone ?? '' }}</td>
                        <td class="py-4 text-xs text-gray-600 text-left">{{ $user->position ?? '' }}</td>
                        <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="{{ $user->id }}">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-{{ $user->id }}">
                                    <a href="" class="btn btn-sm btn-bs-primary">view</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-success">edit</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-danger">delete</a>
                                    <hr>
                                    <a href="" class="btn btn-sm btn-bs-secondary">deactivated</a>
                                    <hr>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- end item -->
                    @empty
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
    <div class="overflow mt-5">
        @if($paginate == true)
        {{ $users->links() }}
        @endif
    </div>

</div>
@endsection
