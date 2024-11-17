@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Surat Disposisi</title>


<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
              <h1 class="text-center mb-4">Tambah Data Surat Disposisi</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                <form method="POST" action="{{ route('suratdisposisi.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    {{-- <div class="form-group">
                                        <label for="nmrsurat">Nomor Surat</label>
                                        <input type="text" name="nmrsurat" class="form-control @error('nmrsurat') is-invalid @enderror" id="nmrsurat" placeholder="Masukkan Nomor Surat" value="{{ old('nmrsurat') }}" required>
                                        @error('nmrsurat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="tglterima">Tanggal Terima</label>
                                        <input type="date" name="tglterima" class="form-control @error('tglterima') is-invalid @enderror" id="tglterima" value="{{ old('tglterima') }}" required>
                                        @error('tglterima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="asal">Asal Surat</label>
                                        <input type="text" name="asal" class="form-control @error('asal') is-invalid @enderror" id="asal" placeholder="Masukkan Asal Surat" value="{{ old('asal') }}" required>
                                        @error('asal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="sifat">Sifat Surat</label>
                                        <input type="text" name="sifat" class="form-control @error('sifat') is-invalid @enderror" id="sifat" placeholder="Masukkan Sifat Surat" value="{{ old('sifat') }}" required>
                                        @error('sifat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="perihal">Perihal Surat</label>
                                        <textarea name="perihal" class="form-control @error('perihal') is-invalid @enderror" id="perihal" placeholder="Masukkan Perihal Surat" required>{{ old('perihal') }}</textarea>
                                        @error('perihal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="diteruskan">Diteruskan Kepada</label>
                                        <input type="text" name="diteruskan" class="form-control @error('diteruskan') is-invalid @enderror" id="diteruskan" placeholder="Masukkan Diteruskan Kepada" value="{{ old('diteruskan') }}" required>
                                        @error('diteruskan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" id="catatan" placeholder="Masukkan Catatan" required>{{ old('catatan') }}</textarea>
                                        @error('catatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="disposisi">Disposisi</label>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi1" value="Harap Penyelesaian Selanjutnya" {{ old('disposisi') == 'Harap Penyelesaian Selanjutnya' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi1">
                                                Harap Penyelesaian Selanjutnya
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi2" value="Minta Saran / Pertimbangan" {{ old('disposisi') == 'Minta Saran / Pertimbangan' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi2">
                                                Minta Saran / Pertimbangan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi3" value="Untuk Dipelajari" {{ old('disposisi') == 'Untuk Dipelajari' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi3">
                                                Untuk Dipelajari
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi4" value="Untuk Dibicarakan" {{ old('disposisi') == 'Untuk Dibicarakan' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi4">
                                                Untuk Dibicarakan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi5" value="Harap Mewakili Saya" {{ old('disposisi') == 'Harap Mewakili Saya' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi5">
                                                Harap Mewakili Saya
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('disposisi') is-invalid @enderror" type="radio" name="disposisi" id="disposisi6" value="Arsip" {{ old('disposisi') == 'Arsip' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="disposisi6">
                                                Arsip
                                            </label>
                                        </div>
                                        @error('disposisi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>

</body>


























<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@endsection
