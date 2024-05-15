<x-app-layout>
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
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Tanggal</th>
                                  <th>Data Menu</th>
                                  <th>User</th>
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($data as $item)
                                    @if ($item->causer_id == null)
                                        @foreach ($item->properties as $key => $itemP)
                                            @php
                                                $createdAt = $item->created_at;
                                                $now = \Carbon\Carbon::now();
                                                $difference = $createdAt->diffForHumans();

                                            @endphp
                                            <tr>
                                                <td>{{ date('d M Y - H:i:s', strtotime($item->created_at )) }}</td>
                                                <td>
                                                    @if ($item->description == 'created')
                                                        Data telah <span class="badge badge-success">ditambahkan</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>
                                                    @elseif ($item->description == 'updated')
                                                        Data telah <span class="badge badge-warning">diganti</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>
                                                    @else
                                                        Data telah <span class="badge badge-danger">dihapus</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>

                                                    @endif
                                                </td>

                                                <td>{{ $itemP['email'] }}</td>

                                            </tr>

                                        @endforeach
                                    @else
                                        @php
                                            $user = \App\Models\User::find($item->causer_id)->first()->email;
                                            $createdAt = $item->created_at;
                                            $now = \Carbon\Carbon::now();
                                            $difference = $createdAt->diffForHumans();

                                        @endphp
                                        <tr>
                                            <td>{{ date('d M Y - H:i:s', strtotime($item->created_at )) }}</td>
                                            <td>
                                                @if ($item->description == 'created')
                                                    Data telah <span class="badge badge-success">ditambahkan</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>
                                                @elseif ($item->description == 'updated')
                                                    Data telah <span class="badge badge-warning">diganti</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>
                                                @else
                                                    Data telah <span class="badge badge-danger">dihapus</span> di menu : <strong>{{ ucwords($item->log_name) }}</strong>

                                                @endif
                                            </td>

                                            @php
                                                $user = \App\Models\User::find($item->causer_id)->first()->email;
                                            @endphp
                                            <td>{{ $user }}</td>
                                            {{-- <td>{{ date('d M Y - H:i:s', strtotime($item->created_at )) }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('kategori.edit',$item->id) }}" type="button" class="btn btn-primary">
                                                      <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('kategori.destroy',$item->id) }}" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-primary">
                                                      <i class="ti-trash"></i>
                                                    </button>
                                                    </form>

                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endif
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
