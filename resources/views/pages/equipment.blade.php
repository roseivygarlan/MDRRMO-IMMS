@extends('layouts.baseV2')

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="card">
        <div class="card-body">
            <div class="flex flex-row justify-between items-center">
                <h1 class="font-extrabold text-lg">Equipments List</h1>
                 <div class="flex items-center">
                    @if(auth()->user()->type == '1001')
                    <button id="add-button" class="rounded-md btn-bs-success px-3 py-2 text-sm font-semibold ml-2">Add +</button>
                    @endif
                </div>
            </div>
            <div class="flex flex-row gap-5 mt-5">
                <div class="rounded-md shadow-sm">
                    <form method="get">
                        <div class="rounded-md shadow-sm">
                            <input id="search" name="search" type="text" value="{{(request('search') ?? '')}}" placeholder="Search for Equipment" class="py-1 appearance-none block md:w-full px-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 " />
                        </div>
                        @if(request('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                    </form>
                </div>
                <div class="rounded-md shadow-sm">
                    <form method="get">
                        <div class="rounded-md shadow-sm">
                            <input id="filter" name="filter" type="number" value="{{ (request('filter') ?? '') }}" placeholder="Search Ref. Code" class="py-1 appearance-none block md:w-full px-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </form>
                </div>
            </div>
            <table class="table-auto w-full mt-5 text-right overflow">
                <thead>
                    <tr>
                        <td class="py-4 font-extrabold text-sm text-left">equipment name</td>
                        <td class="py-4 font-extrabold text-sm text-left">ref. code</td>
                        <td class="py-4 font-extrabold text-sm text-left">available stock</td>
                        @if(auth()->user()->type == '1001')
                        <td class="py-4 font-extrabold text-sm text-left">action</td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($equipments as $equipment)
                    <tr class="">
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                        {{$equipment->name}}
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left">{{$equipment->refcode}}</td>
                        <td class="py-4 text-xs text-gray-600 text-left"> <span>{{$equipment->quantity}}</span></td>
                         @if(auth()->user()->type == '1001')
                        <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="{{ $equipment->id }}">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-{{ $equipment->id }}">
                                    <a href="#" class="btn btn-sm btn-bs-info stock-equipment w-full" 
                                        data-equipment='@json($equipment)'>stock</a>
                                    <hr>
                                    <button class="btn btn-sm btn-bs-primary view-equipment w-full" 
                                        data-equipment='@json($equipment)'>View</button>
                                    <hr>
                                    <button class="btn btn-sm btn-bs-success edit-equipment w-full" 
                                        data-equipment='@json($equipment)'>Edit</button>
                                    <hr>
                                    <button class="btn btn-sm btn-bs-danger delete-equipment w-full" 
                                        data-equipment-id="{{ $equipment->id }}">Delete</button>
                                    <hr>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-4 text-sm text-red-400 bg-gray-100 font-bold text-center">
                            No data found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('add-button').addEventListener('click', function() {
    Swal.fire({
        title: 'Add Equipment',
        html: `
            <input id="swal-input-name" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Equipment Name">
            <textarea id="swal-input-description" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Description"></textarea>
            <input id="swal-input-quantity" type="number" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Quantity">
            `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Add Equipment',
        preConfirm: () => {
            const name = document.getElementById('swal-input-name').value;
            const description = document.getElementById('swal-input-description').value;
            const quantity = document.getElementById('swal-input-quantity').value;

            return fetch("{{route('user.equipment.store')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name: name,
                    description: description,
                    quantity: quantity,
                })
            }).then(response => {
                if (!response.ok) {
                    return response.json().then(errData => {
                        throw new Error(errData.errors ? JSON.stringify(errData.errors) : response.statusText);
                    });
                }
                return response.json();
            }).then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Added!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    let errorMessage = 'Please fix the following errors:\n';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        errorMessage += `${field}: ${messages.join(', ')}\n`;
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            }).catch(error => {
                Swal.fire('Error!', error.message, 'error');
            });
        }
    });
});

document.querySelectorAll('.view-equipment').forEach(button => {
    button.addEventListener('click', function() {
        const equipment = JSON.parse(this.getAttribute('data-equipment'));
        Swal.fire({
            title: 'Equipment Information',
            html: `
                <strong>Ref. Code:</strong><br>${equipment.refcode}<br><br>
                <strong>Name:</strong><br>${equipment.name}<br><br>
                <strong>Description:</strong><br>${equipment.description} <br><br>
            `,
            icon: 'info',
            confirmButtonText: 'Close',
        });
    });
});

document.querySelectorAll('.edit-equipment').forEach(button => {
    button.addEventListener('click', function() {
        const equipment = JSON.parse(this.getAttribute('data-equipment'));
        Swal.fire({
            title: 'Edit Equipment',
            html: `
                <strong>Ref. Code:</strong><br>${equipment.refcode}<br><br>
                <div class="text-left">Name:</div>
                <input id="swal-input-name" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Name" value="${equipment.name}">
                <div class="text-left">Description:</div>
                <textarea id="swal-input-description" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Description">${equipment.description}</textarea>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            preConfirm: () => {
                const name = document.getElementById('swal-input-name').value;
                const description = document.getElementById('swal-input-description').value;

                return fetch("{{route('user.equipment.update')}}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: equipment.id,
                        name: name,
                        description: description,
                    })
                }).then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.errors ? JSON.stringify(errData.errors) : response.statusText);
                        });
                    }
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Equipment Updated!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        let errorMessage = 'Please fix the following errors:\n';
                        for (const [field, messages] of Object.entries(data.errors)) {
                            errorMessage += `${field}: ${messages.join(', ')}\n`;
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                }).catch(error => {
                    Swal.fire('Error!', error.message, 'error');
                });
            }
        });
    });
});

document.querySelectorAll('.stock-equipment').forEach(button => {
    button.addEventListener('click', function() {
        const equipment = JSON.parse(this.getAttribute('data-equipment'));
        Swal.fire({
            title: 'Add New Stock',
            html: `
                <strong>Equipment:</strong><br>${equipment.name}<br><br>
                <strong>Available Stock:</strong><br>${equipment.quantity}<br><br>
                <div class="text-left">New Stock:</div>
                <input id="swal-input-quantity" type="number" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Quantity of new stock">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Add',
            preConfirm: () => {
                const quantity = document.getElementById('swal-input-quantity').value;

                return fetch("{{route('user.equipment.update.stock')}}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: equipment.id,
                        quantity: quantity,
                    })
                }).then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.errors ? JSON.stringify(errData.errors) : response.statusText);
                        });
                    }
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Stock Added!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        let errorMessage = 'Please fix the following errors:\n';
                        for (const [field, messages] of Object.entries(data.errors)) {
                            errorMessage += `${field}: ${messages.join(', ')}\n`;
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                }).catch(error => {
                    Swal.fire('Error!', error.message, 'error');
                });
            }
        });
    });
});

document.querySelectorAll('.delete-equipment').forEach(button => {
    button.addEventListener('click', function() {
        const eqId = this.getAttribute('data-equipment-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/user/equipment/destroy/${eqId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Close'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                }).catch(error => {
                    Swal.fire('Error!', error.message, 'error');
                });
            }
        });
    });
});

</script>
@endpush
