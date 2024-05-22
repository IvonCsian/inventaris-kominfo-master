<x-app-layout>
    @section('content')
    <div class="row">
        <div class="col-sm-6">
          <div class="home-tab">
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <div class="circle-progress-width mx-2">
                                    <i class="menu-icon mdi mdi-chart-bar icon-lg text-warning"></i>
                                </div>
                                <div>
                                  <p class="text-small mb-2">Total Kendaraan</p>
                                  <h4 class="mb-0 fw-bold">{{ $barang }}</h4>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="d-flex align-items-center">
                                <div class="circle-progress-width mx-2">
                                    <i class="menu-icon mdi mdi-account-box-outline icon-lg text-success"></i>
                                </div>
                                <div>
                                  <p class="text-small mb-2">Total User</p>
                                  <h4 class="mb-0 fw-bold">{{ $user }}</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="d-flex  align-items-center mb-2 mb-sm-0">
                                  <div class="circle-progress-width mx-2">
                                    <i class="menu-icon mdi mdi-floor-plan icon-lg text-success"></i>
                                  </div>
                                  <div>
                                    <p class="text-small mb-2">Total Jenis Kategori</p>
                                    <h4 class="mb-0 fw-bold">{{ $jenis }}</h4>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                  <div class="circle-progress-width mx-2">
                                    <i class="menu-icon mdi mdi-floor-plan icon-lg text-info"></i>
                                  </div>
                                  <div>
                                    <p class="text-small mb-2">Total Kategori</p>
                                    <h4 class="mb-0 fw-bold">{{ $kategori }}</h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <h4 class="card-title card-title-dash">Activities</h4>
                      @php
                          $count = \Spatie\Activitylog\Models\Activity::count();
                      @endphp
                      <p class="mb-0">{{ $count }} Aktivitas yang telah dilakukan</p>
                    </div>
                    <ul class="bullet-line-list">
                        @forelse ($data as $item)
                            @if ($item->causer_id == null)
                                @foreach ($item->properties as $key => $itemP)
                                    @php
                                        $createdAt = $item->created_at;
                                        $now = \Carbon\Carbon::now();
                                        $difference = $createdAt->diffForHumans();

                                    @endphp
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <div><span class="text-light-green" style="color: #224BCA">{{ ucwords($itemP['email']) }} </span><strong>{{ $item->description }}</strong> data <strong>{{ $item->log_name }}</strong> </div>
                                            <p>{{  $difference }}</p>
                                        </div>
                                    </li>

                                @endforeach
                            @else
                                @php
                                  
                                    $createdAt = $item->created_at;
                                    $now = \Carbon\Carbon::now();
                                    $difference = $createdAt->diffForHumans();

                                @endphp
                                <li>
                                <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green" style="color: #224BCA">{{ ucwords($item->user) }} </span><strong>{{ $item->description }}</strong> data <strong>{{ $item->log_name }}</strong> </div>
                                    <p>{{  $difference }}</p>
                                </div>
                                </li>
                            @endif

                        @empty
                            af
                        @endforelse
                    </ul>
                    <div class="list align-items-center pt-3">
                      <div class="wrapper w-100">
                        <p class="mb-0">
                          {{-- <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a> --}}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

      </div>
    @endsection
</x-app-layout>
