<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Barcode</title>
 	
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono" rel="stylesheet">

	<style>
    @import url('https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text|Lobster|Montserrat|Source+Sans+Pro:700');
    .label{
        /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
        width: 220px; /* plus .6 inches from padding */
        /* height: .670in; */
        height: .940in; /* plus .125 inches from padding */
        padding: .10in 0in 0;
        margin-right: .125in; /* the gutter */
        margin-bottom: .130in; /* the gutter */
        float: left;
        display: block;
        text-align: center;
        overflow: hidden;
        outline: 1px dotted; 
        }
      /*.page-break {*/
      /*  clear: both;*/
      /*  display:block;*/
      /*  page-break-after:always;*/
      /*  }*/
      .text-nama {
        font-family: 'Share Tech Mono';
        font-size: 8pt;
        width:100%;
        text-align: center;
        line-height: 2pt;
      }
      .bar{
          font-family: 'Libre Barcode 128 Text', cursive;
          font-size:27pt;
      }
	</style>
</head>
<body>
	@foreach ($buku as $element)
	    <section class="sheet padding-10mm">
        <h5 style="text-align:center;font-family: 'Source Sans Pro', sans-serif;">
        	{{ $element->judul_buku }}
        </h5>
		@foreach ($barcode->where('id_buku',$element->id_buku)->get() as $value)
		<div class="label">
			<label class="bar"><img src="data:image/png;base64,{{ $barcode->code($value->code_scanner) }}" alt=""></label>
			<span class="text-nama">{{ $element->judul_buku }}</span>
		</div>
		@endforeach
		</section>
	@endforeach
</body>
</html>