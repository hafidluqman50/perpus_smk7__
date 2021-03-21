@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
<section id="transaksi">
	<div class="container">
		<div class="columns is-multiline data-buku">
			<div class="column is-12-tablet is-12-desktop">
				<p class="title-style has-text-centered title is-2">
					<b>Transaksi Buku</b>
				</p>
			</div>
			<div class="column is-5-tablet is-4-desktop">
				<figure>
					<img src="{{ $buku->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$buku->foto_buku) : asset('/front-assets/foto_buku/book.png') }}" alt="">
				</figure>
			</div>
			<div class="column is-7-tablet">
				<div class="columns is-multiline">
					<div class="column is-half-tablet is-half-desktop">
						<ul>
							<div class="wrap-info">
								<p class="title is-6">Judul buku</p>
								<li class="subtitle is-4">{{ $buku->judul_buku }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-6">Stok buku</p>
								<li class="subtitle is-4"><span class="tag {{ $buku->stok_buku > 0 ? 'is-success' : 'is-danger' }}">{{ $buku->stok_buku }}</span></li>
							</div>
							<div class="wrap-info">	
								<p class="title is-6">Nomor Induk</p>
								<li class="subtitle is-4">{{ $anggota->nomor_induk }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-6">Nama peminjam</p>
								<li class="subtitle is-4">{{ $anggota->nama_anggota }}</li>
							</div>
						</ul>
					</div>
					<div class="column is-half-tablet is-half-desktop">
						<ul>
							<div class="wrap-info">
								<p class="title is-6">Tipe Anggota</p>
								<li class="subtitle is-4">{{ ucwords($anggota->tipe_anggota) }}
								</li>
							</div>
							@if ($anggota->tipe_anggota == 'siswa')
							<div class="wrap-info">
								<p class="title is-6">Kelas</p>
								<li class="subtitle is-4">{{ $anggota->kelas_tingkat.' '.$anggota->nama_jurusan.' '.$anggota->urutan_kelas }}
								</li>
							</div>
							@endif
							<div class="wrap-info">
								<p class="title is-6">Tanggal Peminjaman</p>
								<li class="subtitle is-4">{{ date_explode(date('Y-m-d')) }}</li>
							</div>
							<div class="wrap-info">	
								<p class="title is-6">Tanggal Max pengembalian</p>
								<li class="subtitle is-4">{{ date_explode(dua_minggu(date('Y-m-d'))) }}</li>
							</div>
						</ul>
					</div>
					<div class="column is-12-tablet is-12-desktop">
						<div class="aturan">
							{{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic 
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic 
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic 
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic mollitia quos non nostrum et excepturi laboriosam explicabo magni, provident praesentium minus accusantium, odit, natus officia autem possimus eius velit atque. --}}
							Buku harus tidak boleh hilang dan harus kembali tepat waktu
						</div>
						<div class="field">
						  <p class="control">
						    <label class="checkbox">
						      <input type="checkbox" id="pinjam">
						      Saya setuju dengan peraturan yang ada
						    </label>
						  </p>
						</div>
						<form action="{{ url('/pinjam/save') }}" method="POST">
						{{ csrf_field() }}
						<div class="field is-grouped">
							<input type="hidden" name="tanggal_pinjam" value="{{date_explode(date('Y-m-d'))}}">
							<input type="hidden" name="tanggal_harus_kembali" value="{{date_explode(dua_minggu(date('Y-m-d')))}}">
							<input type="hidden" name="id_buku" value="{{$buku->id_buku}}">
							<input type="hidden" name="status_transaksi" value="pending">
							<input type="hidden" name="id_anggota" value="{{$anggota->id_anggota_perpus}}">
						  <p class="control">
						    <button type="submit" class="button is-primary" disabled>Pinjam</button>
						  </p>
						</form>
						 <p class="control">
						  {{-- <a href="{{ url('/buku') }}"> --}}
						    <button type="button" class="button is-default" onclick="window.history.back()">Kembali</button>
						  {{-- </a> --}}
						 </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('script')
<script>
$(function(){
  	$('#container').css({
  		'background-color':'#00d1b2'
	});
});
</script>
@endsection