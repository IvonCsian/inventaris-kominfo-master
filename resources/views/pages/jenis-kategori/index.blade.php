<x-app-layout>
    @section('content')
        <div class="row">
            <div class="col-md-12">
                @include('components.notification')
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4 class="card-title pt-2">{{ ucwords($title) }}</h4>
                            <div>
                                <a href="{{ route('jenis-kategori.create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Nama Jenis</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($item->nama_jenis) }}</td>
                                        <td>{{ date('d M Y - H:i:s', strtotime($item->created_at )) }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('jenis-kategori.edit',$item->id) }}" type="button" class="btn btn-primary">
                                                  <i class="ti-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('jenis-kategori.destroy',$item->id) }}" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-primary">
                                                  <i class="ti-trash"></i>
                                                </button>
                                                </form>

                                            </div>
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
    @endsection
</x-app-layout>
