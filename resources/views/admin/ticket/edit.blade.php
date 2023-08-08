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
                  <h3 class="card-title">Modifier Ticket</h3>
                </div>

                <form method="POST" action="{{route('ticket_update')}}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <input type="number" class="form-control m-1"  value="{{$ticket->id}}" name="id" hidden>
                        <div class="form-inline mb-3">
                            <div class="form-group">
                                <label for="prenom" class="mr-4">Nom</label>
                                <input type="text" class="form-control m-1" value="{{$ticket->user->prenom}}" id="prenom"  name="prenom" disabled>
                            </div>

                            <div class="form-group">
                                <label for="email" class="mr-1">Courriel</label>
                                <input type="email" class="form-control m-1" value="{{$ticket->user->email}}" id="email"  name="email" disabled>
                            </div>

                            <div class="form-group">
                                <label for="numero" class="mr-1">Numero</label>
                                <input type="number" class="form-control m-1"  value="{{$ticket->user_id}}" name="user_id" hidden>
                                <input type="number" class="form-control m-1" id="numero" value="{{$ticket->user_id}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre du Ticket *</label>
                            <input type="text" class="form-control" value="{{$ticket->titre}}" id="titre" name="titre">
                            @error('titre')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="d-lg-flex justify-content-lg-between align-items-lg-center mb-3">
                            <div class="w-100 mr-lg-1">
                                <label for="service" >Assigner à</label>
                                <select class="form-control" id="service" name="service_id">
                                    <option value="{{$ticket->service_id}}">{{$ticket->service->libelle}}</option>
                                    @foreach ($services as $service)
                                    
                                        <option value="{{$service->id}}">{{$service->libelle}}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="text-danger">{{$message}}</div> 
                                @enderror
                            </div>
                            <div class="w-100">
                                <label for="priorite" >Priorité </label>
                                <select class="form-control" id="priorite" name="priorite_id">
                                    <option value="{{$ticket->priorite_id}}">{{$ticket->priorite->libelle}}</option>
                                    @foreach ($priorites as $priorite)
                                    
                                        <option value="{{$priorite->id}}">{{$priorite->libelle}}</option>
                                    @endforeach
                                </select>
                                @error('priorite_id')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="client_id" value="{{$ticket->client_id}}" hidden>
                        </div>
                        <div class="form-group">
                            <label for="entite">Entité</label>
                            <select class="form-control" id="entite" name="societe_id">
                                <option value="{{$ticket->societe_id}}">{{$ticket->societe->libelle}}</option>
                                @foreach ($entites as $entite)
                                    <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Fichier</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" value="{{$ticket->fichier}}" class="custom-file-input" id="file" name="fichiers[]">
                                    <label class="custom-file-label" for="file">Choisir un ou plusieurs fichier(s)</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Détail *</label>
                            <textarea name="message" id="message"  rows="5" class="form-control">
                                <?php echo count($ticket->messages) > 0 ? $ticket->messages[count($ticket->messages)-1]->content : "okok" ?>
                            </textarea>
                            @error('message')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            
                            <select name="status" id="status" class="form-control" style="font-size: 20px"  hidden>
                                <option value="Ouvert" {{ $ticket->status == 'Ouvert' ? 'selected' : '' }}> Ouvert </option>
                                <option value="Répondu" {{ $ticket->status == 'Répondu' ? 'selected' : '' }}>Répondu</option>
                                <option value="Réponse du client" {{ $ticket->status == 'Réponse du client' ? 'selected' : '' }}>Réponse du client</option>
                                <option value="Fermé" {{ $ticket->status == 'Fermé' ? 'selected' : '' }}>Fermé</option>
                            </select>
                        </div> --}}

                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{route('tickets')}}"  class="btn btn-info">Annuler</a>
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

<script src="https://cdn.tiny.cloud/1/ix8b72cwx40l8ynsz2d4t2hra6pq2tlsaiodp7b8uhowd28x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
     selector: 'textarea#message', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
   });
</script>
@endsection
