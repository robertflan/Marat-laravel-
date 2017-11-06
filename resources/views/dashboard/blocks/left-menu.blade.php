<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="index.html" class="logo">
            <img src="{{ asset('assets/common/img/logo.png') }}" alt="Clean UI Admin Template" />
            <img class="logo-inverse" src="{{ asset('assets/common/img/logo-inverse.png') }}" alt="Clean UI Admin Template" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">
            <li {!! (Request::is('dashboard') ? 'class="left-menu-list-active"' : '') !!}>
                <a class="left-menu-link" href="{{ url('/dashboard') }}">
                    <i class="left-menu-link-icon icmn-books"><!-- --></i>
                    Dashboard
                </a>
            </li>
            <li class="left-menu-list-separator"><!-- --></li>
            <li class="left-menu-list-submenu {!! (Request::is('*applicants*') ? 'left-menu-list-opened' : '') !!}">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
                    Bewerbermanagement
                </a>
                <ul class="left-menu-list list-unstyled" {!! (Request::is('*applicants*') ? 'style="display: block;"' : '') !!}>
                    <li {!! (Request::is('*applicants*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/applicants') }}">
                            Bewerberdatenbank
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Wiedervorlage
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Gespräch
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Termin
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Bewerber Statistik
                        </a>
                    </li>
                    <!-- <li>
                        <a class="left-menu-link" href="pages-pricing-tables.html">
                            Import/Export
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
                    Personalmanagement
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="#">
                            Personal Datenbank
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Personalberichte
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Personal Statistics
                        </a>
                    </li>
                </ul>
            </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
                    SUB-Management
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="#">
                            Sub-Datenbank
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Sub Mitarbeiter
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="#">
                            Sub-Statistik
                        </a>
                    </li>
                </ul>
            </li>
            <li class="left-menu-list-separator"></li>
            <li class="left-menu-list-submenu {!! (Request::is('*jobs*') || Request::is('*categories*') || Request::is('*locations*') || Request::is('*users*') || Request::is('*companies*') || Request::is('*document_type*') || Request::is('*document_group*') ? 'left-menu-list-opened' : '') !!}">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
                    Settings
                </a>
                <ul class="left-menu-list list-unstyled" {!! (Request::is('*jobs*') || Request::is('*categories*') || Request::is('*locations*') || Request::is('*users*') || Request::is('*companies*') || Request::is('*document_types*') || Request::is('*document_groups*') ? 'style="display: block;"' : '') !!}>
                    <li {!! (Request::is('*jobs*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/jobs') }}">
                            Stellen
                        </a>
                    </li>
                    <li {!! (Request::is('*categories*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/categories') }}">
                            Beruf
                        </a>
                    </li>
                    <li  {!! (Request::is('*locations*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/locations') }}">
                            Locations
                        </a>
                    </li>
                    <li  {!! (Request::is('*companies*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/companies') }}">
                            Firma
                        </a>
                    </li>
                    <li  {!! (Request::is('*users*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/users') }}">
                            Users
                        </a>
                    </li>
                    <li  {!! (Request::is('*document_groups*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/document_groups') }}">
                            Document Groups
                        </a>
                    </li>
                    <li  {!! (Request::is('*document_types*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/document_types') }}">
                            Document Types
                        </a>
                    </li>
                    <li  {!! (Request::is('*questionnaire*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/questionnaire') }}">
                            Questionnaire
                        </a>
                    </li>
                    <li  {!! (Request::is('*document_templates*') ? 'class="left-menu-list-active"' : '') !!}>
                        <a class="left-menu-link" href="{{ url('/dashboard/document_templates') }}">
                            Document Template
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class="left-menu-list-separator"></li>
            <li class="menu-top-hidden no-colorful-menu">
                <div class="left-menu-item">
                    Last Week Sales
                </div>
            </li>
            <li class="menu-top-hidden no-colorful-menu">
                <div class="example-left-menu-chart chartist-animated chartist-theme-dark"></div>
                <script>
                    $(function () {
                        // CSS STYLING & ANIMATIONS
                        var cssAnimationData = {
                                labels: ["S", "M", "T", "W", "T", "F", "S"],
                                series: [
                                    [11, 14, 24, 16, 20, 16, 24]
                                ]
                            },
                            cssAnimationOptions = {
                                fullWidth: !0,
                                chartPadding: {
                                    right: 2,
                                    left: 30
                                },
                                axisY: {
                                    position: 'end'
                                }
                            },
                            cssAnimationResponsiveOptions = [
                                [{
                                    axisX: {
                                        labelInterpolationFnc: function(value, index) {
                                            return index % 2 !== 0 ? !1 : value
                                        }
                                    }
                                }]
                            ];

                        new Chartist.Line(".example-left-menu-chart", cssAnimationData, cssAnimationOptions, cssAnimationResponsiveOptions);

                    });
                </script>
            </li>
            <li class="menu-top-hidden no-colorful-menu">
                <div class="left-menu-item">
                    Solar System
                </div>
            </li>
            <li class="menu-top-hidden">
                <div class="left-menu-item">
                    <span class="donut donut-success"></span> Jupiter
                </div>
            </li>
            <li class="menu-top-hidden">
                <div class="left-menu-item">
                    <span class="donut donut-primary"></span> Earth
                </div>
            </li>
            <li class="menu-top-hidden">
                <div class="left-menu-item">
                    <span class="donut donut-danger"></span> Mercury
                </div>
            </li> --}}
        </ul>
    </div>
</nav>
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var location = window.location;
    var pathArray = window.location.pathname.split('/');
    console.log(pathArray[2]);
    $(".left-menu").find("a[href*='" + pathArray[2] + "']").each(function() {
        console.log($(this));
        // $(this).addClass("active");
        $(this).closest('li.left-menu-list-submenu').addClass("left-menu-list-opened");
        // $(this).closest('.sub-menu').find('.sub-menu-header').addClass("active");
        $(this).closest('ul.left-menu-list').show();
        //add additional code here if needed
    });

});
</script>
@endpush