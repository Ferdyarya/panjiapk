@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<!-- Select2 CSS -->
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

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
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                  <div class="form-group mb-3">
                                    <label for="id_mastercabang">Asal Surat</label>
                                    <select class="form-select" name="id_mastercabang" id="judulbuku" style="border-radius: 8px;">
                                        <option></option>
                                        @foreach ($mastercabang as $item)
                                            <option value="{{ $item->id }}">{{ $item->cabang }}</option>
                                        @endforeach
                                    </select>
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


























<!-- Optional JavaScript Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV7YyybLOtiN6bX3h+rXxy5lVX" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+pyRy4IhBQvqo8Rx2ZR1c8KRjuva5V7x8GA" crossorigin="anonymous">
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$( '#judulbuku' ).select2( {
theme: "bootstrap-5",
width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
placeholder: $( this ).data( 'placeholder' ),
} );
</script>
@endsection
