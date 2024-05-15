<x-app-layout>
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
                        <form class="forms-sample" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                              <label for="exampleInputUsername1">NAK - NIK <span class="text-danger">*</span></label>
                              <input type="text" name="nip" value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan NAK - NIK">
                                @error('nip')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>

                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nama <span class="text-danger">*</span></label>
                              <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Nama">
                                @error('name')
                                <small class="text-danger" style="font-size: 12px">
                                    {{ $message }}.
                                </small>

                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Email">
                                  @error('email')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Departemen - Bagian <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-control @error('jabatan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Departemen - Bagian">
                                  @error('jabatan')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Jabatan Keanggotaan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan_keanggotaan" value="{{ old('jabatan_keanggotaan') }}" class="form-control @error('jabatan_keanggotaan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Nama Jenis">
                                  @error('jabatan_keanggotaan')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1"> Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan Password">
                                  @error('password')
                                  <small class="text-danger" style="font-size: 12px">
                                      {{ $message }}.
                                  </small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label class="l">Role </label>
                                <div class="d-flex">
                                    @if (Auth::user()->role == 'super-admin')
                                        <div class="mx-1">
                                            <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios1" value="admin" checked>
                                                Admin
                                            </label>
                                            </div>
                                        </div>
                                    @endif
                                        @if (Auth::user()->role != 'operator')
                                        <div class="mx-1">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="anggota">
                                                Anggota
                                                </label>
                                            </div>
                                        </div>
                                        @else
                                        <div class="mx-1">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="operator">
                                                Operator
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                    @if (Auth::user()->role == 'super-admin')
                                    {{-- <div class="mx-1">
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="super-admin">
                                            Super Admin
                                          </label>
                                        </div>
                                    </div> --}}
                                    <div class="mx-1">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="role" id="membershipRadios2" value="operator">
                                            Operator
                                            </label>
                                        </div>
                                    </div>
                                    @endif
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
