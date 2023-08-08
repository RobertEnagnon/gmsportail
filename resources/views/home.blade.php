<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GMSPortail</title>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href={{ asset( env('PUBLIC_URL').'css/style.css') }}>

    <style>
        .main-timeline-2 {
        position: relative;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2::after {
        content: "";
        position: absolute;
        width: 3px;
        background-color: #26c6da;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
        }

        /* Container around content */
        .timeline-2 {
        position: relative;
        background-color: inherit;
        width: 50%;
        }

        /* The circles on the timeline */
        .timeline-2::after {
        content: "";
        position: absolute;
        width: 25px;
        height: 25px;
        right: -11px;
        background-color: #26c6da;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
        }

        /* Place the container to the left */
        .left-2 {
        padding: 0px 40px 20px 0px;
        left: 0;
        }

        /* Place the container to the right */
        .right-2 {
        padding: 0px 0px 20px 40px;
        left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left-2::before {
        content: " ";
        position: absolute;
        top: 18px;
        z-index: 1;
        right: 30px;
        border: medium solid white;
        border-width: 10px 0 10px 10px;
        border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right-2::before {
        content: " ";
        position: absolute;
        top: 18px;
        z-index: 1;
        left: 30px;
        border: medium solid white;
        border-width: 10px 10px 10px 0;
        border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right-2::after {
        left: -14px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {
        /* Place the timelime to the left */
        .main-timeline-2::after {
            left: 31px;
        }

        /* Full-width containers */
        .timeline-2 {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        /* Make sure that all arrows are pointing leftwards */
        .timeline-2::before {
            left: 60px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Make sure all circles are at the same spot */
        .left-2::after,
        .right-2::after {
            left: 18px;
        }

        .left-2::before {
            right: auto;
        }

        /* Make all right containers behave like the left ones */
        .right-2 {
            left: 0%;
        }
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src={{ asset(env('PUBLIC_URL').'img/logo_gmsportail_.png') }}
                    alt="GMSPORTAIL" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#about">A propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#history">Historique</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Bienvenu sur le Portail!</div>
            <div class="masthead-heading text-uppercase">Heureux de vous rencontrer</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#contact">Nous Contactez</a>
        </div>
    </header>
        <!-- About-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">A Propos de Nous</h2>
                <h3 class="section-subheading text-muted">Groupe Mondial Service .</h3>
            </div>
            <div class="d-lg-flex justify-content-between align-items-center">
                <div class="col-lg-6 pe-2">
                    <p>
                        Acteur omnipotent et en perpétuelle croissance de sa gamme de services dédiés aux institutionnels et aux professionnels, 
                        <span class="text-info text-uppercase">GrOUPE MONDIAL SERVICE</span> se dresse un modèle de développement pluridisciplinaire (managérial, technique, en qualité…) 
                        pour se conformer aux contraintes d’un marché devenu de plus en plus exigent.
                    </p>
                    <p>
                        Depuis sa création, <span class="text-info text-uppercase">gROUPE MONDIAL SERVICE </span> est conscient de son choix stratégique: 
                        l’omniprésence par le biais d’une gamme de prestation diversifiée en nettoyage, en gardiennage et en intérim.
                    </p>
                    <h6 class="text-decoration-underline"> En effet, la priorité au sein du groupe s’articule autour de paliers :</h6>
                    <p>
                          L’écoute et la réactivité via un système proactif et réactif. <br>
                           La qualité des prestations. <br>
                          La collaboration de l’équipe; symbole de coopération, 
                        de fidélité et de la bonne pratique de communication interne. <br>
                    </p>
                    <p>
                        Par ailleurs et pour toucher davantage plusieurs secteurs de l’économie nationale, <span class="text-info text-uppercase">gROUPE MONDIAL SERVICE </span> booste 
                        sa Force de Vente et l’oriente vers la conquête de nouveaux 
                        débouchés en déployant les nouvelles techniques de chacun de ses métiers.
                    </p> 
                </div>
                <div class="col-lg-6  ">
                    <div class="card bg-dark text-white">
                        <img src={{ asset(env('PUBLIC_URL').'img/about/about-securite.jpg') }} class="card-img" alt="...">
                        <div class="card-img-overlay">
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Services</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row text-center">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" 
                      data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" 
                      aria-controls="home" aria-selected="true">Intérim</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" 
                      data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" 
                      aria-controls="profile" aria-selected="false">Gardiennage</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" 
                      data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" 
                      aria-controls="contact" aria-selected="false">Nettoyage</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        Face à un marché en plein essor, l’exigence des compétences actuelles et le besoin des entreprises en recrutement 
                        qui ne cessent pas de croître, Mondial Intérim combine un ensemble de solutions efficaces à l’insertion professionnelle; la prise en charge du personnel intérimaire et l’épanouissement des carrières.

                        Pour satisfaire ses clients, Mondial Intérim s’appuie sur ses valeurs professionnelles inhérentes cherchant 
                        une meilleure qualité de service et le maintien de la confiance de ses clients.

                        La gamme de solutions de Mondial Intérim englobe l’intérim, le recrutement et le travail temporaire.

                        Confiez ce métier à un professionnel Mondial Intérim est votre partenaire professionnel en gestion ressources humaines.

                        Notre équipe de travail suit un modèle unique grâce à une CVthèque riche et variée qui combine 
                        en amont la recherche des profils avec la mise à dispositions des compétences.
                        En aval, une présence émérite d’une procédure de suivi, ayant pour but d’évaluer en permanence votre satisfaction. 
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p>
                            Dans un marché où s’accroit notablement le nombre des entreprises , 
                            le besoin de la sécurité s’accroit également. Groupe Mondial Service se fait un prestataire visionnaire, 
                            qui sait combler les exigences et se conforme aux normes du marché. Un agent motivé fait un client satisfait, l’implication
                            de nos agents de sécurité véhicule notre image de marque qu’on veille à entretenir et consolider à travers notre gamme de services:
                        </p>
                       <p>
                              La surveillance des sites industriels et des zones d’activité. <br>
                            
                              Le gardiennage des immeubles et des bureaux. <br>
                            
                              L’accueil et le contrôle d’accès. <br>
                            
                              Le conseil et la gestion des risques. <br>
                       </p>
                        <p>
                            Bien notamment, une communication interne et régulière avec nos 
                            superviseurs et contrôleurs qui interviennent sur vos sites, nous permet de rester vigilent à l’encontre de votre satisfaction. 
                        </p>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div>
                            GROUPE MONDIAL SERVICE est votre partenaire professionnel au quotidien qui vous offre plusieurs avantages 
                            à l’aide d’une mise en valeur, un entretien régulier et ponctuel de vos lieux de travail.
                        </div>

                        <h5>Nos services :</h5>
                         <p>
                               Nettoyage et entretien des locaux industriels et commerciaux. <br>
                        
                            Nettoyage de la vitrerie et façade.<br>
                        
                            Traitement des sols et des revêtements de sols.<br>
                        
                            Nettoyage de moquettes et des revêtements textiles.<br>
                        
                            Remise en état des sols et des surfaces dégradés.
                        <br>
                            Remise en état des locaux.<br>
                        
                            Evacuation des déchets.<br>
                        
                            Travaux de fin de chantiers<br>
                        
                            Nettoyage des surfaces:<br>
                        
                               Plafonds acoustiques.<br>
                        
                               Vinyles.<br>
                        
                               Surfaces alucobonds. <br>
                         </p>
                    </div>
                  </div>
                  

                {{-- <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime
                        quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Responsive Design</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime
                        quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Web Security</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime
                        quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- history -->
    <section class="page-section bg-light" id="history">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Historique</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <div class="row">
                <section style="background-color: #F0F2F5;">
                    <div class="container py-5">
                      <div class="main-timeline-2">
                        <div class="timeline-2 left-2">
                          <div class="card">
                            <div class="card-body p-4">
                              <h4 class="fw-bold mb-4">Autorisation</h4>
                              <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2013</p>
                              <p class="mb-0">MONDIAL GARDIENNAGE Obtient
                                 l’autorisation d’utilisations des chiens pour les métiers de Gardiennage.</p>
                            </div>
                          </div>
                        </div>
                        <div class="timeline-2 right-2">
                          <div class="card">
                            <div class="card-body p-4">
                              <h4 class="fw-bold mb-4">Succès</h4>
                              <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2012</p>
                              <p class="mb-0">
                                MONDIAL INTERIM obtient l’autorisation d’exercer l’intermédiation en matière de recrutement.
                                MONDIAL GARDIENNAGE obtient l’autorisation d’exercer les métiers de Gardiennage. <br>
                                MONDIAL SERVICE certifié ISO 9001 V2008. <br>
                                MONDIAL GARDIENNAGE certifié ISO 9001 V2008. <br>
                                MONDIAL INTERIM Certifié ISO 9001 V2008. <br>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                              <div class="card-body p-4">
                                <h4 class="fw-bold mb-4">Nouvelle agence</h4>
                                <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2011</p>
                                <p class="mb-0">Ouverture d’une agence à Marrakech</p>
                              </div>
                            </div>
                        </div>
                        <div class="timeline-2 right-2">
                        <div class="card">
                            <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Eagle Award</h4>
                            <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2010</p>
                            <p class="mb-0">
                                MONDIAL SERVICE reçoit le prix International : Golden Eagle Award Africa 2010 .
                            </p>
                            </div>
                        </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                              <div class="card-body p-4">
                                <h4 class="fw-bold mb-4">Nouvelle filiale</h4>
                                <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2009</p>
                                <p class="mb-0">
                                    Création de la filiale d’intérim MONDIAL INTERIM.
                                </p>
                              </div>
                            </div>
                        </div>
                        <div class="timeline-2 right-2">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4">Nouveau service</h4>
                                    <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2008</p>
                                    <p class="mb-0">
                                        MONDIAL SERVICE devient un groupe Création de la filiale de sécurité MONDIAL GARDIENNAGE
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4">Nouvelle agence</h4>
                                    <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2005</p>
                                    <p class="mb-0">
                                        Ouverture d’une agence à Casablanca
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 right-2">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4">Nouveau service</h4>
                                    <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2001</p>
                                    <p class="mb-0">
                                        Début de l’activité de gardiennage
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4">Création</h4>
                                    <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2000</p>
                                    <p class="mb-0">
                                        Création de la société Mondial Service Démarrage de l’activité de nettoyage et d’hygiène
                                    </p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </section>
            </div>
        </div>
    </section>  
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Nous Contactez</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
            <form id="contactForm" >
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input-->
                            <input class="form-control" id="name" type="text" placeholder="Votre  Nom"
                                data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Phone number input-->
                            <input class="form-control" id="phone" type="tel" placeholder="Votre Téléphone *"
                                data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is
                                required.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input-->
                            <input class="form-control" id="email" type="email" placeholder="Votre Email *"
                                data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.
                            </div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Message input-->
                            <textarea class="form-control" id="message" placeholder="Votre Message *" data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is
                                required.</div>
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a
                            href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Error sending message!</div>
                </div>
                <!-- Submit Button-->
                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled"
                        id="submitButton" type="submit">Send Message</button></div>
            </form>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
   

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src={{ asset(env('PUBLIC_URL').'js/script.js') }}></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    
</body>

</html>