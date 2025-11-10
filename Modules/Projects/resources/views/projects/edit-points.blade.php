



<div id="edit-points-container">
    @include('Projects::projects._edit-points', [

        'stolb' => $stolb,


])
</div>



<!-- toastr CSS -->
<link rel="stylesheet" href="{{ url('LTE/plugins/toastr/toastr.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ url('LTE/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ url('LTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<!-- Select2 -->
<script src="{{url('LTE/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- toastr JS -->
<script src="{{url('LTE/plugins/toastr/toastr.min.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
