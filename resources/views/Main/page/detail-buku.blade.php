@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
<section id="info-buku">
	<div class="container">
		<div class="columns is-multiline is-mobile">
			<div class="column is-offset-1-mobile is-10-mobile is-6-tablet is-5-desktop">
				<figure class="image kandang">
					<div class="kubik">
						<figure>
							<div class="left">
								<p>{{ $buku->judul_buku }}</p>
							</div>
						</figure>
						<img class="front" src="{{ $buku->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$buku->foto_buku) : asset('/front-assets/foto_buku/book.png') }}" alt="">
					</div>
				</figure>
			</div>
			<div class="column is-offset-1-mobile is-6-tablet is-10-mobile">
				<h3 class="title is-3">{{ $buku->judul_buku }}</h3>
				<p class="subtitle is-6">BUKU</p>
				<div class="columns data-buku">
					<div class="column">
						<ul>
							<div class="wrap-info">
								<p class="title is-5">pengarang</p>
								<li class="subtitle">{{ $buku->pengarang }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">penerbit</p>
								<li class="subtitle">{{ $buku->penerbit }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">tahun terbit</p>
								<li class="subtitle">{{ $buku->tahun_terbit }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">tempat terbit</p>
								<li class="subtitle">{{ $buku->tempat_terbit }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">stok buku</p>
								<li class="subtitle"><span class="tag {{ ($buku->stok_buku != '0' ? 'is-success' : 'is-danger') }}">{{ $buku->stok_buku }}</span></li>
							</div>
						</ul>
					</div>
					<div class="column">
						<ul>
							<div class="wrap-info">
								<p class="title is-5">Singkatan Penulis</p>
								<li class="subtitle">{{ $buku->sn_penulis }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">tanggal upload</p>
								<li class="subtitle">{{ date_explode($buku->tanggal_upload) }}</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">kategori</p>
								<li class="subtitle">
									<a href="{{ url('/kategori',$buku->slug_kategori) }}">
										<span class="tag is-warning">{{ $buku->nama_kategori }}</span>
									</a>
								</li>
							</div>
							<div class="wrap-info">
								<p class="title is-5">sub kategori</p>
								<li class="subtitle">
									<a href="{{ url('/kategori/'.$buku->slug_kategori.'/sub-kategori',$buku->slug_sub_ktg) }}">
										<span class="tag is-info">{{ $buku->nama_sub }}</span>
									</a>
								</li>
							</div>
							{{-- <div class="wrap-info">
								<p class="title is-5">rating</p>
								<li class="subtitle">
									<span class="icon rate">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon rate">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon rate">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon rate">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon rate">
										<i class="fa fa-star-o"></i>
									</span>
								</li>
							</div> --}}
						</ul>
					</div>
				</div>
				<div class="columns is-mobile is-tablet is-multiline">
					<div class="column is-half-mobile is-half-tablet is-4-desktop">
						<a href="{{ url('/pinjam/buku',$buku->judul_slug) }}">
							<button class="button is-primary pinjam">Pinjam</button>
						</a>
					</div>
					<div class="column is-half-mobile is-half-tablet is-4-desktop">
			 			<button class="button is-dark is-outlined pinjam">
			 				<p>Wishlist</p>
			 				<span class="icon is-small">
			 					<i class="fa fa-heart-o"></i>
			 				</span>
			 			</button>
			 		</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('script')
<script>
  $('#container').css({
  	'background-size':'cover',
  	'background-image':'url(/front-assets/img/pattern.png)',
    'background-image': 'linear-gradient(to right, rgba(20,30,48,0.95) 0%, rgba(36, 59, 85, 0.95) 100%), url(/front-assets/img/pattern.png)'
});
</script>
@endsection