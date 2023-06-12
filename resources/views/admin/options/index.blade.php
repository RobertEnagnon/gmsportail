@extends('admin.layout')
  @section('css')
      
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> --}}

  @endsection
  @section('main')
    <div class="row">
            
      <div class="col-8">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="options" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="service-tab" data-toggle="tab" data-target="#service" type="button" role="tab" aria-controls="service" aria-selected="true">Service</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="priorite-tab" data-toggle="tab" data-target="#priorite" type="button" role="tab" aria-controls="priorite" aria-selected="false">Priorité</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="typeDoc-tab" data-toggle="tab" data-target="#typeDoc" type="button" role="tab" aria-controls="typeDoc" aria-selected="false">Type Document</button>
          </li>
          
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="service" role="tabpanel" aria-labelledby="service-tab">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des services</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a href="{{route('service_create')}}" class="btn btn-primary">Créer un nouveau</a>
                  <thead>
                  <tr>
                      <th>N°</th>
                      <th>Libelle</th>
                      <th>Adresse mail </th>
                      <th></th>
                  </tr>
                  </thead>
      
                  <tbody>
                      @foreach ($services as $service)
                          <tr>
                              <td>{{$service->id}}</td>
                              <td>{{$service->libelle}}</td>
                              <td>{{$service->email}}</td>
                              <td class="d-flex justify-content-end">
                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-sm m-1" href="{{route('service_edit',$service->id)}}">
                                  <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{route('service_delete',$service->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn-danger btn-sm serviceSupp" >
                                    <i class="fas fa-trash"></i> 
                                  </button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

          </div>

          <div class="tab-pane" id="priorite" role="tabpanel" aria-labelledby="priorite-tab">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des Priorités</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a href="{{route('priorite_create')}}" class="btn btn-primary">Créer un nouveau</a>
                  <thead>
                  <tr>
                      <th>N°</th>
                      <th>Libelle</th>
                      <th></th>
                  </tr>
                  </thead>
      
                  <tbody>
                      @foreach ($priorites as $priorite)
                          <tr>
                              <td>{{$priorite->id}}</td>
                              <td>{{$priorite->libelle}}</td>
                              <td class="d-flex justify-content-end">
                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-sm m-1" href="{{route('priorite_edit',$priorite->id)}}">
                                  <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{route('priorite_delete',$priorite->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn-danger btn-sm prioritesSupp" >
                                    <i class="fas fa-trash"></i> 
                                  </button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          <div class="tab-pane" id="typeDoc" role="tabpanel" aria-labelledby="typeDoc-tab">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Types de documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a href="{{route('type_document_create')}}" class="btn btn-primary">Créer un nouveau</a>
                  <thead>
                  <tr>
                      <th>N°</th>
                      <th>Libelle</th>
                      <th></th>
                  </tr>
                  </thead>
      
                  <tbody>
                      @foreach ($typesDoc as $typeDoc)
                          <tr>
                              <td>{{$typeDoc->id}}</td>
                              <td>{{$typeDoc->libelle}}</td>
                              <td class="d-flex justify-content-end ">
                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-outline-dark btn-sm m-1" href="{{route('type_document_edit',$typeDoc->id)}}">
                                  <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{route('type_document_delete',$typeDoc->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn-danger btn-sm typesDocSupp" >
                                    <i class="fas fa-trash"></i> 
                                  </button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>


      

    </div>
  @endsection

  @section('js')
 <script>
 $('#options button').on('click', function (event) {
    event.preventDefault()
    $(this).tab('show')
  })
 </script>
 
 <script src="{{asset('js/admin/options.js')}}"></script>
  @endsection
 


  
  
