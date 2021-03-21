@extends('Main.layout.layout-app')
@section('content')
{{-- @include('Main.layout.notif-bubble') --}}
	<section id="page-buku" class="container is-fluid">
		<button class="button icon open-menu is-hidden-desktop">
			<i class="fa fa-bars"></i>
		</button>
		{{-- <div class="columns is-multiline is-mobile"> --}}
			@include('Main.layout.sidebar')
			<div class="column is-offset-3-desktop">
				<div class="columns is-multiline is-mobile is-tablet">
					<div class="column is-12-mobile is-12-tablet is-12-desktop banner">
						<section class="hero is-danger">
						  <div class="hero-body">
						  	<div class="columns is-multiline is-mobile is-tablet">
						  		<div class="column is-4-desktop books is-hidden-touch">
						  			@forelse($foto_sub as $foto)
						  			<figure>
						  				<img draggable="false" src="{{$foto->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$foto->foto_buku) : asset('/front-assets/foto_buku/book.png')}}" alt="">
						  			</figure>
						  			@empty

						  			@endforelse
						  		</div>
						  		<div class="column">
							  		<h4 class="title is-4">
							  			{{ $nama_sub }}
							  		</h4>
							  		<p class="subtitle is-6">
							  			{{ $keterangan }}
							  		</p>
							  		<p>total buku : <b>{{ count($val) }}</b></p>
						  		</div>
						  	</div>
						  </div>
						</section>
					</div>
					@forelse ($val as $buku)
					<div class="column is-10-mobile is-offset-1-mobile is-one-third-tablet is-one-quarter-desktop" data-aos="flip-right" data-aos-duration="900">
						<div class="card">
		    				<div class="card-image">
		    					<figure class="image is-1by1">
		    					<a href="{{ url('/buku',$buku->judul_slug) }}">
		    						<img src="{{ $buku->foto_buku != '-' ? asset('/front-assets/foto_buku/'.$buku->foto_buku) : asset('/front-assets/foto_buku/book.png')}}" draggable="false">
		    					</a>
		    					</figure>
		    				</div>
		    				<div class="card-content">
		    					<a href="{{ url('/buku',$buku->judul_slug) }}">
			 						<p class="title is-5">{{ Str::limit($buku->judul_buku,20) }}</p>
		    					</a>
								<div>
									<small>{{ tanggal_upload($buku->tanggal_upload) }}</small>
									<br>
									{{-- <span class="icon is-big">
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
									</span> --}}
								</div>
				 				<div>
				 					<div class="new-tag">
						 				<a href="{{ url('/kategori',$buku->slug_kategori) }}" class="tag tag-kategori is-danger">{{ $buku->nama_kategori }}</a>
						 				<a href="{{ url('/kategori/'.$buku->slug_kategori.'/sub-kategori',$buku->slug_sub_ktg) }}" class="tag tag-sub-ktg is-success">{{ $buku->nama_sub }}</a>
				 					</div>
				 				</div>
			 				</div>
			 				<div class="content">
			 					<div class="columns is-gapless is-multiline is-mobile">
			 						<div class="column is-10-desktop is-half-mobile">
			 							<a href="{{ url('/pinjam/buku',$buku->judul_slug) }}">
			 								<button class="button is-primary pinjam">Pinjam</button>
			 							</a>
			 						</div>
			 						<div class="column is-2-desktop is-half-mobile">
			 							<button class="button is-inverted is-dark pinjam" id="notif-wishlist">
			 								<span class="icon">
			 									<i class="fa fa-heart-o animated pulse"></i>
			 								</span>
			 							</button>
			 						</div>
			 					</div>
			 				</div>
		 				</div>
					</div>
					@empty
					<div class="column is-10-mobile is-offset-1-mobile is-one-third-tablet is-one-quarter-desktop">
						<h4 style="text-align: right;">Tidak Ada Buku</h4>
					</div>
					@endforelse
					{{-- <span class="icon is-large load-icon">
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</span>
					<div class="loading-page">
						<span class="icon is-large load-icon">
							<i class="fa fa-circle-o-notch fa-spin"></i>
						</span>
					</div> --}}
				</div>
				@if($val->hasPages())
				{{$val->links()}}
				@else
				<nav class="pagination is-centered">
				  <a class="pagination-previous">Previous</a>
				  <ul class="pagination-list">
				    <li><a class="pagination-link is-current">1</a></li>
				  </ul>
				  <a class="pagination-next">Next page</a>
				</nav>
				@endif
			</div>
		{{-- </div> --}}
	</section>
{{-- </div> --}}
@endsection

@section('script')
<script>
$(function(){
 //  	$('#container').css({
 //  		'background-color':'#f5f5f5'
	// });
    $("button.close-menu, .overlay").click(function(){
        $("#side-menu").css("left", "-300px");
        $('.overlay').fadeOut(200);
    });
    $("button.open-menu").click(function(){
        $("#side-menu").css("left", "0");
        $('.overlay').fadeIn(200);
    });
});
</script>
@endsection