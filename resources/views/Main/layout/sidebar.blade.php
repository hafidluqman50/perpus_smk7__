<div class="columns is-multiline is-desktop is-mobile">
		<div class="column is-3-desktop is-fixed" id="side-menu">
		<button class="delete close-menu" onclick="closeMenu()"></button>
		<aside class="menu">
			<div class="back-button">
			  <a href="#" onclick="window.history.back()"> <i class="fa fa-arrow-circle-left"></i> Kembali</a>
			</div>
			<div class="search-button">
				  <p class="menu-label">
						<span class="ticon is-small">
							<i class="fa fa-search"></i>
						</span>
				    Cari buku
				  </p>
				  <ul class="menu-list">
				  	<form action="{{ cari_buku() }}" method="GET">
					  	<div class="columns is-multiline is-mobile is-tablet">
						  	<div class="column is-10">
							  	<div class="field">
									<input class="input" type="text" placeholder="Judul buku" name="cari" value="{{isset($_GET['cari']) ? $_GET['cari'] : ''}}">
								</div>
						  	</div>
						  	<div class="column is-2">
						  		<button class="button">
									<span class="icon is-small">
										<i class="fa fa-search"></i>
									</span>
						  		</button>
						  	</div>
						</div>
				  	</form>
				  </ul>
			</div>
			<div class="categori-button">
			  <p class="menu-label">
					<span class="icon is-small">
						<i class="fa fa-book"></i>
					</span>
			    kategori buku
			  </p>
			</div>
			  <ul class="menu-list kategori">
			    <li><a href="{{ url('/buku') }}">Semua buku</a></li>
			    @foreach ($kategori as $val)
			    <li>
			    	<a href="{{ url('/kategori',$val->slug_kategori) }}">
			    		{{ $val->nama_kategori }} <span class="tag is-primary">{{ $ktg->num_rows_kategori($val->slug_kategori) }}</span>
			    	</a>
					<ul>
						@foreach ($sub_ktg->get_sub($val->id_kategori_buku) as $sub)
						<li>
							<a href="{{ url('/kategori/'.$val->slug_kategori.'/sub-kategori',$sub->slug_sub_ktg) }}">
								{{ $sub->nama_sub }} <span class="tag is-primary">{{ $sub_ktg->num_rows_sub($sub->slug_sub_ktg) }}</span>
							</a>
						</li>
						@endforeach
					</ul>
			    </li>
			    @endforeach
			  </ul>
		</aside>
	</div>