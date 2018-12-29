<?php
$this->title = 'Cash Out Requests';
?>

<div class="admin-default-requests">

    <div class="row py-3">
        <div class="mx-auto col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted py-1"> Click on a row to view the cash out request.</p>
                    <table class="table table-hover" id="requests">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Cash Out Type</th>
                            <th scope="col">Withdrawal Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cashOuts as $cashOut): ?>
                            <tr class="click-row" data-href="/admin/default/view?id=<?= $cashOut->cashOutID?>">
                                <td><?= ucwords(strtolower($cashOut->cashOutType)); ?></td>
                                <td> KES <?= number_format($cashOut->withdrawAmount) ?></td>
                                <td>
                                    <?php
                                    if($cashOut->cashOutStatus === 1){
                                        echo '<span class="badge badge-success">APPROVED</span>';
                                    }elseif ($cashOut->cashOutStatus === -1){
                                        echo '<span class="badge badge-primary">COMPLETED</span>';
                                    }else{
                                        echo '<span class="badge badge-warning">PENDING</span>';
                                    }?>
                                </td>
                                <td><?= date('h:ia  jS M Y ', strtotime($cashOut->dateCreated)) ?>
                                    <div class="float-right">
                                        <button class="btn btn-sm"><i class="fa fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('scripts'); ?>
    <script>

        $(document).ready(function() {

            /* Initialize Table */
            $('#requests').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            } );

            /* Make rows clickable */
            $(function(){
                $('#requests').on('click', 'tbody tr', function(e){
                    window.location = $(this).data("href");
                    return false;
                });
            });

        } );
    </script>
<?php $this->endBlock();