<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Aritmatika</title>
</head>

<body>
    <h1>{{ $title ?? '' }}</h1>
    <a href="{{ url()->previous() }}">Kembali</a>
    <form action="{{ route('tambah-action') }}" method="post">
        @csrf
        <label for="">Angka 1</label>
        <input type="number" name="angka1" placeholder="Masukkan Angka">
        <br>
        <label for="">Angka 2</label>
        <input type="number" name="angka2" placeholder="Masukkan Angka">
        <br>
        <button type="submit">Simpan</button>
    </form>
    <h1>Halisnya Adalah {{ $jumlah }}</h1>
</body>

</html>
