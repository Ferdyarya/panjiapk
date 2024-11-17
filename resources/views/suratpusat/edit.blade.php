@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Data Surat Pusat</title>


<body>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body" style="border-radius: 15px;">
              <h1 class="text-center mb-4">Edit Data Surat Pusat</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                <form method="POST" action="{{ route('suratpusat.update', $item->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="asalsurat">Asal Surat</label>
                                        <input value="{{ $item->asalsurat }}" type="text" name="asalsurat" class="form-control" placeholder="Masukan Asal Surat" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tujuan_surat">Tujuan Surat</label>
                                        <input value="{{ $item->tujuan_surat }}" type="text" name="tujuan_surat" class="form-control" placeholder="Masukan Tujuan Surat" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tentangsurat">Tentang Surat</label>
                                        <textarea name="tentangsurat" class="form-control" placeholder="Masukan Tentang Surat" required>{{ $item->tentangsurat }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="filesurat">File Surat</label>
                                        <input type="file" name="filesurat" class="form-control">
                                        @if($item->filesurat)
                                            <p>File saat ini: <a href="{{ url('filesurat/'.$item->filesurat) }}" target="_blank">{{ $item->filesurat }}</a></p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="klasifikasi">Klasifikasi</label>
                                        <input value="{{ $item->klasifikasi }}" type="text" name="klasifikasi" class="form-control" placeholder="Masukan Klasifikasi" required>
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
