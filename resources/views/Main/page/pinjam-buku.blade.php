@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
<section id="info-peminjaman">
	@if (session()->has('success'))
	<div class="show">
		<div class="wish-box">
			<div class="is-notif columns is-multiline notification is-default is-mobile is-tablet">
		        <div class="column is-2-mobile is-2-tablet is-2-desktop">
		          <span class="icon">
		            <i class="fa fa-check"></i>
		          </span>
		        </div>
		        <div class="column is-10-tablet is-10-mobile is-10-mobile">
		        	{{session('success')}}
		        </div>
			</div>
		</div>
	</div>
	@endif
	<div class="container">
		<div class="columns is-multiline is-tablet is-mobile">
			<div class="column is-12-desktop is-12-tablet is-12-mobile">
				<p class="title-style has-text-centered title is-2"><b>Info Peminjaman</b></p>
			</div>
			<div class="column is-4-desktop is-5-tablet is-12-mobile data-buku">
				<figure>
					<img src="{{$data->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$data->foto_buku) : asset('/front-assets/foto_buku/book.png')}}" alt="">
				</figure>
			</div>
			<div class="column">
				<div class="columns is-multiline">
					<div class="column is-half data-buku">
					<ul>
						<div class="wrap-info">
							<p class="title is-6">Judul buku</p>
							<li class="subtitle is-4">{{ $data->judul_buku }}</li>
						</div>
						<div class="wrap-info">
							<p class="title is-6">Nama Anggota</p>
							<li class="subtitle is-4">{{ $data->nama_anggota }}</li>
						</div>
						<div class="wrap-info">
							<p class="title is-6">Nomor Induk</p>
							<li class="subtitle is-4">{{ $data->nomor_induk }}</li>
						</div>
						@if ($data->tipe_anggota=='siswa')
						<div class="wrap-info">
							<p class="title is-6">Kelas</p>
							<li class="subtitle is-4">{{ $data->kelas_tingkat.' '.$data->nama_jurusan.' '.$data->urutan_kelas }}</li>
						</div>
						@endif
					</ul>
					</div>
					<div class="column is-half data-buku">
						<ul>
							<div class="wrap-info">
								<p class="title is-6">Tanggal Pinjam</p>
								<li class="subtitle is-4">
								{{ date_explode($data->tanggal_pinjam) }}
								</li>
							</div>
							<div class="wrap-info">
								<p class="title is-6">Tanggal Max Pengembalian</p>
								<li class="subtitle is-4">{{ date_explode($data->tanggal_harus_kembali) }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-6">Status Peminjaman</p>
								<li class="subtitle is-4">	
									@if($data->status_transaksi=='pending')
										<span class="tag is-warning">Pending</span>
									@elseif($data->status_transaksi=='sedang-dipinjam')
										<span class="tag is-primary">Di pinjamkan</span>
									@elseif($data->status_transaksi=='batal-pinjam')
										<span class="tag is-danger">Batal Pinjam</span>
									@elseif($data->status_transaksi=='kembali')
										<span class="tag is-success">Sudah Kembali</span>
									@endif
								</li>
							</div>
						</ul>
					</div>
					@if ($data->status_transaksi=='pending')
					<div class="columns is-multiline is-desktop is-mobile is-tablet">
						<div class="column is-12-mobile is-4-tablet is-4-desktop">
							<div class="field">
								<p class="control">
									<a href="#" onclick="window.history.back()">
										<button class="button is-default">Kembali</button>
									</a>
								</p>
							</div>
						</div>
						<div class="column is-12-mobile is-4-tablet is-4-desktop">
							<div class="field">
								<p class="control">
									<form action="{{ url('/pinjam/batal') }}" method="POST">
									{{ csrf_field() }}
										<input type="hidden" name="id_anggota_perpus" value="{{$data->id_anggota_perpus}}">
										<input type="hidden" name="id_detail_transaksi" value="{{$data->id_detail_transaksi}}">
										<button class="button is-danger">Batal Pinjam</button>
									</form>
								</p>
							</div>
						</div>
						<div class="column is-12-mobile is-4-tablet is-4-desktop">
							<div class="field">
								<p class="control">
									<a href="{{ url('/profile/#list-transaksi') }}">
										<button class="button is-primary">Lihat Transaksi Lain</button>
									</a>
								</p>
							</div>
						</div>
					</div>
					@elseif($data->status_transaksi=='sedang-dipinjam' || $data->status_transaksi=='kembali' || $data->status_transaksi == 'batal-pinjam')
					<div class="column is-6-mobile is-6-tablet is-4-desktop">
						<div class="field">
							<p class="control">
								<a href="#" onclick="window.history.back()">
									<button class="button is-default">Kembali</button>
								</a>
							</p>
						</div>
					</div>
					<div class="column is-12-mobile is-4-tablet is-2-desktop">
						<div class="field">
							<p class="control">
								<a href="{{ url('/profile/#list-pinjam') }}">
									<button class="button is-primary">Lihat Transaksi Lain</button>
								</a>
							</p>
						</div>
					</div>
					@endif
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