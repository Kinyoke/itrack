<?php
$this->title = 'Users';
?>

    <div class="admin-default-requests">

        <div class="row">
                <a href="/admin/default/create-user" class="btn btn-primary ml-auto m-3">Add New User</a>
        </div>
        <div class="row py-3">
            <div class="mx-auto col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="users">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= ucwords(strtolower($user->firstName)); ?></td>
                                    <td><?= ucwords(strtolower($user->lastName)); ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <?php
                                        if($user->active === '1'){
                                            echo '<span class="badge badge-success">ACTIVE</span>';
                                        }else {
                                            echo '<span class="badge badge-warning">INACTIVE</span>';
                                        }
                                        ?>
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
            $('#users').DataTable( {
            } );

        } );
    </script>
<?php $this->endBlock();