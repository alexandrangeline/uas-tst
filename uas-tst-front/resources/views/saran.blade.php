@extends('layouts.master')
@section('konten') 
      <div class="content" style="margin-top: 10%">
        <div class="row">
          <div class="col">
            <div align="center">
              <h2 class="pb-4 font-weight-bold">Saran Untukmu</h2>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">
                <img
                  src="{{asset('vendor')}}/images/gambar-2.png"
                  alt="gambar-2"
                  class="img-fluid"
                />
              </div>
              <div class="col-md-6">
                <h3>{{ date('d F Y', strtotime($saran['log_date'])) }}</h3>
                <p class="text-muted mb-3" style="font-size: 16px">
                  {{$saran['suggestion']}}
                </p>
                @if ($is_traveling == 1)
                <div class="alert alert-warning" role="alert">
                  <h5 class="alert-heading font-weight-bold"><i class="fa fa-info-circle text-warning"></i> Perhatian!</h5>
                    <hr>  
                  Kamu berpergian nih, selama keluar rumah tetap patuhi protokol kesehatan ya!
                </div>
                @else
                  <div class="alert alert-info" role="alert">
                    <h5 class="alert-heading font-weight-bold"><i class="fa fa-info-circle text-info"></i> Well Done!</h5>
                      <hr>
                      Terima Kasih sudah tidak berpergian!
                  </div>
                @endif
                <button class="btn btn-custom" onclick="swal2();" >Tambahkan Pengingat</button>
                <button class="btn btn-outline" onclick="window.history.back();">Kembali</button>
              </div>
            </div>
            <hr />
          </div>
        </div>
      </div>
@endsection
@section('swal')
    <script>
        function swal2() {
          Swal.fire(
            'Selamat!',
            'Berhasil ditambahkan!',
            'success'
          )
        };
    </script>
@endsection
