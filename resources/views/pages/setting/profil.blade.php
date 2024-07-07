@extends('pages.setting.layout')

@section('title', 'Pengaturan Profil | Gallery')

@section('sub_title', 'Profil')

@section('setting_content')
    <div class="px-3">

        <form action="{{ url('setting/profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-label fs-14px fw-semibold" for="profil">Foto Profil</label>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-light rounded-circle" style="width: 100px; height: 100px">
                        <img class="w-100 h-100 object-fit-cover rounded-circle image-preview" src="{{ asset('storage/profil/' . $user->profil) }}" alt="{{ $user->profil }}" style="transition: 0.2s ease">
                        <input hidden type="file" id="profil" class="form-control form-control-file" name="profil" accept="image/png, image/jpeg, image/gif" onchange="profilChangeHandler(event)" />
                        <input hidden type="text" class="form-control form-control-file profil-saat-ini" name="profil-saat-ini" value="{{ $user->profil }}" />
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger rounded-circle btn-clear-preview d-none" style="height: 39px; width: 39px; transition: 0.2s ease; opacity: 0;"><i class="fa fa-regular fa-xmark"></i></button>
                        <label for="profil" class="btn border btn-pilih-gambar rounded-pill fs-13px fw-semibold px-4 py-2">
                            @if ($user->profil != 'default.png')
                                Ubah Gambar
                            @else
                                Tambah Gambar
                            @endif
                        </label>
                        @if ($user->profil != 'default.png')
                            <button type="button" class="btn btn-light text-dark rounded-pill fs-13px fw-semibold btn-reset-profile px-4 py-2" currentImage="{{ asset('storage/profil/' . $user->profil) }}" style="transition: 0.2s ease; opacity: 1;">Hapus Gambar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label fs-14px fw-semibold">Nama lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-lg rounded-pill fs-14px @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $user->nama_lengkap) }}">
                @error('nama_lengkap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fs-14px fw-semibold" for="bio">Bio</label>
                <textarea placeholder="optional" class="form-control form-textarea rounded-4 p-3 fs-14px" style="resize: vertical" name="bio" id="bio" cols="30" rows="5">{{ $user->bio }}</textarea>
            </div>
            <div class="d-flex justify-content-end">
                <div>
                    <button class="btn fs-14px btn-dark rounded-pill fw-semibold mb-3 btn-submit px-4 py-2">Simpan <i class="fa-duotone fa-spinner-third fa-spin" style="opacity: 0; width: 0"></i></button>
                </div>
            </div>
        </form>
    </div>
    <script>
        let imagePreview = document.querySelector('.image-preview');
        let btnClearPreview = document.querySelector('.btn-clear-preview');
        let btnClearProfile = document.querySelector('.btn-reset-profile');

        function profilChangeHandler(event) {
            btnClearPreview.classList.remove('d-none');
            setTimeout(() => {
                btnClearPreview.style.opacity = 0;
                imagePreview.style.opacity = 0;
                setTimeout(() => {
                    imagePreview.src = URL.createObjectURL(event.target.files[0]);
                    imagePreview.onload = function() {
                        imagePreview.style.opacity = 1;
                        URL.revokeObjectURL(imagePreview.src);
                    }
                    btnClearPreview.style.opacity = 1;
                }, 200);
            }, 200);
        }

        btnClearPreview.addEventListener('click', () => {
            btnClearPreview.style.opacity = 0;
            imagePreview.style.opacity = 0;
            setTimeout(() => {
                btnClearPreview.classList.add('d-none');
                imagePreview.src = "{{ asset('storage/profil/' . $user->profil) }}";
                imagePreview.style.opacity = 1;
                document.getElementById('profil').value = "";
            }, 200);
        });

        btnClearProfile.addEventListener('click', () => {
            const profilSaatIni = document.querySelector('.profil-saat-ini');

            let image = "{{ asset('storage/profil/default.png') }}";
            let textButton = "Batal";
            if (btnClearProfile.innerHTML == 'Batal') {
                profilSaatIni.removeAttribute('disabled');
                image = btnClearProfile.getAttribute('currentImage');
                textButton = 'Hapus Gambar';
            } else {
                profilSaatIni.setAttribute('disabled', true);
                image = "{{ asset('storage/profil/default.png') }}";
                textButton = 'Batal';
            }

            btnClearProfile.innerHTML = textButton;
            imagePreview.style.opacity = 0;
            btnClearPreview.style.opacity = 0;
            setTimeout(() => {
                imagePreview.src = image;
                btnClearPreview.classList.add('d-none');
                imagePreview.style.opacity = 1;
            }, 200);
            document.getElementById('profil').value = "";
        });
    </script>
@endsection
