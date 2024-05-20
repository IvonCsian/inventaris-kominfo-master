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
        $(document).ready(function() {
            var harga_barang = document.getElementById("harga_barang");
            harga_barang.value = formatRupiah(harga_barang.value);
            harga_barang.addEventListener("keyup", function(e) {
                harga_barang.value = formatRupiah(this.value);
            });
            $('#gambar_konten').change(function () {
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
             /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? rupiah : "";
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
                        <form class="forms-sample" action="{{ route('barang.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputUsername1">NAK - NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nip" value="{{ old('nip',$data->nip) }}" class="form-control @error('nip') is-invalid @enderror" id="exampleInputUsernip1" placeholder="Masukkan NAK - NIK">
                                  @error('nip')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>

                                  @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nomor Polisi <span class="text-danger">*</span></label>
                              <input type="text" name="name" value="{{ old('name',$data->nama_barang) }}" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Nomor Polisi">
                                @error('name')
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
                                        <option value="{{ $item->id }}" {{ $data->id_kategori == $item->id ? 'selected' : '' }}>{{ ucwords($item->nama) }}{{ ucwords($item->status) }}</option>
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
                                    <label for="exampleInputUsername1">Muatan <span class="text-danger">*</span></label>
                                    <input type="text" name="merk" value="{{ old('merk',$data->merk) }}" class="form-control @error('merk') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Muatan">
                                      @error('merk')
                                      <small class="text-danger" style="font-size: 12px">
                                          {{ $message }}.
                                      </small>
                                      @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Kondisi Oli dan Radiator <span class="text-danger">*</span></label>
                                        <input type="text" name="bahan" value="{{ old('bahan',$data->bahan) }}" class="form-control @error('bahan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Kondisi Kendaraan">
                                          @error('bahan')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>
                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Kondisi Rem dan Lampu <span class="text-danger">*</span></label>
                                        <input type="text" name="ukuran" value="{{ old('ukuran',$data->ukuran) }}" class="form-control @error('ukuran') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Kondisi Kendaraan">
                                          @error('ukuran')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>

                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Masa Berlaku STNK <span class="text-danger">*</span></label>
                                        <input type="text" data-provide="tahun" name="tahun" value="{{ old('tahun',$data->tahun) }}" class="form-control tahun @error('tahun') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Masa Berlaku STNK">
                                          @error('tahun')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>

                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Kondisi Ban dan Wipper <span class="text-danger">*</span></label>
                                        <input type="text" name="asal_barang" value="{{ old('asal_barang',$data->asal_barang) }}" class="form-control @error('asal_barang') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Kondisi Ban dan Wipper">
                                          @error('asal_barang')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>
                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Kondisi Klakson <span class="text-danger">*</span></label>
                                        <input type="text" name="kondisi_barang" value="{{ old('kondisi_barang',$data->kondisi_barang) }}" class="form-control @error('kondisi_barang') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Kondisi Klakson">
                                          @error('kondisi_barang')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>
                                          @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Jumlah Penumpang <span class="text-danger">*</span></label>
                                        <input type="text" name="jumlah_barang" value="{{ old('jumlah_barang',$data->jumlah_barang) }}" class="form-control @error('jumlah_barang') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Jumlah Penumpang">
                                          @error('jumlah_barang')
                                          <small class="text-danger" style="font-size: 12px">
                                              {{ $message }}.
                                          </small>
                                          @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Meteran Akhir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text bg-primary text-white">Km</span>
                                    </div>
                                    <input type="text" id="harga_barang" name="harga_barang" class="form-control @error('harga_barang') is-invalid @enderror" value="{{ old('harga_barang',(int)$data->harga_barang) }}" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                    </div>
                                </div>
                                @error('harga_barang')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>
                                @enderror
                            </div>
                            <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class=" img__data mb-4">
                                            <img src="{{ $data->foto_barang != null ?  asset('img/barang/'.$data->foto_barang) : asset('assets/images/noimage.png') }}" alt="" class="img-fluid"  id="photosPreview">
                                        </div>

                                    </div>
                                    <div class="col-md-7">
                                        <label for="gambar" class="font-weight-bold">Gambar : </label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambar_konten" name="gambar_konten" value="{{ old('gambar_konten') }}">
                                            </div>
                                        </div>
                                        @error('gambar_konten')
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
