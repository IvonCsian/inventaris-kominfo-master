<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 26px;
            position: absolute;
            top: 9px;
            right: 1px;
            width: 20px;
        }
    </style>
    @endpush
    @push('js')
    <script src="{{ asset('') }}assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('') }}assets/js/file-upload.js"></script>
    <script src="{{ asset('') }}assets/js/typeahead.js"></script>
    <script src="{{ asset('') }}assets/js/select2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.tahun').datepicker({
            format: 'yyyy-mm-dd',

        });
    </script>
    @endpush
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2">{{ ucwords($title) }}</h4>
                            <div class="mx-3">
                                <button onclick="history.back()" class="btn btn-primary btn-icon-text "><i class="ti-angle-left btn-icon-prepend"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">NAK - NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nipk" value="{{ old('nipk') }}" class="form-control @error('nipk') is-invalid @enderror" id="exampleInputUsernip1" placeholder="Masukkan NAK - NIK">
                                  @error('nipk')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nomor Polisi <span class="text-danger">*</span></label>
                                <input type="text" name="nopol" value="{{ old('nopol') }}" class="form-control @error('nopol') is-invalid @enderror" id="exampleInputUsernip1" placeholder="Masukkan Nomor Polisi">
                                  @error('nopol')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Merk Jenis Kendaraan <span class="text-danger">*</span></label>
                              <input type="text" name="jenis" value="{{ old('jenis') }}" class="form-control @error('jenis') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Merk atau Jenis Kendaraan">
                                @error('jenis')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>

                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-control js-example-basic-single w-100">
                                    <option value="0">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->nama) }} {{ ucwords($item->status) }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>
                                @enderror
                            </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Masa Berlaku STNK <span class="text-danger">*</span></label>
                                        <input type="text" data-provide="tahun" name="stnk" value="{{ old('stnk') }}" class="form-control tahun @error('stnk') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Masa Berlaku STNK">
                                          @error('stnk')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>

                                          @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
