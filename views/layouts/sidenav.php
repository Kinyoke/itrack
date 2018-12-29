<nav class="navbar navbar-light border-bottom"  style="position: fixed; width: 100%; top: 0; left: 0;">
    <div class="container">
        <a class="navbar-brand" href="../site/index">
            <img src="../images/Mula_Logo.png" width="78" height="24" alt="">
        </a>
        <div class="ml-auto" >
            <a href="../group/view" style="text-decoration: none;" class="font-bold mr-2">Dashboard</a>
            <button id="openSideNav" class="navbar-toggler custom-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>

<div class="hidenav"></div>


<div class="navbar-side">
    <div class="navbar-side-paner">
        <div class="navbar-side-item" id="navbar-side-ovely"></div>
        <div class="navbar-side-item" id="navbar-side-content">

            <div class="navbar-side-header">
                <div class="buttons col-lg-4">
                    <a id="dashboard" href="../group/view">Dashboard</a>
                </div>
                <div class="buttons col-lg-4">
                    <div id="closeNavSide">
                        <div class="cross"></div>
                        <div class="cross"></div>
                    </div>
                </div>
            </div>

            <div class="navbar-side-content">
                <ul>
                    <li class="menu-link"><a href="../site/index">Home</a></li>
                    <?php
                        if(isset($_SESSION['groupID']))
                        {
                            echo '<li><a href="../group/edit">Edit Fundraiser</a></li>';
                        }
                    ?>
                    <li class="menu-link"><a href="../group/index">My Fundraisers</a></li>
                    <li class="menu-link"><a href="../group/create">Start a Fundraiser</a></li>
                    <li class="menu-link"><a href="#">Help and Support</a></li>
                    <li class="menu-link"><a href="../site/log_out">Logout</a></li>
                </ul>
            </div>

            <div class="navbar-side-footer"></div>

        </div>
    </div>
</div>