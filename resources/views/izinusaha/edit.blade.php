@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Surat Izin Usaha</title>


<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
              <h1 class="text-center mb-4">Edit Data Surat Izin Usaha</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                  <form method="POST" action="{{ route('izinusaha.update', $item->id) }}" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                            value="{{ old('tanggal', $item->tanggal) }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tujuan_surat">Tujuan Surat</label>
                                        <input type="text" name="tujuan_surat" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat"
                                            placeholder="Masukan Tujuan Surat" value="{{ old('tujuan_surat', $item->tujuan_surat) }}" required>
                                        @error('tujuan_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="atasnama">Atas Nama</label>
                                        <input type="text" name="atasnama" class="form-control @error('atasnama') is-invalid @enderror" id="atasnama"
                                            placeholder="Masukan Atas Nama" value="{{ old('atasnama', $item->atasnama) }}" required>
                                        @error('atasnama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                            placeholder="Masukan Keterangan" value="{{ old('keterangan', $item->keterangan) }}" required>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kategoripertanian">Kategori</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kategoripertanian') is-invalid @enderror" type="radio" id="lahan_basah" name="kategoripertanian" value="Pertanian Lahan Basah" {{ old('kategoripertanian', $item->kategoripertanian) == 'Pertanian Lahan Basah' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lahan_basah">Pertanian Lahan Basah</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kategoripertanian') is-invalid @enderror" type="radio" id="lahan_kering" name="kategoripertanian" value="Pertanian Lahan Kering" {{ old('kategoripertanian', $item->kategoripertanian) == 'Pertanian Lahan Kering' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lahan_kering">Pertanian Lahan Kering</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('kategoripertanian') is-invalid @enderror" type="radio" id="perkebunan" name="kategoripertanian" value="Perkebunan" {{ old('kategoripertanian', $item->kategoripertanian) == 'Perkebunan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perkebunan">Perkebunan</label>
                                        </div>
                                        @error('kategoripertanian')
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
