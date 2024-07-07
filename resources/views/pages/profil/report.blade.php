@extends('pages.profil.profil-layout')

@section('title', $user->nama_lengkap . ' Report | Gallery')

@section('content')
    <section>
        <div class="h-100 w-100 pb-5" style="min-height: 500px;">
            <p class="fs-14px fw-semibold m-0" id="report"></p>
            <div class="d-flex flex-wrap bg-light rounded fw-semibold mb-4">
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-images me-2"></i>
                        <span>{{ convertNumberToShortFormat($userReport->total_album) }}</span>
                    </div>
                    <p class="m-0 fs-14px">Total album dibuat</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-image me-2"></i>
                        <span>{{ convertNumberToShortFormat($userReport->total_foto) }}</span>
                    </div>
                    <p class="m-0 fs-14px">Total foto dibuat</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-heart me-2"></i>
                        <span>{{ convertNumberToShortFormat($userReport->total_like) }}</span>
                    </div>
                    <p class="m-0 fs-14px">Total like diperoleh</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-comment me-2"></i>
                        <span>{{ convertNumberToShortFormat($userReport->total_komentar) }}</span>
                    </div>
                    <p class="m-0 fs-14px">Total komentar diperoleh</p>
                </div>
            </div>
            {{-- <p class="fs-14px fw-semibold m-0">Data</p> --}}
            <form onchange="this.submit()" class="d-flex gap-2 justify-content-end mb-2" action="{{ url()->current() . '#report' }}">
                <select class="form-select fs-14px" name="order_by">
                    <option {{ request()->query('order_by') == '' ? 'selected' : '' }} value="">Urutkan berdasarkan</option>
                    <option {{ request()->query('order_by') == 'jumlah_foto' ? 'selected' : '' }} value="jumlah_foto">Jumlah Foto</option>
                    <option {{ request()->query('order_by') == 'jumlah_like' ? 'selected' : '' }} value="jumlah_like">Jumlah Like</option>
                    <option {{ request()->query('order_by') == 'jumlah_komentar' ? 'selected' : '' }} value="jumlah_komentar">Jumlah Komentar</option>
                    <option {{ request()->query('order_by') == 'created_at' ? 'selected' : '' }} value="created_at">Tanggal Album Dibuat</option>
                </select>
                @if (request()->query('order_by'))
                    <label for="asc" class="btn btn border {{ request()->query('direction', 'desc') == 'asc' ? 'd-none' : '' }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dari bawah ke atas"><i class="fa-solid fa-arrow-up-wide-short"></i></label>
                    <input type="radio" name="direction" value="asc" id="asc" {{ request()->query('direction', 'desc') == 'asc' ? 'checked' : '' }} hidden>
                    <label for="desc" class="btn btn border {{ request()->query('direction', 'desc') == 'desc' ? 'd-none' : '' }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dari atas ke bawah"><i class="fa-solid fa-arrow-down-short-wide"></i></label>
                    <input type="radio" name="direction" value="desc" id="desc" {{ request()->query('direction', 'desc') == 'desc' ? 'checked' : '' }} hidden>
                @else
                    <label for="asc" class="btn btn border" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dari bawah ke atas"><i class="fa-solid fa-arrow-up-wide-short"></i></label>
                    <input type="radio" name="direction" value="asc" id="asc" hidden>
                    <label for="desc" class="btn btn border d-none" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dari atas ke bawah"><i class="fa-solid fa-arrow-down-short-wide"></i></label>
                    <input type="radio" name="direction" value="desc" id="desc" checked hidden>
                @endif
            </form>
            <div class="table-responsive ">
                <table class="table fs-14px align-middle">
                    <thead class="text-start">
                        <th class="fit">No</th>
                        <th>Album</th>
                        <th class="fit">Jumlah Foto</th>
                        <th class="fit">Jumlah Like</th>
                        <th class="fit">Jumlah Komentar</th>
                        <th class="fit">Tanggal Dibuat</th>
                    </thead>
                    <tbody>
                        @foreach ($userReportDetail as $album)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ url('album/' . $album->id) }}" class="d-flex gap-2 text-decoration-none">
                                        <div class="border rounded-3 p-1">
                                            <img src="{{ asset('storage/upload/' . $album->thumbnail) }}" alt="{{ $album->thumbnail }}" class="object-fit-cover rounded-2" width="50" height="50">
                                        </div>
                                        <div class="d-flex justify-content-center flex-column">
                                            <p class="fw-semibold fs-15px judul-foto wrap-text m-0 text-dark" style="-webkit-line-clamp:1">{{ $album->nama_album }}</p>
                                            <p class="fs-14px judul-foto wrap-text m-0 text-dark" style="-webkit-line-clamp:2">{{ $album->deskripsi }}</p>
                                        </div>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-image"></i> {{ convertNumberToShortFormat($album->jumlah_foto) }} </p>
                                </td>
                                <td class="text-center">
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-heart"></i> {{ convertNumberToShortFormat($album->jumlah_like) }} </p>
                                </td>
                                <td class="text-center">
                                    <p class="m-0 fw-semibold"><i class="fa-solid fa-comment"></i> {{ convertNumberToShortFormat($album->jumlah_komentar) }} </p>
                                </td>
                                <td class="fit" style="white-space: normal">
                                    <div>
                                        <p class="m-0 text-start text-nowrap" style="width: fit-content">
                                            {{ dateFormatFromTimestamp('d F Y', strtotime($album->created_at)) }}
                                        </p>
                                        <p class="m-0 text-start" style="width: fit-content">
                                            {{ dateFormatFromTimestamp('H:i:s', strtotime($album->created_at)) }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $userReportDetail->onEachSide(5)->links('pagination::bootstrap-5') }}
                </div>
            </div>
            {{-- <div class="my-4" style="width: fit-content;">
                <p class="fs-14px fw-semibold m-0">Dalam waktu</p>
                <div id="reportrange" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa-regular fa-calendar"></i>&nbsp;
                    <span class="fs-14px"></span> <i class="fa-solid fa-caret-down"></i>
                    <form class="form-input" action="{{ url()->current() . '#report' }}">
                        <input type="text" name="waktu" id="waktu" hidden>
                    </form>
                </div>
            </div>
            
            <div class="d-flex flex-wrap border-top border-bottom">
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-images me-2"></i>
                        <span>{{ convertNumberToShortFormat($user->album_count) }}</span>
                    </div>
                    <p class="m-0 fs-14px">album dibuat</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-image me-2"></i>
                        <span>{{ convertNumberToShortFormat($user->foto_count) }}</span>
                    </div>
                    <p class="m-0 fs-14px">foto dibuat</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-heart me-2"></i>
                        <span>{{ convertNumberToShortFormat($user->total_like) }}</span>
                    </div>
                    <p class="m-0 fs-14px">like diperoleh</p>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-grow-1 flex-column p-3">
                    <div>
                        <i class="fa-solid fa-comment me-2"></i>
                        <span>{{ convertNumberToShortFormat($user->total_komentar) }}</span>
                    </div>
                    <p class="m-0 fs-14px">komentar diperoleh</p>
                </div>
            </div> --}}
        </div>
    </section>

    {{-- <script>
        var start = moment().startOf('month');
        var end = moment();

        function cb(start, end) {
            console.log(start, end);
            $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
            $('#waktu').val(start.format('YYYY/M/D') + ' - ' + end.format('YYYY/M/D'));
        }

        cb(start, end);

        $('#reportrange').daterangepicker({
            locale: {
                cancelLabel: 'Bersih',
                applyLabel: 'Pilih'
            },
            startDate: start,
            endDate: end,
            maxDate: end,
            buttonClasses: "btn btn-sm",
            ranges: {
                'Hari ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 hari yang lalu': [moment().subtract(6, 'days'), moment()],
                '30 hari yang lalu': [moment().subtract(29, 'days'), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        $('#reportrange').on('apply.daterangepicker', function() {
            document.querySelector('.form-input').submit();
        });
    </script> --}}
@endsection
