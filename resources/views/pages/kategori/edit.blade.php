<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
                        <form class="forms-sample" action="{{ route('kategori.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nama Kategori <span class="text-danger">*</span></label>
                              <input type="text" name="name" value="{{ old('name',$data->nama) }}" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Nama Jenis">
                                @error('name')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>

                                @enderror
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputUsername1">Kategori Jenis<span class="text-danger">*</span></label>
                                    <select name="kategori_jenis" class="form-control js-example-basic-single w-100">
                                        <option value="0">Pilih Kategori Jenis</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" {{ $data->id_jenis == $item->id ? 'selected' : '' }}>{{ ucwords($item->nama_jenis) }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_jenis')
                                    <small class="text-danger" style="font-size: 12px">
                                        {{ $message }}.
                                    </small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label class="l">Status </label>
                                <div class="d-flex">
                                    <div class="mx-1">
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="roda-4" {{ $data->status == 'roda-4' ? 'checked' : '' }}>
                                          Roda 4+
                                        </label>
                                      </div>
                                    </div>
                                    <div class="mx-1">
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="roda-2" {{ $data->status == 'roda-2' ? 'checked' : '' }}>
                                          Roda 2
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                @error('status')
                                    <small class="text-danger" style="font-size: 12px">
                                        {{ $message }}.
                                    </small>
                                @enderror
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
