@extends('admin.layout')

 
@section('css')
     <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/fontawesome-free/css/all.min.css')}}">


  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
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
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset(env('PUBLIC_URL').'adminlte/css/adminlte.min.css')}}">
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Modifier Employe</h3>
                </div>

                <form method="POST" action="{{route('employe_update')}}"  >
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <input type="number" class="form-control" value="{{$employe->id}}" name="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="matricule">Matricule</label>
                            <input type="text" value="{{$employe->matricule}}" class="form-control" id="matricule" name="matricule" placeholder="Matricule">
                            @error('matricule')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" value="{{$employe->nom}}" class="form-control" id="nom" name="nom" placeholder="Nom">
                            @error('nom')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" value="{{$employe->prenom}}" class="form-control" id="prenom" name="prenom" placeholder="Prenom">
                            @error('prenom')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cin">CIN</label>
                            <input type="text" value="{{$employe->cin}}" class="form-control" id="cin" name="cin" placeholder="CIN">
                            @error('cin')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cnss">CNSS</label>
                            <input type="text" value="{{$employe->cnss}}" class="form-control" id="cnss" name="cnss" placeholder="CNSS">
                            @error('cnss')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="entite">Entité</label>
                            <select class="form-control" id="entite" name="societe_id">
                                <option value="{{$employe->societe_id}}">{{$employe->societe->libelle}}</option>
                                @foreach ($entites as $entite)
                                    <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                @endforeach
                            </select>
                            @error('societe_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="client">Client</label>
                            <select class="form-control" id="client" name="client_id">
                                <option value="{{$employe->client_id}}">{{$employe->client->nom}}</option>
                                @foreach ($clients as $client)
                                
                                    <option value="{{$client->id}}">{{$client->nom}}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="site">Site</label>
                            <select class="form-control" id="site" name="site_id">
                                <option value="{{$employe->site_id}}">{{$employe->site->libelle}}</option>
                                @foreach ($sites as $site)
                                
                                    <option value="{{$site->id}}">{{$site->libelle}}</option>
                                @endforeach
                            </select>
                            @error('site_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{route('employes')}}"  class="btn btn-info">Annuler</a>
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
    <!-- date-range-picker -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- BS-Stepper -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{asset(env('PUBLIC_URL').'adminlte/plugins/dropzone/min/dropzone.min.js')}}"></script>


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
