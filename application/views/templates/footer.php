<!-- Main Footer -->
<footer class="container mb-4">
	<strong>Rizki Dwi &copy;2022</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/js/script_pages.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- page script Table -->
<script src="<?= base_url() ?>assets/js/pages/custom.js"></script>
<script src="<?= base_url() ?>assets/js/app.min.js"></script>
<script src="<?= base_url() ?>assets/Chart.js"></script>

<script>
	$(function() {
		$('#datatable_dataset').DataTable();
	});
	$(function() {
		$('#datatable_pemisahandataset').DataTable();
	});
	$(function() {
		$('#datatable_prosestesting').DataTable();
	});
</script>

</body>

</html>