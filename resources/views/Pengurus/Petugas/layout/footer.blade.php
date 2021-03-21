
</body>
</html>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin-assets/plugins/select2/select2.full.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-assets/dist/js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin-assets/dist/js/demo.js')}}"></script>
<!-- PAGE SCRIPTS -->
{{-- <script src="{{asset('admin-assets/dist/js/pages/dashboard2.js')}}"></script> --}}
<!-- PLUGINS -->
<script src="{{asset('admin-assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-assets/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
	// $(function(){
	// 	$('.table').DataTable();
	// });
	$(function(){
		$('#tahun-ajaran').on('keypress keyup blur',function(event){
			console.log(event.which);
		});
		$('.select2').select2();
		$('.select-buku').select2({
			placeholder:"=== Pilih Buku ==="
		});
		$('.select-siswa').select2({
			placeholder:'=== Pilih Siswa ==='
		});
	});
</script>
<script src="{{asset('admin-assets/dist/js/custom.js')}}"></script>