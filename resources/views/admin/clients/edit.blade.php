@extends('admin.layout')

 
@section('css')

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/dropzone/min/dropzone.min.css')}}">
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Modifier le Client</h3>
                </div>

                <form method="POST" action="{{route('client_update')}}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <input type="number" value="{{$client->id}}" class="form-control" id="id" name="id"  hidden>
                        </div>
                        <div class="form-group">
                            <label for="code">code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{$client->code}}">
                            @error('code')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{$client->nom}}">
                            @error('nom')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" value="{{$client->logo}}" class="custom-file-input" id="file" name="logo">
                                    <label class="custom-file-label" for="file">Choisir un fichier</label>
                                </div>
                            </div>
                            <div>
                                N.B fichier image (jpeg, png etc)
                            </div>
                            @error('logo')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mi_affaire_mi">Numéro Affaire (MI)</label>
                            <input type="text" class="form-control" id="mi_affaire_mi" name="mi_affaire_id" value="{{$client->mi_affaire_id}}">
                        </div>
                        <div class="form-group">
                            <label for="mi_affaire_gms">Numéro Affaire (GMS)</label>
                            <input type="text" class="form-control" id="mi_affaire_gms" name="gms_affaire_id" value="{{$client->gms_affaire_id}}">
                        </div>
                        <div class="form-group">
                            <label for="mg">Numéro Affaire (MG)</label>
                            <input type="text" class="form-control" id="mg" name="mg_affaire_id" value="{{$client->mg_affaire_id}}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{route('clients')}}"  class="btn btn-info">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')

<!-- bs-custom-file-input -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset(env('PUBLIC_URL').'portail/public/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- BS-Stepper -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{asset('adminlte/plugins/dropzone/min/dropzone.min.js')}}"></script>


    <!-- AdminLTE App -->
    <!--<script src="{{asset(env('PUBLIC_URL').'adminlte/js/adminlte.min.js')}}"></script>-->
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        // $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });



        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()


        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
    </script>
@endsection
