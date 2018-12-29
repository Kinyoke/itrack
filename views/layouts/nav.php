<nav class="navbar navbar-light border-bottom navbar-expand-lg" style="position: fixed; width: 100%; top: 0; left: 0;">
    <div class="container">
        <a class="navbar-brand" href="../site/index">
            <img src="../images/Mula_Logo.png" width="78" height="24" alt="">
        </a>
        <button class="navbar-toggler ml-auto custom-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php
            if(isset($search)) {
                ?>
                
                <div>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <i class="fa fa-search" style="color: gray; font-size: 16px;"></i>        
                        </li>
                    </ul>
                </div>

               
                <?php
            }
            ?>




            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../site/discover">Discover</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../group/create">Start a Fundraiser </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>

            <ul class="navbar-nav justify-content-md-end">
                <?php
                if(isset($_SESSION['Admin'])){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../group/index">My Fundraisers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../site/log_out">Logout</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../site/login">Login</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item xs-hidden">
                    <a class="btn btn-sm btn-primary blue-btn my-1" href="../group/create">Get Started</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="search-container">
    <div class="container" id="search-input-pane">
        <input type="text" name="search-input" id="search-input" class="form form-control" onkeyup="Search()" placeholder=" Search...">
    </div>
</div>

<div class="container">
   <div style="z-index: 2;">
        <ul class="list-group" id="search-results">
<!--                Search Results are added here-->
        </ul>
   </div>
</div>

<div style="display:none;">
    <li id="search-item">
        <h3 class="group-name"></h3>
        <p class="group-description"></p>
    </li>
</div>



