<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Tüm Haklası Saklıdır &copy; {{ $config->title." ".date('Y')}}</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{asset('back/dist')}}/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{asset('back/dist')}}/assets/demo/chart-area-demo.js"></script>
<script src="{{asset('back/dist')}}/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{asset('back/dist')}}/assets/demo/datatables-demo.js"></script>

<!-- SUMMERNOTE JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- SUMMERNOTE JS EKLENTİSİ -->
<script src="{{asset('back/dist')}}/js/summernote.js"></script>

<!-- IZITOAST JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- ALERT PHP -->
@include('back.layout.alert')

@toastr_js
@toastr_render


<!-- SORTABLE -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@include('back.layout.custom')

</body>
</html>
