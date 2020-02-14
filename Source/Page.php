<?php
class Page{
    function __construct($Options){
        $this->Template = new Template();
        $this->Options = [
            'Title' => '',
            'Nav' => ['', '', '']
        ];

        if(isset($Options['Title'])){ $this->Options = $Options['Title'];}
        if(isset($Options['Nav'])){
            if(is_array($Options['Nav'])){
                if(isset($Options['Nav'][0])){$this->Options['Nav'][0] = $Options['Nav'][0];}
                if(isset($Options['Nav'][1])){$this->Options['Nav'][1] = $Options['Nav'][1];}
                if(isset($Options['Nav'][2])){$this->Options['Nav'][2] = $Options['Nav'][2];}
            }
        }

        $this->HTML = '';
    }

    function AddContent($HTML){
        $this->HTML .= $HTML;
    }

    function Send(){
        echo $this->Template->Header($this->Options);
        echo $this->HTML;
        echo $this->Template->Footer($this->Options);
    }
}
class Template extends Page{
    function __construct(){
        //
    }

    function Header($Page){
        global $Fadebit;

        $HTML = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>' . $Fadebit->App()['Portal'] . $Fadebit->App()['PortalSuffix'] . '</title>
        <link href="https://static.datawove.com/dashforge/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="https://static.datawove.com/dashforge/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="https://static.datawove.com/dashforge/lib/jqvmap/jqvmap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://static.datawove.com/dashforge/assets/css/dashforge.css">
        <link rel="stylesheet" href="https://static.datawove.com/dashforge/assets/css/dashforge.dashboard.css">
        </head>
        <body class="page-profile">
        <header class="navbar navbar-header navbar-header-fixed">
        <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
        <div class="navbar-brand">
        <a href="#portals" data-toggle="modal" class="df-logo">' . $Fadebit->App()['Portal'] . '<span>' . $Fadebit->App()['PortalSuffix'] . '</span></a>
        </div>
        <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
        <a href="#portals" data-toggle="modal" class="df-logo">' . $Fadebit->App()['Portal'] . '<span>' . $Fadebit->App()['PortalSuffix'] . '</span></a>
        <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div>
        <ul class="nav navbar-menu">
        <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>';
        
        foreach($Fadebit->App()['Navigation'] as $Navigation){
            $Nav = $Navigation[0];
            $Text = $Navigation[1];
            $Icon = $Navigation[2];
            $Url = $Navigation[3];

            if(is_array($Url)){
                //
            }else{
                $HTML .= '<li class="nav-item ' . ($Page['Nav'][0] == $Nav ? 'active' : '') . '"><a href="'.$Url.'" class="nav-link"><i data-feather="'.$Icon.'"></i> '.$Text.'</a></li>';
            }
        }

        $HTML .= '</ul>
        </div>
        <div class="navbar-right">
        <div class="dropdown dropdown-profile">
        <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
        <div class="avatar avatar-sm"><img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($Fadebit->GetUser()['Email']))) . '" class="rounded-circle" alt=""></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right tx-13">
        <h6 class="tx-semibold mg-b-5">' . $Fadebit->GetUser()['Name']['First'] . ' ' . $Fadebit->GetUser()['Name']['Last'] . '</h6>
        <a href="/logout" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
        </div>
        </div>
        </div>
        </header>
        <div class="content content-fixed">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">';

        return $HTML;
    }

    function Footer(){
        global $Fadebit;
        $HTML = '</div>
        </div>
        <div class="modal fade" id="portals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
        <div class="modal-body pd-t-10 pd-l-10 pd-r-10 pd-b-0">
        <div class="row row-xs">';

        foreach($Fadebit->Portals() as $Portal){
            $HTML .= '<div class="col-sm-6 mg-b-10">
            <a href="https://' . $Portal['Domain'] . '/" class="btn btn-block btn-primary">' . $Portal['Name'] . '</a>
            </div>';
        }

        $HTML .= '</div>
        </div>
        </div>
        </div>
        </div>
        <script src="https://static.datawove.com/dashforge/lib/jquery/jquery.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/feather-icons/feather.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/jquery.flot/jquery.flot.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/jquery.flot/jquery.flot.stack.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/jquery.flot/jquery.flot.resize.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/chart.js/Chart.bundle.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/jqvmap/jquery.vmap.min.js"></script>
        <script src="https://static.datawove.com/dashforge/lib/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="https://static.datawove.com/dashforge/assets/js/dashforge.js"></script>
        </body>
        </html>';

        return $HTML;
    }
}