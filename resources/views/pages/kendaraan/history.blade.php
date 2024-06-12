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
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4 class="card-title pt-2">{{ ucwords($title) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Update Data Kendaraan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Hapus Data Kendaraan</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Tanggal Update</th>
                                                <th>Detail</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse ($update as $item)
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-warning">{{ $item->description }}</span>
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        @foreach ($update as $item)
                                                        @foreach ($item->properties as $key => $itemO)
                                                            {{-- <td>{{ $itemO['jenis'] }}</td> --}}
                                                            @foreach ($itemO as $keyp=> $itemP)
                                                            <div class="py-2">
                                                               <p style="font-size:14px"><strong>{{ ucwords(str_replace("_", " ",$keyp)) }} :</strong> {{ $itemP }}</p>
                                                            </div>
                                                                {{-- {{ $itemP }} --}}
                                                            @endforeach
                                                        @endforeach

                                                    @endforeach
                                                    </td>
                                                    {{-- @foreach ($item->properties as $key => $itemO)
                                                        @foreach ($itemO as $itemP)
                                                        <td>{{ $itemP }}</td>
                                                        @endforeach
                                                    @endforeach --}}

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        {{-- {!! $update->links() !!} --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Tanggal Update</th>
                                                <th>NAK - NIK</th>
                                                <th>Nomor Polisi</th>
                                                <th>Kategori Kendaraan</th>
                                                <th>Status Kendaraan</th>
                                                <th>Merk Jenis Kendaraan</th>
                                                <th>Masa Berlaku STNK</th>
                                                <th>Aksi</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse ($delete as $item)
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-danger">Delete</span>
                                                    </td>
                                                    <td>{{ $item->deleted_at }}</td>
                                                    <td>{{ $item->nipk }}</td>
                                                    <td>{{ $item->nopol }}</td>
                                                    <td>{{ $item->kategori->nama }}</td>
                                                    <td>{{ $item->kategori->status }}</td>
                                                    <td>{{ $item->jenis }}</td>
                                                    <td>{{ date('d M Y', strtotime($item->stnk )) }}</td>
                                                    <td>
                                                    <form action="{{ route('kendaraan.restore',$item->id) }}" class="p-0 m-0" method="POST" onsubmit="return confirm('return data ?')">
                                                        @csrf
                                                        <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ganti Status"><i class="mdi mdi-backup-restore"></i></button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
