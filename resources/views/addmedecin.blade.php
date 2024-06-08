<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MediCare</title>
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="shortcut icon" href="/images/logooooo.ico ">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="css/demo_1/style.css">
    {{-- <link rel="shortcut icon" href="https://demo.bootstrapdash.com/xollo/template/assets/images/favicon.ico" /> --}}
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                {{-- <a class="navbar-brand brand-logo">MediCare</a> --}}
                <img src="/images/logog3.png" alt="" width="90px">
                {{-- <a class="navbar-brand brand-logo-mini" style="color: black">MediCare</a> --}}
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-equal"></span>
                </button>
                <form class="form-inline d-none d-lg-block search my-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher...">
                        <div class="input-group-append">
                            <i class="mdi mdi-magnify"></i>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-item-highlight d-flex">
                        <a class="nav-link" href="{{route('getAdminLogout')}}">
                            <i class="mdi mdi-logout"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-equal"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close mdi mdi-close"></i>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles primary"></div>
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles pink"></div>
                        <div class="tiles info"></div>
                        <div class="tiles light"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Team review meeting at 3.00 PM </label>
                                    </div>
                                    <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Prepare for presentation </label>
                                    </div>
                                    <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Resolve all the low priority tickets due today </label>
                                    </div>
                                    <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked> Schedule meeting for next week </label>
                                    </div>
                                    <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked> Project review </label>
                                    </div>
                                    <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="events py-4 border-bottom px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="mdi mdi-circle-outline text-primary me-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                            <p class="text-gray mb-0">build a js based app</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="mdi mdi-circle-outline text-primary me-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 ps-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pe-3 font-weight-normal">See All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav nav-height">
                    <li class="nav-item nav-profile">
                        <span class="nav-link" href="#">
                            <p>  Bienvenue {{ Auth::user()->name }} </p>

                            <p> {{ Auth::user()->email }} </p>

                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('acceuil')}}">
                            <span class="mdi mdi-home"></span>
                            <span class="menu-title">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <span class="mdi mdi-view-dashboard"></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>


                    @if(Auth::check() && Auth::user()->admin)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="sidebar-layouts">
                            <span class="mdi mdi-account-group"></span>
                            <span class="menu-title">Gérer Utilisateurs</span>
                            <i class="mdi mdi-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="users">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('getUsers')}}">Liste des utilisateurs</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('getAddUser')}}">Ajouter un utilisateur</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#med" aria-expanded="false" aria-controls="sidebar-layouts">
                            <span class="mdi mdi-account-group"></span>
                            <span class="menu-title">Gérer Médecins</span>
                            <i class="mdi mdi-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="med">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('getMed')}}">Liste des médecins</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('getaddmedecin')}}">Ajouter un médecin</a></li>

                            </ul>
                        </div>
                    </li>




                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#services" aria-expanded="false" aria-controls="sidebar-layouts">
                            <span class="mdi mdi-office-building"></span>
                            <span class="menu-title">Gérer Services</span>
                            <i class="mdi mdi-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="services">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('listeServices')}}">Liste des services</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('getService')}}">Ajouter Service</a></li>
                            </ul>
                        </div>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#dci" aria-expanded="false" aria-controls="sidebar-layouts">
                            <span class="mdi mdi-pill-multiple"></span>
                            <span class="menu-title">Gérer Médicaments</span>
                            <i class="mdi mdi-chevron-right menu-arrow"></i>
                        </a>
                        <div class="collapse" id="dci">
                            <ul class="nav flex-column sub-menu">

                                <li class="nav-item"> <a class="nav-link" href="{{route('listeDCI')}}">Liste DCI</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('getDCI')}}">Ajouter DCI</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <span class="mdi mdi-account"></span>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getAdminLogout')}}">
                            <i class="mdi mdi-logout"></i>
                            <span class="menu-title">Déconnexion</span>
                        </a>
                    </li>
                    @endif







                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header mb-3">
                        <h3 class="page-title"> Ajouter un Médecin </h3>
                    </div>
                    <div class="row grid-margin">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <form action="{{route('postAddMed')}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Nom</label>
                                            </div>

                                            <div class="col-lg-10">
                                                <input class="form-control" maxlength="255" name="name" id="defaultconfig" type="text" placeholder="">
                                                @if ($errors->has('name'))
                                                <small class="text text-danger">
                                                    {{ $errors->first('name') }}
                                                </small>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Email</label>
                                            </div>
                                            <div class="col-lg-10">
                                                <input class="form-control" maxlength="255" name="email" id="defaultconfig-2" type="email" placeholder="">
                                                @if ($errors->has('email'))
                                                <small class="text text-danger">
                                                    {{ $errors->first('email') }}
                                                </small>
                                                @endif
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="col-form-label"> Numéro de téléphone</label>
                                            </div>

                                            <div class="col-lg-10">
                                                <input class="form-control" maxlength="255" name="telephone" id="defaultconfig" type="number" placeholder="">
                                                @if ($errors->has('telephone'))
                                                <small class="text text-danger">
                                                    {{ $errors->first('telephone') }}
                                                </small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-2">
                                                <label class="col-form-label">Spécialité</label>
                                            </div>
                                            <div class="col-lg-10">
                                                <input class="form-control" maxlength="255" name="speciality" id="defaultconfig-2" type="text" placeholder="">
                                                @if ($errors->has('speciality'))
                                                <small class="text text-danger">
                                                    {{ $errors->first('speciality') }}
                                                </small>
                                                @endif
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-2">
                                                    <label class="col-form-label">Service</label>
                                                </div>
                                                <div class="col-lg-10 mt-2">
                                                    <select class="form-control" name="service">
                                                        <option selected disabled>Séléctionner un service</option>
                                                        @foreach($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->nom_service	 }}</option>
                                                         @endforeach
                                                    </select>
                                                    @if ($errors->has('service'))
                                                    <small class="text text-danger">
                                                        {{ $errors->first('service') }}
                                                    </small>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">


                                        </div>
                                        <div class="mt-2 text-center">
                                            <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                {{-- <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="d-block text-center text-sm-start d-sm-inline-block">Copyright © 2023 <a href="#">BootstrapDash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer> --}}
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/form-validation.js"></script>
    <script src="js/bt-maxLength.js"></script>
    <!-- End custom js for this page -->
</body>

<!-- Mirrored from demo.bootstrapdash.com/xollo/template/demo_1/pages/forms/validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 May 2024 22:42:58 GMT -->

</html>
