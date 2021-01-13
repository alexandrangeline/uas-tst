@extends('layouts.master') 
@section('konten')
<div class="content" style="margin-top: 10%; width: auto; margin-left: auto;">
    <div class="row">
        <div class="col">
            <h3 class="pb-3" align="center">Riwayat</h3>
            <div align="right">
                <a href="{{ route('home', ['id' => $id, 'token' => $token ])}}" class="btn btn-danger" onclick="window.history.back()">
                    Kembali
                </a >
            </div>
            <div class="row mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Suhu &deg;C</th>
                            <th scope="col">Gejala</th>
                            <th scope="col">Berpergian?</th>
                            <th scope="col">Riwayat Perjalanan</th>
                            <th scope="col">Saran</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($history != null)
                        @foreach ($history as $item)
                            <tr>
                            <td>{{ date('d F Y', strtotime( $item['log_date'] )) }}</td>
                            <td>{{ $item['username'] }}</td>
                            <td>{{ $item['temperature'] }}</td>
                            <td>{{ $item['symptom_name'] }}</td>
                            <td>
                                @if ($item['is_traveling'] == 1)
                                <i class="fa fa-check-circle text-primary" style="font-size: 36px;" ></i>
                                @else
                                <i class="material-icons text-danger" style="font-size: 36px;">&#xe5c9;</i>
                                @endif
                            </td>
                            <td>{{ $item['traveling_history'] }}</td>
                            <td>
                            <form action="{{ route('suggestion',['logId'=>$item['log_id'],'token' => $token])}}" method="post">
                                @csrf
                                <input type="hidden" name="is_traveling" value="{{ $item['is_traveling'] }}">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                            </form>
                            </td>
                            <td>
                              <form action="{{ route('log-edit',['logId'=> $item['log_id']]) }}" method="post">
                                @csrf
                                <input type="hidden" name="api_token" value="{{ $token }}">
                                <input type="hidden" name="user_id" value="{{ $item['user_id'] }}">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                              </form>
                            </td>
                            </tr>
                        @endforeach
                        @else
                        Belum ada data riwayat
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
