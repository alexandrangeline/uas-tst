@extends('layouts.master')
@section('konten') 
      <div class="content" style="margin-top: 10%">
        <div class="row">
          <div class="col">
            <div align="center">
              <h3 class="pb-2">Log Hari Ini</h3>
              <p class="text-custom">{{ date('d F Y') }}</p>
            </div>
            <div class="col-md-8">
            <form action="{{ route('log-update',['logId' => $log_id]) }}" method="post">
              @csrf
                <input type="hidden" value="{{ $token }}" name="api_token">
                <input type="hidden" value="{{ $user_id }}" name="user_id">
                <input type="hidden" value="{{ date('Y-m-d') }}" name="log_date">
                <div class="form-group">
                  <label for="suhu">Suhu</label>
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      required
                      value="{{ $log['temperature'] }}"
                      name="temperature"
                      class="form-control form-custom"
                      placeholder="Masukan suhu.. ex: 45, 34"
                      aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2"
                        >&deg; C</span
                      >
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Gejala">Gejala</label>
                  <div class="input-group mb-3">
                    <select name="symptom_id" class="form-control form-custom" required>
                        @foreach ($gejala as $item)
                        <option value="{{ $item['id'] }}" {{ $log['symptom_name'] == $item['symptom_name'] ? 'selected' : '' }} >{{ $item['symptom_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <label>Berpergian?</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" {{ $log['is_traveling'] == 1 ? 'checked' : '' }} type="radio" required name="is_traveling" id="ya" value="1">
                  <label class="form-check-label" for="ya">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" {{ $log['is_traveling'] == 0 ? 'checked' : '' }}  type="radio" required name="is_traveling" id="tidak" value="0">
                  <label class="form-check-label" for="tidak">Tidak</label>
                </div>
                <div class="form-group">
                  <label for="Riwayat Perjalanan">Riwayat Perjalanan</label>
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      required
                      value="{{ $log['traveling_history']}}"
                      name="traveling_history"
                      class="form-control form-custom"
                      placeholder="Masukan riwayat perjalanan"
                      id="Riwayat Perjalanan"
                    />
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-custom" type="submit">
                    Perbarui log
                  </button>
                  <button class="btn btn-danger" onclick="window.history.back();">
                    Kembali
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
