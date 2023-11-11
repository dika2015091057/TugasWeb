@extends('template.templateUser')

@yield('main')
<div class="container mt-5">

    <div class="card row m-2 px-5 pt-5">
        <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data" class=" px-0">
            @csrf
        <div class="col-3 px-0 py m-1" style="height: 300px; width: 300px;">
            <img src="{{ $profile->photo_profile }}" alt="" width="100%" height="100%" class="rounded-4">
            <input type="file" name="photo" accept="image/jpeg, image/png">
        </div>

            <div class="flex d-flex flex-row flex-wrap justify-content-between mt-5 p-1 mb-5">
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Nama </label>
                    <input class=" p-2" type="text" name="name" id="name" placeholder="nama anda" value="{{ $profile->name }}">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Email</label>
                    <input class=" p-2" type="email" name="email" id="email" placeholder="email anda" value="{{ $profile->email }}">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">No.KTP </label>
                    <input class=" p-2" type="text" name="nik" id="nik" placeholder="nik sesuia ktp" value="{{ $profile->nik }}">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Username </label>
                    <input class=" p-2" type="text" name="username" id="username" placeholder="username anda" value="{{ $profile->username }}">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Nomor WA </label>
                    <input class=" p-2" type="text" name="phone_number" id="phone_number" placeholder="nomor wa" value="{{ $profile->phone_number }}">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Password Validasi </label>
                    <input class=" p-2" type="password" name="password" id="password" placeholder="password untuk validasi">
                </div>
                <div class="d-flex flex-column m-2 col-4">
                    <label for="total" class=" text-start">Address </label>
                    <textarea class=" p-2"  name="address" id="address" rows="3" placeholder="alamat anda">{{ $profile->address}}</textarea>
                </div>
                
                <div class="d-flex flex-column m-2 col-2 mt-5 gap-2">
                    <div div class="mb-5 d-flex justify-content-end gap-2 p-2">
                        <label for="loginAdmin" class="">Update Email</label>
                        <input type="checkbox" name="validemail" value="true" id="validemail">
                    </div>
                    <div class=" d-flex justify-content-end">

                        <button type="submit" class="btn btn-primary  px-5">Simpan</button>
                    </div>
                </div>
            </div>


        </form>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class=" d-flex col-6 mb-3 offset-6 d-flex justify-content-end align-items-center">
                <button class="btn btn-danger px-5" type="submit">Logout</button>
            </div>
        </form>
    </div> 
</div>
