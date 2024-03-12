</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2023 <span class="text-info">oktaviafatma</span></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="<?=$main_url?>asset/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?=$main_url?>asset/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=$main_url?>asset/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=$main_url?>asset/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=$main_url?>asset/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=$main_url?>asset/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<!-- AdminLTE -->
<script src="<?=$main_url?>asset/AdminLTE/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?=$main_url?>asset/AdminLTE/plugins/chart.js/Chart.min.js"></script>

<script>
    $(function(){
        let tema = sessionStorage.getItem('tema');
        if (tema) {
            $('body').addClass(tema);
            $('#cekDark').prop('checked', true);
        }

        $(document).on('click', "#cekDark", function(){
            if ($('#cekDark').is(':checked')) {
                $('body').addClass('dark-mode');
                sessionStorage.setItem('tema', 'dark-mode');
            } else {
                $('body').removeClass('dark-mode');
                sessionStorage.removeItem('tema');
            }
        })


        $('#tblData').DataTable();
    });
</script>

</body>

</html>