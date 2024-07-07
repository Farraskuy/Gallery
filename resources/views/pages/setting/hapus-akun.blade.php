@extends('pages.layout')

@section('title', 'Hapus Akun | Gallery')

@section('section')
    <section class="bg-light row g-0 justify-content-center align-content-center p-0 p-md-5 bg-light min-vh-100">
        <div class="bg-white shadow-sm rounded col col-md-4 px-5 py-3">
            <img src="{{ asset('assets/images/17222031_v991-a-25-b-removebg-preview.png') }}" alt="" class="mb-3 img-fluid object-fit-contain">
            <h1 class="fw-semibold">Kami Bersedih kamu akan pergi</h1>
            <p>Terima kasih telah bergabung dengan kami sebelumnya.</p>
            <p>Harap diperhatikan, menghapus akun berarti menghapus segala yang ada dalam akun dan tidak dapat dikembalikan/dipulihkan kembali dengan cara apapun.</p>
            <button class="btn fs-14px btn-dark rounded-pill fw-semibold mb-3 px-4 py-2" onclick="window.location.href = '{{ url('setting') }}'">Batalkan</button>
            <button class="btn fs-14px border rounded-pill fw-semibold mb-3 px-4 py-2" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal">Hapus Akun</button>
        </div>
    </section>

    <div class="modal modal-lg fade" tabindex="-1" id="confirm-delete-modal">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
            <form method="POST" class="modal-content" style="min-height: 250px; width: 500px">
                @csrf
                <div class="p-5 d-flex align-items-center flex-column">
                    <i class="fa-regular fa-triangle-exclamation text-danger fs-1 mb-3"></i>
                    <h5 class="fw-semibold text-center">Apakah kamu yakin, ingin menghapus akun?</h5>
                    <p class="fs-14px text-center">Harap diperhatikan, menghapus akun berarti menghapus segala yang ada dalam akun dan tidak dapat dikembalikan/dipulihkan kembali dengan cara apapun.</p>
                    <button class="w-100 btn btn-danger fs-14px border rounded-pill fw-semibold mb-3 px-4 py-2 btn-submit" >Hapus Akun</button>
                    <button type="button" data-bs-dismiss="modal" class="w-100 btn fs-14px border rounded-pill fw-semibold mb-3 px-4 py-2" >Batalkan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
