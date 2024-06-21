<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table td img{
            width: 400px !important;
            height: 300px !important;
            border-radius: 20px !important;
        }
    </style>
    @endpush
    @push('js')
    <script src="{{ asset('') }}assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('') }}assets/js/select2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4 class="card-title pt-2">Pedoman Informasi Kendaraan dan Pengemudi</h4>
                            <div class="mx-3">
                                <button onclick="history.back()" class="btn btn-primary btn-icon-text "><i class="ti-angle-left btn-icon-prepend"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title pt-2">Standar Operasional Prosedur</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td width="1%">1</td>
                                        <td >Semua kendaraan dinas K3PG sebelum digunakan harus dilakukan pemeriksaan Administrasi dan kondisi fisik.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">2</td>
                                        <td >Setiap pengemudi kendaraan bermotor, sesuai dengan undang-undang lalu lintas harus memiliki SIM yang sesuai dengan kendaraan yang dikemudikannya.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">3</td>
                                        <td >Setiap pengendara/penumpang kendaraan bermotor roda dua harus memakai helm pengaman yang berkondisi baik secara benar.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">4</td>
                                        <td >Dilarang mengendarai kendaraan bermotor roda dua lebih dari dua orang (termasuk pengemudi).</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">5</td>
                                        <td >Dilarang mengendarai kendaraan berat lebih dari 1 (satu) orang yaitu pengemudi saja terkecuali bagi: Bis, Truk, Trailer dan berbagai jenis crane.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">6</td>
                                        <td >Jumlah penumpang kendaraan ringan dan kendaraan berat harus dibatasi menurut jumlah penumpang yang ditetapkan sesuai dengan peraturan yang berlaku (UUL)</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">7</td>
                                        <td >Kendaraan yang beroperasi di lingkungan Perusahaan harus mematuhi ketentuan K3 dan rambu-rambu yang berlaku.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">8</td>
                                        <td >Selama mengendarai kendaraan di area Perusahaan, dilarang merokok dan menerima atau melakukan panggilan telepon</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">9</td>
                                        <td >Kendaraan rekanan (roda 4 atau lebih) yang dipergunakan untuk melakukan aktifitas/kegiatan Proyek K3PG harus mengikuti aturan yang ada di perusahaan tersebut.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">10</td>
                                        <td >Kendaraan untuk angkutan bahan baku atau limbah, kondisi bak harus dalam keadaan baik sehingga tidak terjadi tumpahan/ceceran bahan/material yang diangkut.</td>
                                    </tr>
                                    <tr>
                                        <td width="1%">11</td>
                                        <td >Setiap pengemudi/pengendara/operator kendaraan, baik kendaraan ringan maupun kendaraan berat harus terlebih dahulu secara seksama meneliti peralatan sebagaimana tersebut dibawah ini, setiap hari sebelum menjalankannya, antara lain: Rem kaki/tangan, lampu kota, lampu besar, lampu dim, lampu tanda berbelok, lampu mundur, lampu rem, klason/horn, air radiator, bahan bakar, pelumas, tutup bensin, ban dan lain-lain.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h4 class="card-title pt-2">Sanksi Pelanggaran K3</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                <tbody>
                                <tr>
                                    <th>NO</th>
                                    <th>Jenis Pelanggaran K3</th>
                                    <th>Kelas Pelanggaran</th>
                                    <th>Sanksi</th>
                                  </tr>
                                      <tr>
                                          <td>1</td>
                                          <td>Tidak Memakai APD</td>
                                          <td>I</td>
                                          <td>Skors Selama 3 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>Merokok</td>
                                          <td>III</td>
                                          <td>Skors Selama 9 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>Naik alat angkat angkut</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td>Mengendarai kendaraan melebihi batas kecepatan</td>
                                          <td>III</td>
                                          <td>Skors Selama 9 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>5</td>
                                          <td>Tidak memakai seragam kerja yang telah ditentukan</td>
                                          <td>I</td>
                                          <td>Skors Selama 3 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>6</td>
                                          <td>Melanggar rambu K3</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>7</td>
                                          <td>Parkir Kendaraan di pabrik tidak pada tempatnya</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>8</td>
                                          <td>Mengoperasikan alat, mesin dan kendaraan pabrik tanpa instruksi</td>
                                          <td>III</td>
                                          <td>Skors Selama 9 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>9</td>
                                          <td>Tidak ada SIO, SIM & Bukti keahlian lain yang dipersyaratkan</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>10</td>
                                          <td>Tidak membuat/memiliki KIB yang sesuai</td>
                                          <td>I</td>
                                          <td>Skors Selama 3 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>11</td>
                                          <td>SO/SM Subkon meninggalnakn area kerja tanpa ijin SO Koordinator</td>
                                          <td>I</td>
                                          <td>Skors Selama 3 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>12</td>
                                          <td>Tidak Membuat Surat Ijin Kerja (Safety Permit)</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>13</td>
                                          <td>Mengoperasikan HP di plant</td>
                                          <td>I</td>
                                          <td>Skors Selama 5 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>14</td>
                                          <td>Menyebarluaskan hasil foto ke Media Sosial</td>
                                          <td>II</td>
                                          <td>Skors Selama 6 Hari</td>
                                      </tr>
                                      <tr>
                                          <td>15</td>
                                          <td>Merusak fasilitas perusahaan</td>
                                          <td>IV</td>
                                          <td>Sesuai Kerusakan</td>
                                      </tr>
                                      <tr>
                                          <td>16</td>
                                          <td>Pelanggaran norma k3 lainnya</td>
                                          <td>-</td>
                                          <td>Sesuai dengan jenis pelanggaran</td>
                                      </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
