<?php
$this->title = "Discover";
$this->params['groups'] = $groups;
?>

<?= $this->render('../layouts/nav',['search' => true]); ?>

<section class="section site-discover" style="margin-top: 100px;">

    <div class="text-center titleX">
        <p class="blue">DISCOVER</p>
        <h2 class="font-light">Fundraisers</h2>
    </div>

    <div class="container">
        <div class="row" id="groups">
            <?php
            if(!empty($groups)) {
                foreach ($groups as $group) {
                    ?>
                    <div class="col-lg-4 my-3 group">
                        <a class="card-link" href="../group/profile?id=<?= $group->GROUP_ID ?>&&num=<?php
                        foreach($group->GROUP_ADMIN_MSISDN as $admin)
                        {
                            echo $admin;
                            break;
                        }
                        ?>">
                            <div class="card">

                                <input type="hidden" name="groupID" class="groupID" id="discoveryPageGroupID" value="<?= $group->GROUP_ID ?>">
                                <?php
                                foreach($group->GROUP_ADMIN_MSISDN as $admin)
                                {?>
                                    <input type="hidden" name="adminNo" class="adminNo" id = "discoveryPageAdminNumber" value="<?= $admin ?>">
                                    <?php
                                    break;
                                }
                                ?>
                                <input type="hidden" name="groupAmount" class="groupAmount" id="groupTargetAmount" value="<?= $group->AMOUNT ?>">

                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"
                                     style="width: 100%; height: 235px; display: none;">

                                    <div class="carousel-inner" id="mainSlider">
                                    </div>

                                </div>

                                <div align="center" style="background: #f5f5f5; width: 100%; height: 235px"
                                     id="defaultImage">

                                    <input id="profile-image-upload" class="hidden" type="file" style="display:none"
                                           accept="image/*"/>
                                    <img class="card-img-top" src="../images/PlaceHolder.png"
                                         style="height:100px; width: 100px; margin-top: 20%">

                                </div>

                                <div class="card-body" style="height: 110px;">
                                    <h5 class="card-title font-semibold group-title">
                                        <?= substr($group->GROUP_NAME, 0, 40) ?>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <?php
                                        if (strlen($group->GROUP_DESCRIPTION) > 70) {
                                            echo substr($group->GROUP_DESCRIPTION, 0, 70) . '...';
                                        } else {
                                            echo $group->GROUP_DESCRIPTION;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="card-body py-0">
                                    <div class="progress my-1" style="height: 7px;">
                                        <div class="progress-bar" id="group-progress-bar" role="progressbar"
                                             style="transition: 5s;" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                    <p style="font-size:small;">
                                        <span class="font-semibold wallet-balance" id="group-wallet-balance">
                                            <!-- Populated with ajax -->
                                            KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                                        </span>
                                        <span class="text-muted font-thin"> of KES <?= $group->AMOUNT ?> Goal</span>
                                    </p>
                                </div>
                                <div class="card-footer" style="display: block">
                                    <p class="card-text inline-item">
                                        <small class="text-muted">
                                            <?php
                                            $earlier = new \DateTime();
                                            $later = new \DateTime($group->GROUP_DATE_CREATED);
                                            $diff = $later->diff($earlier)->format("%a");
                                            echo $diff;
                                            ?>
                                            days ago
                                        </small>
                                    </p>
                                    <i class="fa fa-arrow-right inline-item float-right p-2"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="jumbotron jumbotron-fluid text-center mx-auto" style="height: 200px;">
                    <div class="py-5">
                        <h2 class="lead" style="color: #dc3545">Sorry you have no available groups!</h2>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</section>

<?= $this->render('../layouts/footer') ?>



<?php $this->beginBlock('scripts'); ?>
    <script>

        //render hidden list

        //var groups = <?//= json_encode($this->params['groups']) ?>//;
        //$.each(groups, function(key, value){
        //    $('#search-results').append('' +
        //        '<a href="../group/profile?id='+value.GROUP_ID +'" style="text-decoration: none;">' +
        //        '<li class="list-group-item link-class" style="display:none;">' +
        //        ' <h5 class="font-semibold">'+value.GROUP_NAME+'</h5>' +
        //        ' <span class="text-muted font-light">'+value.GROUP_DESCRIPTION+'</span></li></a>'
        //    );
        //});

        //Live search
        function Search(){

            // Declare variables
            var input, filter, ul, li, a, i;
            input = $('#search-input').val();
            filter = input.toUpperCase();
            ul = document.getElementById("groups");
            li = ul.getElementsByClassName('group');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByClassName('group-title')[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }

    </script>
<?php $this->endBlock(); ?>