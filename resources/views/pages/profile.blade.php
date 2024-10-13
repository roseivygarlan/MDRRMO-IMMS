@extends('layouts.baseV2')

@push('links')
<style>
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #f255;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all .2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #ff5511;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: url('/img/upload-solid.svg');
        font-family: 'FontAwesome';
        position: absolute;
        width: 20px;
        top: 6px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@endpush

@section('body')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-1">
        <div class="flex flex-col">
            <div class="card ">
               
                <div class="card-body">

                    <h1 class="h6 text-center mt-6">
                        Profile Picture
                    </h1>
                    <div class="avatar-upload">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" required />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                @if(auth()->user()->image == null)
                                <div id="imagePreview" style="background-image: url('../img/no-picture.jpg');"></div>
                                @else
                                <div id="imagePreview" style="background-image: url('../storage/user_profile/{{auth()->user()->image}}');"></div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                                Full Name
                            </label>
                            <div class="rounded-md shadow-sm">
                                <input name="name" id="name" type="text" value="{{auth()->user()->name}}" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 leading-5">
                                Phone (+63)
                            </label>

                            <div class="rounded-md shadow-sm">
                                <input name="phone" id="phone" value="{{auth()->user()->phone}}" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 leading-5">
                            Address (Complete Address)
                        </label>

                        <div class="rounded-md shadow-sm">
                            <input name="address" id="address" value="{{auth()->user()->address}}" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('address') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="position" class="block text-sm font-medium text-gray-700 leading-5">
                            Position
                        </label>

                        <div class="rounded-md shadow-sm">
                            <input name="position" id="position" value="{{auth()->user()->position}}" type="text" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('position') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('position')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            Email address
                        </label>

                        <div class="rounded-md shadow-sm">
                            <input name="email" id="email" type="email" value="{{auth()->user()->email}}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-5 flex flex-row justify-between items-center">
                        <button id="add-user-button" class="rounded-md btn-bs-success px-3 py-2 text-sm font-semibold">Save</button>
                        <button id="change-pass" class="rounded-md btn-bs-dark px-3 py-2 text-sm font-semibold ml-2 change-pass">Change Password</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('/js/jquery.min.js')}}"></script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this);
    });


    document.querySelectorAll('.change-pass').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Change Your Password',
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
                    const userId = {{auth()->user()->id}};
                    
                    if(password == confirmpassword){
                        return fetch("{{(auth()->user()->type == '1111') ? route('admin.profile.update.password') : (auth()->user()->type == '1001' ? route('user.profile.update.password') : route('barangay.profile.update.password'))}}", {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
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
        });
    });
</script>
@endpush
