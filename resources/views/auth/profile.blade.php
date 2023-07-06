@extends('admin.layout')

@section('css')
     
@endsection

@section('main')

    <div class="mt-5 mx-3 pt-5 ">
        <div class="row">
    
            <div class="content border pt-5 pb-5 mt-3 m-auto col-lg-8 col-md-10 col-sm-12">
        
                <table class="table  m-auto table-responsive table-sm col-lg-8 col-md-10 col-sm-12 ">
                    <h5 class="lead mb-3 pl-5">Informations personnelles</h5>
                    <tr>
                    <th>Nom d'utilisateur</th>
                    <td class="px-5">{{Auth::user()->prenom .' '. Auth::user()->nom}} </td>
                    <td><a class="text-success h6" href="/edit_username">Modifier</a></td>
                    </tr>
                    <tr>
                    <th>Adresse email</th>
                    <td class="px-5">{{Auth::user()->email}} </td>
                    <td><a class="text-success h6" href="/edit_email">Mettre à jours</a></td>
                    </tr>
                    {{-- <tr>
                    <th>Numéro de téléphone</th>
                    <td class="px-5">{{user.mobile}} </td>
                    <td><a class="text-success h6" href="/edit_mobile">Mettre à jours</a></td>
                    </tr> --}}
                    <tr>
                    <th>Mot de passe</th>
                    <td class="h4 px-5">. . . . . . . . . </td>
                    <td><a class="text-success h6" href="/edit_Password">Modifier</a></td>
                    </tr>
                    {{-- <tr>
                    <th>Adresse du domicile</th>
                    <td class="px-5">{{user.address}} </td>
                    <td><a class="text-success h6" href="/edit_address">Mettre à jours</a></td>
                    </tr> --}}
            
            
            
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    
@endsection
  