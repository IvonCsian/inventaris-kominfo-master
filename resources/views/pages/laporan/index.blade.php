<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table td img{
            width: 200px !important;
            height: 200px !important;
            border-radius: 0 !important;
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
                @include('components.notification')
                <div class="row">
                    <div class="card mb-4 col-md-8 mx-auto">
                        <div class="card-body">
                            <form action="{{ route('laporan.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tahun </label>
                                            <input type="text" data-provide="tahun" name="tahun" value="{{ request('tahun') }}" class="form-control tahun @error('bulan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Tahun">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Bulan </label>
                                            <input type="text" data-provide="bulan" name="bulan" value="{{ request('bulan') }}" class="form-control bulan @error('bulan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Bulan">
                                        </div>
                                    </div>
                                    <div class="col-md-2 align-self-center p-0">
                                        <button type="submit" class="btn btn-primary btn-icon-text w-100">
                                            <i class="ti-filter btn-icon-prepend"></i>
                                            Filter
                                        </button>
                                    </div>
                                    <div class="col-md-2 align-self-center p-1">
                                        <a href="{{ route('laporan.pdf') }}" type="button" class="btn btn-danger btn-icon-text w-100">
                                            <i class="ti-printer btn-icon-prepend"></i>
                                            Cetak PDF
                                        </a>
                                    </div>
                                    <div class="col-md-2 align-self-center p-1">
                                        <a href="{{ route('laporan.index') }}" class="btn btn-outline-danger btn-icon-text w-100">
                                            <i class="ti-shift-left btn-icon-prepend"></i>
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4 class="card-title pt-2">{{ ucwords($title) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>NAK - NIK</th>
                                  <th>Nama Anggota</th>
                                  <th>Kendaraan</th>
                                  <th>isi</th>
                                  <th>Tanggal Laporan</th>
                                  <th>Status</th>
                                  @if (auth()->user()->role != 'anggota')
                                  <th>Action</th>
                                  @endif
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nipl }}</td>
                                        <td>{{ ucwords($item->nama) }}</td>
                                        <td>{{ ucwords($item->kendaraan->nopol) }}</td>
                                        <td>{{ ucwords($item->isi) }}</td>
                                        <td>{{ date('d M Y', strtotime($item->tanggal )) }}</td>
                                        <td>
                                            @if ($item->updated_at != null)
                                            <span class="badge badge-warning">Telah Diedit pada : {{ date('d M Y', strtotime($item->updated_at )) }}</span></td>
                                            @else
                                            -
                                            @endif
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('laporan.show',$item->id) }}" type="button" class="btn btn-primary">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                @if (auth()->user()->role != 'admin')
                                                <form action="{{ route('laporan.deletePermanent',$item->id) }}" method="POST" onsubmit="return confirm('Hapus Data Permanent? ')">
                                                    @csrf
                                                    @method('delete')
                                                        <button class="btn btn-primary">
                                                        <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                {{-- <form action="{{ $item->is_active != 0 ? route('laporan.destroy',$item->id) : route('laporan.restore',$item->id) }}" class="p-0 m-0" method="POST" onsubmit="return confirm('{{ $item->is_active != 0 ? 'Move data to trash? ' : 'return data ?' }}')"> --}}
                                                <form action="{{ route('laporan.destroy',$item->id) }}" class="p-0 m-0" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                    @method('delete')
                                                    {{-- @if ($item->is_active != 0)
                                                    @method('delete')
                                                @endif --}}
                                                    @csrf
                                                    {{-- <button class="btn {{ $item->is_active != 0 ? 'btn-danger' : 'btn-warning' }} " data-toggle="tooltip" data-placement="top" title="Ganti Status"><i class="ti-power-off"></i></button> --}}
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex justify-content-center">
                                                    {{-- <img width="54" src="data:image/png;base64, {{ base64_encode( "> --}}
                                                    {{-- {!! QrCode::format('png')->merge(asset('assets/images/logo-kominfo.png'), 0.3, true)->generate($item->id) !!} --}}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td>Tidak ada data</td>
                                    </tr>
                                @endforelse
                              </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
