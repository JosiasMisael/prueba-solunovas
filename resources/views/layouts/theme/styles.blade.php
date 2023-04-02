<script src=" {{ asset('assets/js/loader.js') }}"></script>
<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
<!-- END GLOBAL MANDATORY STYLES -->
<link href=" {{ asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
<link href=" {{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">

<link href=" {{ asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css">

<link href=" {{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css">
<link href=" {{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css">

<link href=" {{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

<link href=" {{ asset('assets/css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
<link href=" {{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">

<link href=" {{ asset('assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css">
<link href=" {{ asset('assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css">


<style>
    aside {
        display: none !important;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #3b3f5c;
        border-color: #3b3f5c;
    }

    @media (max-with: 480px) {
        .mtmobile {
            margin-bottom: 20px !important;
        }

        .mbmobile {
            margin-bottom: 10px !important;
        }

        .hideonsm {
            display: none !important;
        }

        .inblock {
            display: block;
        }
    }

    .sidebar-theme #compactSidebar {
        background: #191a3a !important;
    }

    .header-container .sidebarCollapse {
        color: #191a3a !important;
    }

    .navbar .navbar-item .nav-item form.form-inline input.search-form-control {
        font-size: 15px;
        background-color: #3b3f5c !important;
        padding-right: 40px;
        padding-top: 12px;
        border: none;
        color: #fff;
        box-shadow: none;
        border-radius: 30px;
    }

    .navbar .navbar-item .nav-item.search-animated svg {
    cursor: pointer;
    color: #fff;
    position: absolute;
    width: 20px;
    height: 20px;
    top: 10px;
    right: 10px;
}

.sidebar-wrapper #compact_submenuSidebar .submenu ul.submenu-list li a {
    padding: 6px 5px;
    display: block;
    color: #191a3a !important;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: .300s;
    border-radius: 5px;
    margin: 2px;
}
</style>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
{{-- <link href=" {{ asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" class="dashboard-sales" /> --}}
{{-- <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" class="dashboard-sales" /> --}}
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@livewireStyles
