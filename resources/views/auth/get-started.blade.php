@extends('auth.layout')

@section('title', 'Daftar | Gallery')
@section('auth_section')
    <div class="container-fluid p-0 min-vh-100">
        <div class="h-100 row g-0 register-container">
            <div class="col-12 col-sm-3 banner">
                <img style="opacity: 0.5" class="h-100 w-100 object-fit-cover" src="{{ asset('assets/images') }}/gray_line_drawings_of_organic_shapes_background.jpg" alt="gray_line_drawings_of_organic_shapes_background">
                <div class="position-absolute mask-text-logo p-4">
                    <h1 class="m-0 me-3 fw-bold fs-2"><a class="text-dark text-decoration-none" href="{{ url('/') }}">Gallery</a></h1>
                </div>
            </div>
            <div class="col-12 col-sm-9 d-flex justify-content-center justify-content-lg-start align-items-sm-center pt-4 ps-lg-5 form">
                <div class="col-10 col-md-9 col-xl-7 p-0 ps-lg-6">
                    <h3 class="fw-medium m-0">Selamat Datang, di <span class="fw-bold">Gallery</span></h3>
                    <h5>Ayo buat profilmu terlebih dahulu</h5>
                    <p class="my-4">agar orang lain dapat mengenalmu dengan baik</p>

                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="profil">Tambahkan Profil</label>
                            <div class="d-flex align-items-center gap-5">
                                <div style="width: 150px; height: 150px">
                                    <img class="w-100 h-100 object-fit-cover rounded-circle image-preview" src="{{ asset('storage/profil/' . ($user->profil ? $user->profil : 'default.png')) }}" alt="{{ $user->profil }}" style="transition: 0.2s ease">
                                    <input hidden type="file" id="profil" class="form-control form-control-file" name="profil" accept="image/png, image/jpeg, image/gif" onchange="profilChangeHandler(event)" />
                                </div>
                                <div>
                                    <label for="profil" class="btn btn-outline-secondary btn-pilih-gambar rounded-pill fs-14px fw-semibold px-3">
                                        Pilih Gambar
                                    </label>
                                    <button type="button" class="btn btn-danger rounded-circle btn-clear-preview" style="transition: 0.2s ease; opacity: 0;"><i class="fa fa-regular fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="bio">Bio</label>
                            <textarea placeholder="optional" class="form-control form-textarea fs-14px" style="resize: vertical" name="bio" id="bio" cols="30" rows="5">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div>
                                <button type="button" onclick="window.location.href = '{{ url('/') }}'" class="fs-14px btn btn-outline-secondary rounded-pill fw-semibold fs-6 mb-3 btn-submit">Lewati</button>
                                <button class="fs-14px btn btn-dark rounded-pill fw-semibold fs-6 mb-3 btn-submit">Simpan Profil <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let imagePreview = document.querySelector('.image-preview');
        let btnClearPreview = document.querySelector('.btn-clear-preview');

        function profilChangeHandler(event) {

            imagePreview.opacity = 0;
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.onload = function() {
                imagePreview.opacity = 1;
                URL.revokeObjectURL(imagePreview.src);
            }
            btnClearPreview.style.opacity = 1;
        }

        btnClearPreview.addEventListener('click', () => {
            imagePreview.src = "{{ asset('storage/upload/' . ($user->profil ? $user->profil : 'default.png')) }}";
            document.getElementById('profil').value = "";
            btnClearPreview.style.opacity = 0;
        });
    </script>
@endsection
