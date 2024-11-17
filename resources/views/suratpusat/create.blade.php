@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Surat Pusat</title>


<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
              <h1 class="text-center mb-4">Tambah Data Surat Pusat</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                <form method="POST" action="{{ route('suratpusat.store') }}" enctype="multipart/form-data">
                                    @csrf

                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Masukan File Surat Pusat</label>
                                      <input type="file" name="filesurat" class="form-control"
                                          placeholder="Masukan File Surat">
                                  </div>
                                  <div class="form-group">
                                      <label for="asalsurat">Asal Surat</label>
                                      <input  type="text" name="asalsurat" class="form-control @error('asalsurat') is-invalid @enderror" id="asalsurat" placeholder="Masukkan asalsurat" value="{{ old('asalsurat') }}" required>
                                      @error('asalsurat')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="tujuan_surat">Tujuan Surat</label>
                                      <input  type="text" name="tujuan_surat" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat" placeholder="Masukkan Tujuan Surat" value="{{ old('tujuan_surat') }}" required>
                                      @error('tujuan_surat')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>

                                  <div class="form-group">
                                    <label for="tentangsurat">Tentang Surat</label>
                                    <textarea name="tentangsurat" class="form-control @error('tentangsurat') is-invalid @enderror" id="tentangsurat" placeholder="Masukkan Tentang Surat" required>{{ old('tentangsurat') }}</textarea>
                                    @error('tentangsurat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                  <div class="form-group">
                                      <label for="klasifikasi">Klasifikasi</label>
                                      <input type="text" name="klasifikasi" class="form-control @error('klasifikasi') is-invalid @enderror" id="klasifikasi" placeholder="Masukkan Klasifikasi" value="{{ old('klasifikasi') }}" required>
                                      @error('klasifikasi')
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
