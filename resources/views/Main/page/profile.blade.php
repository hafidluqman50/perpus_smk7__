@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
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
<a href="{{ url('/') }}" class="back-menu"><i class="fa fa-arrow-circle-left fa-lg"></i> Kembali</a>
<div class="banner2"></div>
<section id="profil">
	<figure class="foto-siswa">
		<img src="{{asset($anggota->foto_profile == '' || $anggota->foto_profile == '-' ? '/front-assets/profile_anggota/1498308623.learning.svg' : $anggota->foto_profile)}}" alt="">
	</figure>
	<div class="container">
			<div class="columns is-multiline data-siswa">
				<div class="column is-10-mobile is-offset-1-mobile is-5-tablet is-offset-1-tablet is-4 is-offset-2-desktop">
					<ul>
						<p class="title is-6">nomor induk </p>
						<li class="subtitle is-4">
						{{ $anggota->nomor_induk }}</li>
						<p class="title is-6">nama </p>
						<li class="subtitle is-4">
						{{ $anggota->nama_anggota }}</li>
						<p class="title is-6">username </p>
						<li class="subtitle is-4">
						{{ $anggota->username }}</li>
					</ul>
				</div>
				<div class="column is-10-mobile is-offset-1-mobile is-5-tablet is-4">
					<ul>
						<p class="title is-6">email </p>
						<li class="subtitle is-4">
						{{ $anggota->email }}</li>
		    			@if($anggota->tipe_anggota == 'siswa')
		    			<p class="title is-5">Kelas</p>
		    				<li class="subtitle is-4">
		    				{{ $anggota->kelas_tingkat.' '.$anggota->nama_jurusan.' '.$anggota->urutan_kelas }}</li>
		    			@endif
					</ul>
				</div>
				<div class="column is-10-mobile is-offset-1-mobile is-10-tablet is-offset-1-tablet is-offset-2-desktop is-8-desktop">
				<div class="columns is-multiline is-mobile is-tablet">
					<div class="column is-3-tablet is-half-mobile is-2-tablet is-2-desktop">
						<a class="button is-primary" href="{{ url('/ubah/profile') }}">Sunting
						</a>
					</div>
					<div class="column is-offset-4-tablet is-2-tablet is-4-desktop is-offset-6-desktop">
						<a class="button is-danger" href="{{ url('/logout') }}">
							Logout
						</a>
					</div>
				</div>
				</div>
			</div>
	<br>

	<section id="list-transaksi">
			<p class="title is-4 pinjaman">
				Peminjaman Buku
			</p>
			<div class="columns is-multiline">
				@forelse ($cek as $value)
				<div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<div class="card">
						<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
			    					<a href="{{ url('/buku',$value->judul_slug) }}">
			    						<img src="{{ $value->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$value->foto_buku) : asset('/front-assets/foto_buku/book.png') }}" draggable="false">
			    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
			 					<a href="{{ url('/buku',$value->judul_slug) }}">
				 					<p class="title is-5">
				 						{{ Str::limit($value->judul_buku,17) }}
				 					</p>
			 					</a>
								<div>
									<small>{{ tanggal_upload($value->tanggal_upload) }}</small>
									<br>
									<div class="new-tag" style="margin-bottom:0!important;">
				 						@if($value->status_transaksi == 'pending')
				 						<a href="#" class="tag tag-kategori is-warning">Pending</a>
				 						@elseif($value->status_transaksi == 'sedang-dipinjam')
				 						<a href="#" class="tag tag-kategori is-primary">Sedang Dipinjam</a>
				 						@elseif($value->status_transaksi == 'batal-pinjam')
				 						<a href="#" class="tag tag-kategori is-danger">Batal Pinjam</a>
				 						@elseif($value->status_transaksi == 'kembali')
				 						<a href="#" class="tag tag-kategori is-info">Sudah Kembali</a>
				 						@endif
									</div>
									<span class="icon is-big">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-big">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-big">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-big">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon is-big">
										<i class="fa fa-star-o"></i>
									</span>
								</div>
				 				<div>
				 					<div class="new-tag">
					 					<a href="{{ url('/kategori',$value->slug_kategori) }}" class="tag tag-kategori is-danger">{{ $value->nama_kategori }}</a>
					 					<a href="{{ url('/kategori/'.$value->slug_kategori.'/sub-kategori',$value->slug_sub_ktg) }}" class="tag tag-sub-ktg is-success">{{ $value->nama_sub }}</a>
				 					</div>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless is-multiline is-mobile">
			 						<div class="column is-10-desktop is-half-mobile">
			 							<a href="{{url('/pinjam/buku/detail/'.$value->id_detail_transaksi)}}">
			 								<button class="button is-primary pinjam">Detail Pinjam</button>
			 							</a>
			 						</div>
			 						<div class="column is-2-desktop is-half-mobile">
			 							<button class="button is-inverted is-dark pinjam notif-wishlist">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
		 			</div>
				</div>
				@empty
				<div class="column is-one-third-table is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<p>Tidak Ada Data Transaksi</p>
				</div>
				@endforelse
			</div>
	</section>
	<br>
	<section id="wishlist">
			<p class="title is-4 pinjaman">
				Buku wishlist
			</p>
			<div class="columns is-multiline">
				<div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					Tidak Ada Wishlist Buku
				</div>
				{{-- <div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
		    					<a href="#">
		    						<img src="{{ asset('/front-assets/img/buku6.jpg') }}" draggable="false">
		    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
			 					<p class="title is-4">Deadpool corps</p>
									<small>1 Jan 2016 -
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									</small>
				 				<div>
					 				<a class="tag is-danger">blood</a>
					 				<a class="tag is-success">comedy</a>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless">
			 						<div class="column is-10">
			 							<button class="button is-primary pinjam">Pinjam</button>
			 						</div>
			 						<div class="column is-2">
			 							<button class="button is-inverted is-dark pinjam">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
				</div>
				<div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
		    					<a href="#">
		    						<img src="{{ asset('/front-assets/img/buku6.jpg') }}" draggable="false">
		    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
			 					<p class="title is-4">Deadpool corps</p>
									<small>1 Jan 2016 -
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									</small>
				 				<div>
					 				<a class="tag is-danger">blood</a>
					 				<a class="tag is-success">comedy</a>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless">
			 						<div class="column is-10">
			 							<button class="button is-primary pinjam">Pinjam</button>
			 						</div>
			 						<div class="column is-2">
			 							<button class="button is-inverted is-dark pinjam">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
				</div>
				<div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
		    					<a href="#">
		    						<img src="{{ asset('/front-assets/img/buku6.jpg') }}" draggable="false">
		    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
			 					<p class="title is-4">Deadpool corps</p>
									<small>1 Jan 2016 -
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									</small>
				 				<div>
					 				<a class="tag is-danger">blood</a>
					 				<a class="tag is-success">comedy</a>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless">
			 						<div class="column is-10">
			 							<button class="button is-primary pinjam">Pinjam</button>
			 						</div>
			 						<div class="column is-2">
			 							<button class="button is-inverted is-dark pinjam">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
				</div>
				<div class="column is-one-third-tablet is-10-mobile is-offset-1-mobile is-one-quarter-desktop">
					<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
		    					<a href="#">
		    						<img src="{{ asset('/front-assets/img/buku6.jpg') }}" draggable="false">
		    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
			 					<p class="title is-4">Deadpool corps</p>
									<small>1 Jan 2016 -
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									<span class="icon is-small">
										<i class="fa fa-star-o"></i>
									</span>
									</small>
				 				<div>
					 				<a class="tag is-danger">blood</a>
					 				<a class="tag is-success">comedy</a>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless">
			 						<div class="column is-10">
			 							<button class="button is-primary pinjam">Pinjam</button>
			 						</div>
			 						<div class="column is-2">
			 							<button class="button is-inverted is-dark pinjam">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
				</div> --}}
			</div>
	</section>
	</div>
</section>
@endsection

@section('script')
<script>
$(function(){
	$('#container').css({
		'background-color':'#efefef'
	});                      
	$(".star").click(function() {  
		$(this).addClass("active");      
	});
	// $('.show').each(function(){
	// 	$(this).show().animate({
	// 		right:'10px'
	// 	},300);
	// 	$('.is-notif:first-child').clone().appendTo('.show').show().animate({
	// 		right:'10px'
	// 	},300).delay(5000).fadeOut();
	// });
});
</script>
@endsection