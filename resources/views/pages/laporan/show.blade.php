<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table td img{
            width: 400px !important;
            height: 300px !important;
            border-radius: 20px !important;
        }
    </style>
    @endpush
    @push('js')
    <script src="{{ asset('') }}assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('') }}assets/js/select2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.tahun').datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
        $('.bulan').datepicker({
            format: "mm",
            viewMode: "months",
            minViewMode: "months"
        });
    </script>
    @endpush
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4 class="card-title pt-2">{{ ucwords($title) }}</h4>
                            <div class="mx-3">
                                        <!-- Menampung id/parameter  -->
                                        <a href="{{ route('laporan.lapshowpdf',$data->id) }}" type="button" class="btn btn-danger btn-icon-text">
                                            <i class="ti-printer btn-icon-prepend"></i>
                                            Cetak PDF
                                        </a>
                            <div class="mx-3">
                                <button onclick="history.back()" class="btn btn-primary btn-icon-text "><i class="ti-angle-left btn-icon-prepend"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td width="20%">NAK - NIK</td>
                                        <td width="1%">:</td>
                                        <td >{{ ucwords($data->nipl) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Kendaraan</td>
                                        <td width="1%">:</td>
                                        <td >{{ ucwords($data->kendaraan->nopol) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Nama Anggota</td>
                                        <td width="1%">:</td>
                                        <td >{{ ucwords($data->nama) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Laporan</td>
                                        <td width="1%">:</td>
                                        <td >{{ ucwords($data->isi) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Tanggal Laporan </td>
                                        <td width="1%">:</td>
                                        <td >{{ date('d M Y', strtotime($data->tanggal )) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Foto Kendaraan</td>
                                        <td width="1%">:</td>
                                        <td >
                                                <img src="{{ $data->foto != null ?  asset('img/barang/'.$data->foto) : asset('assets/images/noimage.png') }}" alt="" class="img-fluid "  id="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
