<?php
$this->title = 'Cash Out Request';
?>

<div class="admin-default-view">
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                Cash Out Request <strong class="px-1">#<?= $cashOut->cashOutID ?></strong>
                <h5 class="float-right"> <strong>Status :</strong>
                    <?php
                    if($cashOut->cashOutStatus === 1){
                        echo '<span class="badge badge-success">APPROVED</span>';
                    }elseif ($cashOut->cashOutStatus === -1){
                        echo '<span class="badge badge-primary">COMPLETED</span>';
                    }else{
                        echo '<span class="badge badge-warning">PENDING</span>';
                    }?>
                </h5>

            </div>
            <div class="card-body">
                <div class="row mb-4">

                    <div class="col-sm-6">
                        <div><strong>Group Name: </strong><?= $details->GROUP_NAME ?></div>
                        <div><strong>Group Administrator: </strong>
                        <?php
                        foreach ($details->GROUP_MEMBERS as $member)
                        {
                            if ($member->GROUP_MEMBER_TYPE === 'ADMIN'){

                                if($member->GROUP_MEMBER_NAME != "")
                                {
                                    echo $member->GROUP_MEMBER_NAME.' - '.$member->GROUP_MEMBER_MSISDN;
                                }else{
                                    echo $member->GROUP_MEMBER_MSISDN;
                                }
                            }
                        }
                        ?>
                        </div>
                        <div><strong>Wallet Balance: </strong>KES <?= number_format($balance) ?></div>
                        <div><strong>Remaining Balance: </strong>KES <?= number_format($cashOut->withdrawAmount - $balance) ?></div>
                    </div>

                    <div class="col-sm-6">
                        <div>
                            <strong>Signatories</strong>
                        </div>
                        <?php
                        foreach ($details->GROUP_MEMBERS as $member)
                        {?>
                            <div>
                            <?php
                            if ($member->GROUP_MEMBER_TYPE === 'APPROVER'){
                                if($member->GROUP_MEMBER_NAME != "")
                                {
                                    echo $member->GROUP_MEMBER_NAME.' - '.$member->GROUP_MEMBER_MSISDN;
                                    echo '<span class="badge badge-pill badge-warning ml-2">PENDING</span>';
                                }else{
                                    echo $member->GROUP_MEMBER_MSISDN;
                                    echo '<span class="badge badge-pill badge-warning ml-2">PENDING</span>';
                                }
                            }?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">Cash Out Type ID</th>
                            <th>Cash Out Type</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="center"><?= $cashOut->cashOutTypeID?></td>
                            <td class="left strong"><?= $cashOut->cashOutType?></td>
                            <td class="left">Extended License</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">

                    <div class="col-lg-6 col-sm-6 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Account Name</strong>
                                </td>
                                <td class="right"><?= $cashOut->destinationAccountName ?></td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Account Number</strong>
                                </td>
                                <td class="right"><?= $cashOut->destinationAccountNumber ?></td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Requested on:</strong>
                                </td>
                                <td class="right"><?= date('h:ia  jS M Y ', strtotime($cashOut->dateCreated)) ?></td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Amount to withdraw</strong>
                                </td>
                                <td class="right">
                                    <strong>KES <?= number_format($cashOut->withdrawAmount) ?></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="row">
                    <div class="ml-auto p-4">
                        <?php
                        if($cashOut->cashOutStatus === 1){
                            echo '<a href="#" class="btn btn-success" role="button">Manually Complete</a>';
                        }elseif ($cashOut->cashOutStatus === -1){
                            echo '<a href="#" class="btn btn-success disabled" role="button" aria-disabled="true">Request Completed</a>';
                        }else{
                            echo '<a href="#" class="btn btn-success disabled" role="button" aria-disabled="true">Awaiting Approval</a>';
                        }?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('scripts'); ?>

<?php $this->endBlock();