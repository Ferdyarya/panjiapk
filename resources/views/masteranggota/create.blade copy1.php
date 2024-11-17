@extends('layout.admin')

@section('content')

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

<title>Master Data Anggota</title>


<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
              <h1 class="text-center mb-4">Tambah Data Anggota</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                  <form method="POST" action="{{ route('masteranggota.store') }}" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                          <label for="nama">Nama</label>
                                          <input type="text" name="namaanggota" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                              aria-describedby="emailHelp" placeholder="Masukan Nama" value="{{ old('nama') }}" required>
                                          @error('nama')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                              aria-describedby="emailHelp" placeholder="Masukan Email" value="{{ old('email') }}" required>
                                          @error('email')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="no_telp">Telepon</label>
                                          <input type="number" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                              aria-describedby="emailHelp" placeholder="Masukan Telpon" value="{{ old('no_telp') }}" required>
                                          @error('no_telp')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="kelas">Kelas</label>
                                          <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                              aria-describedby="emailHelp" placeholder="Masukan kelas" value="{{ old('kelas') }}" required>
                                          @error('kelas')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="jeniskelamin">Jenis Kelamin</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('jeniskelamin') is-invalid @enderror" type="radio" id="laki-laki" name="jeniskelamin" value="laki-laki" {{ old('jeniskelamin') == 'laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('jeniskelamin') is-invalid @enderror" type="radio" id="perempuan" name="jeniskelamin" value="perempuan" {{ old('jeniskelamin') == 'perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                        @error('jeniskelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                      <div class="form-group">
                                          <label for="tgl_lahir">Tanggal Lahir</label>
                                          <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                              aria-describedby="emailHelp" placeholder="Masukan Kategori" value="{{ old('tgl_lahir') }}" required>
                                          @error('tgl_lahir')
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

<script>
    $( '#userpilih' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>























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
@endsection
