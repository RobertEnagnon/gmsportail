{{-- <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark-Mode-Dashboard</title>
    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- Style css -->
    <link rel="stylesheet" href={{ asset('css/adminStyle.css') }}>

</head>

<body>
    <div class="container">
        <!-- -------------------ASIde SECTION------------------------- -->
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2 class="text-muted">RON <span class="danger">ASDEV</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="{{route('dashboard')}}">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Tableau de bord</h3>
                </a>
                <a href="{{route('documents')}}" class="active">
                    <span class="material-icons-sharp"></span>
                    <h3>Documents</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Factures</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Tâches et Planning</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Tickets</h3>
                    <span class="message-count">30</span>
                </a>
                <a href="{{route('clients')}}">
                    <span class="material-icons-sharp"></span>
                    <h3>Clients</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Sites</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Employés</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp"></span>
                    <h3>Utilisateurs</h3>
                </a>
                <a href="{{route('options')}}">
                    <span class="material-icons-sharp"></span>
                    <h3>Options</h3>
                </a>
            </div>
        </aside>
        <!-- ---------------------A MAIN SECTION------------------- -->
        <main>
            <h1>Dashboar</h1>
            <div class="date">
                <input type="date" name="" id="">
            </div>
            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Vente Totale</h3>
                            <h1>$25,044</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">24h passée</small>
                </div>
                <!-- End of sales -->
                <div class="expenses">
                    <span class="material-icons-sharp">bar_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Dépenses Totale</h3>
                            <h1>$44,044</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>62%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">24h passée</small>
                </div>
                <!-- End of expenses -->
                <div class="incomes">
                    <span class="material-icons-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Revenue Totale</h3>
                            <h1>$110,044</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">24h passée</small>
                </div>
                <!-- End of incomes -->
            </div>
            <!-- End of insights -->
            <div class="recent-orders">
                <h2>Commandes recentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom produit</th>
                            <th>Numero produit</th>
                            <th> Payement</th>
                            <th> Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>Fordable mini drone</td>
                            <td>73836</td>
                            <td>Due</td>
                            <td class="warning">En attente</td>
                            <td class="primary">Details</td>
                        </tr> -->

                    </tbody>
                </table>
                <a href="#">Afficher tous</a>
            </div>
        </main>
        <!-- ------------------END OF MAIN -------------------- -->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
                <div class="profil">
                    <div class="info">
                        <p>Hey, <b>Robert</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profil-photo">
                        <img src="images/profil.jpg" alt="">
                    </div>
                </div>
            </div>
            <!-- -----------------END OF TOP ----------------------- -->
            <div class="recent-updates">
                <h2>Mise à jours récentes</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profil-photo">
                            <img src="images/bb.jpeg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Gisele MAHINOU</b> a réçu sa commande de Night lion tech GPS drône</p>
                            <small class="text-muted">2 Minutes passées</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profil-photo">
                            <img src="images/gauthier.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Gauthier ATANON</b> a réçu sa commande de Night lion tech GPS drône</p>
                            <small class="text-muted">2 Minutes passées</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profil-photo">
                            <img src="images/mad.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Madoché BLENON</b> a réçu sa commande de Night lion tech GPS drône</p>
                            <small class="text-muted">2 Minutes passées</small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ----------------------END OF RECENT UPDATES------------------- -->
            <div class="sales-analytics">
                <h2>Statistiques de ventes</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">shopping_cart</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>COMMANDES EN LIGNE</h3>
                            <small class="text-muted">24 heures passées</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>344344</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">local_mall</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>COMMANDES HORS LIGNE</h3>
                            <small class="text-muted">24 heures passées</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>2229</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">person</span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NOUVEAU CLIENTS</h3>
                            <small class="text-muted">24 heures passées</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp">add</span>
                        <h3>Ajouter un Produit</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src={{ asset('js/orders.js') }} async></script>
    <script src={{ asset('js/index.js') }} async></script>
</body>

</html> --}}
@extends('admin.layout')

@section('main')
    dashboard
@endsection
