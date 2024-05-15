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
                                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>NAK - NIK</th>
                                  <th>Nama</th>
                                  <th>Email</th>
                                  <th>Departemen - Bagian</th>
                                  <th>Role</th>
                                  <th>Created At</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip != null ? $item->nip : '-' }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ ucwords($item->email) }}</td>
                                        <td>@if ($item->jabatan != null)
                                            {{ ucwords($item->jabatan) }} | {{ ucwords($item->jabatan_keanggotaan) }}
                                        @else
                                            -
                                        @endif</td>
                                        <td><span class="badge badge-primary">{{ $item->role }}</span></td>
                                        <td>{{ date('d M Y - H:i:s', strtotime($item->created_at )) }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if (Auth::user()->role == 'anggota' || Auth::user()->role == 'admin' || Auth::user()->role == 'operator')
                                                    @if (Auth::user()->id == $item->id)
                                                        <a href="{{ route('user.edit',$item->id) }}" type="button" class="btn btn-primary">
                                                        <i class="ti-pencil-alt"></i>
                                                        </a>
                                                        <form action="{{ route('user.destroy',$item->id) }}" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-primary">
                                                        <i class="ti-trash"></i>
                                                        </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <a href="{{ route('user.edit',$item->id) }}" type="button" class="btn btn-primary">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('user.destroy',$item->id) }}" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-primary">
                                                        <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif

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
