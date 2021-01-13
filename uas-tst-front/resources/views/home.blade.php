@extends('layouts.master')
@section('konten')
<div class="content">
  <div class="row">
    <div class="col-md-6">
      <img src="{{ asset('vendor') }}/images/gambar-1.png" class="img-fluid" alt="gambar-1" />
    </div>
    <div class="col-md-6">
      <h3 class="pb-4">Selamat datang!</h3>
      <p class="text-custom">Bagaimana Kesehatanmu hari ini?</p>
      <div class="row pt-4">
        <div class="col-md-6">
          <a href="{{ route('log', ['id'=> $id,'token'=> $token])}}" class="btn btn-custom">
            Log kesehatan <br />
            hari ini
          </a>
        </div>
        <div class="col-sm-6">
          <a href="{{ route('log-history', ['id'=> $id,'token' => $token])}}" class="btn btn-custom-outline">
            Lihat <br />
            riwayat
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection