@extends('layouts.baseV2')

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="card">
        <div class="card-body">
            <div class="flex flex-row justify-between items-center">
                @if(request()->routeIs('admin.usermanagement.barangay.list') || request()->routeIs('admin.usermanagement.index') || request()->routeIs('admin.usermanagement.all'))
                <h1 class="font-extrabold text-lg"> {{(request()->routeIs('admin.usermanagement.barangay.list'))?'Barangay User List':(request()->routeIs('admin.usermanagement.index') ? 'User List': 'All User List')}}</h1>
                @else
                <h1 class="font-extrabold text-lg"> 
                    @if(request()->routeIs('admin.usermanagement.pending'))
                    Pending Users List
                    @elseif(request()->routeIs('admin.usermanagement.activated'))
                    Activated Users List
                    @elseif(request()->routeIs('admin.usermanagement.deactivated'))
                    Deactivated Users List
                    @elseif(request()->routeIs('admin.usermanagement.blocked'))
                    Blocked Users List
                    @endif
                </h1>
                @endif
                <div class="flex">
                    <a href="{{route('admin.usermanagement.all')}}" class="rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold mr-2">All</a>
                    <a href="{{route('admin.usermanagement.index')}}" class="rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold mr-2">User List</a>
                    <a href="{{route('admin.usermanagement.barangay.list')}}" class="rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold mr-2">Barangay User List</a>
                    <button id="add-user-button" class="rounded-md btn-bs-success px-3 py-2 text-sm font-semibold">Add +</button>
                </div>
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
                        <td class="py-4 font-extrabold text-sm text-left">Name</td>
                        <td class="py-4 font-extrabold text-sm text-left">Email</td>
                        <td class="py-4 font-extrabold text-sm text-left">Position</td>
                        <td class="py-4 font-extrabold text-sm text-left">Status</td>
                        <td class="py-4 font-extrabold text-sm text-left">Action</td>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="py-4 text-sm text-gray-600 flex flex-row items-center text-left">
                            {{ $user->name ?? '' }}
                        </td>
                        <td class="py-4 text-xs text-gray-600 text-left lowercase">{{ $user->email ?? '' }}</td>
                        <td class="py-4 text-xs text-gray-600 text-left">{{ $user->position ?? '' }}</td>
                        <td class="py-4 text-xs text-gray-600 text-left">{{ $user->status ?? '' }}</td>
                        <td class="p-6 flex flex-row px-6 py-4 gap-5 text-xs text-gray-600 text-left">
                            <div class="dropdown relative">
                                <button type="button" class="flex justify-center rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold options-button" data-user-id="{{ $user->id }}">
                                    Options
                                </button>
                                <div class="text-gray-500 options-menu hidden md:mt-2 md:w-sm rounded bg-white shadow-md absolute z-20 mt-1 animated faster" id="options-menu-{{ $user->id }}">
                                    <button class="btn btn-sm btn-bs-primary view-user w-full" data-user='@json($user)'>View</button>
                                    <hr>
                                    <button class="btn btn-sm btn-bs-success edit-user w-full" data-user='@json($user)'>Edit</button>
                                    <hr>
                                    <button class="btn btn-sm btn-bs-danger delete-user w-full" data-user-id="{{ $user->id }}">Delete</button>
                                    <hr>
                                    @if($user->status == "Blocked")
                                    <button class="btn btn-sm btn-bs-secondary block-user w-full" data-user-id="{{ $user->id }}" data-user-status="Activated">Unblock</button>
                                    @elseif($user->status == "Pending" || $user->status == "Deactivated")
                                    <button class="btn btn-sm btn-bs-secondary block-user w-full" data-user-id="{{ $user->id }}" data-user-status="Activated">Activate</button>
                                    @else
                                    <button class="btn btn-sm btn-bs-secondary block-user w-full" data-user-id="{{ $user->id }}" data-user-status="Blocked">Block</button>
                                    @endif
                                    <hr>
                                    @if($user->status != "Deactivated")
                                    <button class="btn btn-sm bg-teal-400 text-white block-user w-full" data-user-id="{{ $user->id }}" data-user-status="Deactivated">Deactivate</button>
                                    @endif
                                </div>
                            </div>
                        </td>
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
    <div class="overflow mt-5">
        @if($paginate == true)
        {{ $users->links() }}
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('add-user-button').addEventListener('click', function() {
        Swal.fire({
            title: 'Add New User',
            html: `
                <input id="swal-input-name" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Name">
                <input id="swal-input-email" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Email">
                <input id="swal-input-phone" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Phone">
                <input id="swal-input-position" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Position">
                <input id="swal-input-address" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Address">
                <input id="swal-input-password" type="password" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Password">
                <select id="swal-input-type" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none border">
                    <option value="" disabled selected>Select role</option>
                    <option value="1111">Administrator</option>
                    <option value="1010">Barangay</option>
                    <option value="1001">User</option>
                </select>`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Add User',
            preConfirm: () => {
                const name = document.getElementById('swal-input-name').value;
                const email = document.getElementById('swal-input-email').value;
                const phone = document.getElementById('swal-input-phone').value;
                const position = document.getElementById('swal-input-position').value;
                const address = document.getElementById('swal-input-address').value;
                const type = document.getElementById('swal-input-type').value;
                const password = document.getElementById('swal-input-password').value;

                return fetch("{{route('admin.usermanagement.store')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        phone: phone,
                        position: position,
                        address: address,
                        type: type,
                        password: password,
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

    document.querySelectorAll('.view-user').forEach(button => {
        button.addEventListener('click', function() {
            const user = JSON.parse(this.getAttribute('data-user'));
            Swal.fire({
                title: 'User Information',
                html: `
                    <strong>Name:</strong> ${user.name} <br>
                    <strong>Email:</strong> ${user.email} <br>
                    <strong>Phone:</strong> ${user.phone} <br>
                    <strong>Position:</strong> ${user.position} <br>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Change Password',
                cancelButtonText: 'Close',
                preConfirm: () => {
                    Swal.fire({
                        title: 'Change User Password',
                        html: `
                            <input id="swal-input-password" type="password" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="New Password">
                            <input id="swal-input-confirm-password" type="password" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Confirmation Password">
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Confirm',
                        preConfirm: () => {
                            const password = document.getElementById('swal-input-password').value;
                            const confirmpassword = document.getElementById('swal-input-confirm-password').value;

                            if(password == confirmpassword){
                                return fetch("{{route('admin.usermanagement.update.password')}}", {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        id: user.id,
                                        password: password,
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
                                            title: 'Password Changed!',
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
                            }else{
                                Swal.fire('Error!', 'Password confirmation not match!', 'error');
                            }
                        }
                    });
                }
            });
        });
    });

    document.querySelectorAll('.edit-user').forEach(button => {
        button.addEventListener('click', function() {
            const user = JSON.parse(this.getAttribute('data-user'));
            Swal.fire({
                title: 'Edit User Information',
                html: `
                    <input id="swal-input-name" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Name" value="${user.name}">
                    <input id="swal-input-email" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Email" value="${user.email}">
                    <input id="swal-input-phone" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Phone" value="${user.phone}">
                    <input id="swal-input-address" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Phone" value="${user.address}">
                    <input id="swal-input-position" class="appearance-none block w-full px-3 py-2 mb-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none" placeholder="Position" value="${user.position}">
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    const name = document.getElementById('swal-input-name').value;
                    const email = document.getElementById('swal-input-email').value;
                    const phone = document.getElementById('swal-input-phone').value;
                    const address = document.getElementById('swal-input-address').value;
                    const position = document.getElementById('swal-input-position').value;

                    return fetch("{{route('admin.usermanagement.update')}}", {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: user.id,
                            name: name,
                            email: email,
                            phone: phone,
                            address: address,
                            position: position
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
                                title: 'User Changed!',
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

    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/usermanagement/destroy/${userId}`, {
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

    document.querySelectorAll('.block-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const status = this.getAttribute('data-user-status');

            Swal.fire({
                title: 'Are you sure?',
                text: "You will change status of this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/usermanagement/update/status/${userId}/${status}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
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
                                title: 'Changed Status!',
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
