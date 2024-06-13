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
            $('#foto_konten').change(function () {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $('#photosPreview')
                        .attr("src",event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            })
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
                        <form class="forms-sample" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">NAK - NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nipl" value="{{ old('nipl') }}" class="form-control @error('nipl') is-invalid @enderror" id="exampleInputUsernip1" placeholder="Masukkan NAK - NIK">
                                  @error('nipl')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nama Anggota <span class="text-danger">*</span></label>
                              <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Nama Anggota">
                                @error('nama')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>

                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Kendaraan <span class="text-danger">*</span></label>
                                <select name="kendaraan" class="form-control js-example-basic-single w-100">
                                    <option value="0">Pilih Kendaraan</option>
                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->nopol) }} {{ ucwords($item->stnk) }}</option>
                                    @endforeach
                                </select>
                                @error('kendaraan')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Laporan <span class="text-danger">*</span></label>
                                    <input type="text" name="isi" value="{{ old('isi') }}" class="form-control @error('isi') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Laporan">
                                      @error('isi')
                                      <small class="text-danger" style="font-size: 12px">
                                          {{ $message }}.
                                      </small>
                                      @enderror
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Tanggal Laporan <span class="text-danger">*</span></label>
                                        <input type="text" data-provide="tahun" name="tanggal" value="{{ old('tanggal') }}" class="form-control tahun @error('tanggal') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Tanggal Laporan">
                                          @error('tanggal')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>

                                          @enderror
                                    </div>
                                </div>
                            <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class=" img__data mb-4">
                                            <img src="{{ asset('assets/images/noimage.png') }}" alt="" class="img-fluid"  id="photosPreview">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="gambar" class="font-weight-bold">Foto Kendaraan : </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="foto_konten" name="foto_konten" value="{{ old('foto_konten') }}">
                                            </div>
                                        </div>
                                        @error('foto_konten')
                                        <div class="help-block form-text text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror

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
