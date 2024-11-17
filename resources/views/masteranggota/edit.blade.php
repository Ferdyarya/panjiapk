@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Master Data Anggota</title>


<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
              <h1 class="text-center mb-4">Edit Data Anggota</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                  <form method="POST" action="{{ route('masteranggota.update', $item->id) }}" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="form-group" style="border-radius: 8px;">
                                        <label for="id_anggota">Nama Anggota</label>
                                        <input type="text" class="form-control" id="id_anggota" value="{{ Auth::user()->name }}" readonly>
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="id_anggota">
                                    </div>
                                      <div class="form-group">
                                        <label for="email">Email</label>
                                        <input value="{{ $item->email }}" type="email" name="email" class="form-control"
                                            id="exampleInputPassword1" placeholder="Masukan Email" required>
                                     </div>
                                      <div class="form-group">
                                        <label for="no_telp">Telepon</label>
                                        <input value="{{ $item->no_telp }}" type="number" name="no_telp" class="form-control"
                                            id="exampleInputPassword1" placeholder="Masukan Telpon" required>
                                     </div>
                                      <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <input value="{{ $item->kelas }}" type="kelas" name="kelas" class="form-control"
                                            id="exampleInputPassword1" placeholder="Masukan kelas" required>
                                     </div>
                                     <div class="form-group">
                                        <label for="jeniskelamin">Jenis Kelamin</label><br>
                                        <input type="radio" name="jeniskelamin" value="laki-laki" id="laki-laki" {{ $item->jeniskelamin == 'laki-laki' ? 'checked' : '' }}>
                                        <label for="laki-laki">Laki-laki</label><br>
                                        <input type="radio" name="jeniskelamin" value="perempuan" id="perempuan" {{ $item->jeniskelamin == 'perempuan' ? 'checked' : '' }}>
                                        <label for="perempuan">Perempuan</label><br>
                                    </div>
                                      <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input value="{{ $item->tgl_lahir }}" type="date" name="tgl_lahir" class="form-control"
                                            id="exampleInputPassword1" placeholder="Masukan tgl_lahir" required>
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
