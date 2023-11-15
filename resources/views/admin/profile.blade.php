@extends('template.templateAdmin')
@section('profile', 'active')

@section('main')
    <section class="row gap-4 me-2">

        {{-- Section header Body --}}
        <div class="card row shadow" style="background-color: #F5F5F5;">
            <div class="col-12 head-card mb-3 mt-1">
                <h2>Profile Admin</h2>
                <p><a href="/" class="text-black text-decoration-none">Home</a> > <a href="/adminprofile"
                        class="text-decoration-none text-gray-900">Profile</a></p>
            </div>
        </div>

        {{-- Section Body --}}
        <div class="card row shadow  " style="background-color: #F5F5F5;">
            <div class="card row m-2 px-5 pt-5  border-0" style="background-color: #F5F5F5;" >

                <header>
                    <form action="{{ route('logout') }}" method="POST"  class=" px-0 ">
                        @csrf
                        @method('DELETE')
                        <div class=" d-flex col-6 mb-1 offset-6 d-flex justify-content-end align-items-center">
                            <button class="btn btn-danger px-5" type="submit">Logout</button>
                        </div>
                    </form>
                </header>

                <form action="{{ route('updateAdmin') }}" method="post" enctype="multipart/form-data" class=" px-0 mb-4 ">
                @csrf
                <div class="col-3 px-0 py m-1" style="height: 300px; width: 300px;">
                    <img src="{{ $admin->photo_profile }}" alt="" width="100%" height="100%" class="rounded-4">
                    <input type="file" name="photo" accept="image/jpeg, image/png">
                </div>

                <div class="flex d-flex flex-row flex-wrap justify-content-between mt-5 p-1 mb-2">
                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Username/Nama Toko </label>
                        <input class=" p-2" type="text" name="username" id="username" placeholder="username anda"
                            value="{{ $admin->username }}">
                    </div>
                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Email</label>
                        <input class=" p-2" type="email" name="email" id="email" placeholder="email anda"
                            value="{{ $admin->email }}">
                    </div>
                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Pemilik</label>
                        <input class=" p-2" type="text" name="owner" id="owner" placeholder="nama pemilik toko"
                            value="{{ $admin->owner }}">
                    </div>

                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Nomor WA </label>
                        <input class=" p-2" type="text" name="phone_number" id="phone_number" placeholder="nomor wa"
                            value="{{ $admin->phone_number }}">
                    </div>

                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Address </label>
                        <textarea class=" p-2" name="address" id="address" rows="3" placeholder="alamat anda">{{ $admin->address }}</textarea>
                    </div>
                    <div class="d-flex flex-column m-2 col-4">
                        <label for="total" class=" text-start">Password Validasi </label>
                        <input class=" p-2" type="password" name="password" id="password"
                            placeholder="password untuk validasi">
                    </div>
                </div>
                <div class=" row d-flex flex-column m-2 mt-5 gap-2 justify-content-end">
                    <div div class="mb-5 d-flex justify-content-end gap-2 p-2">
                        <label for="loginAdmin" class="">Update Email</label>
                        <input type="checkbox" name="validemail" value="true" id="validemail">
                    </div>
                    <div class=" d-flex justify-content-end px-0">
                        <button type="submit" class="btn btn-primary  px-5">Simpan</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </section>



@endsection
