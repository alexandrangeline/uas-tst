@extends('layouts.master')
@section('konten')    
<div class="content">
  <div class="row">
    <div class="col-md" align="center">
      <i class="fa fa-check-circle fa-4x pb-2" style="color: #395693"></i>
      <h3 class="pb-2">Log Berhasil Ditambahkan!</h3>
      <p class="text-custom">{{ date('d F Y', strtotime($tanggal)) }}</p>
      <div class="row pt-4">
        <div class="col-md-3 offset-md-3">
          <form action="{{ route('suggestion',['logId'=>$log_id,'token' => $token])}}" method="post">
            @csrf
            <input type="hidden" name="is_traveling" value="{{ $is_traveling }}">
            <button type="submit" class="btn btn-custom pt-3 pb-3">
              Lihat Saran
            </button>
          </form>
        </div>
        <div class="col-md-3">
        <a href="{{ route('log-history',['id'=>$id,'token' => $token]) }}" class="btn btn-custom-outline pt-3 pb-3">
            Lihat riwayat
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
