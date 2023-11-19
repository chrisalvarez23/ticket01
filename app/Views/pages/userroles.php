<?= $this->extend('template/admin_template'); ?>

<?= $this->section('contentarea'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Role Management</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>GROUP</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalID">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Role Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <form class="needs-validation" novalidate>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" id="id" name="id">
                                        <label for="group">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter group" required disabled>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter a valid username.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <!-- <input type="text" class="form-control" id="group" name="group" placeholder="Enter group" required> -->
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="group" name="group">
                                                <option value='admin'>admin</option>
                                                <option value='user'>user</option>
                                            </select>
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter a valid username.
                                        </div>
                                    </div>
                            
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pagescripts'); ?>
<script>
    $(function() {


        $('form').submit(function(e) {
            e.preventDefault();

            let formdata = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            let jsondata = JSON.stringify(formdata);
            // {
            //     "first_name":"valuse"...
            // }

            if (this.checkValidity()) {
                if (!formdata.id) {
                    $.ajax({
                        url: "<?= base_url('userroles'); ?>",
                        type: "POST",
                        data: jsondata,
                        success: function(response) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                body: response.message,
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalID").modal('hide');
                            clearform();
                            table.ajax.reload();
                        },
                        error: function(response) {
                            let parsedresponse = JSON.parse(response.responseText);

                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Error',
                                body: JSON.stringify(parsedresponse.error),
                                autohide: true,
                                delay: 3000
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?= base_url('userroles'); ?>/" + formdata.id,
                        type: "PUT",
                        data: jsondata,
                        success: function(response) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                body: response.message,
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalID").modal('hide');
                            clearform();
                            table.ajax.reload();
                        },
                        error: function(response) {
                            let parsedresponse = JSON.parse(response.responseText);

                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Error',
                                body: JSON.stringify(parsedresponse.error),
                                autohide: true,
                                delay: 3000
                            });
                        }
                    });
                }
            }
        });
    });

    let table = $("#dataTable").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('userroles/list'); ?>",
            type: "POST"
        },
        columns: [{
                data: "id"
            },
            {
                data: "username",

            },
            {
                data: "group",

            },
            {
                data: "",
                defaultContent: `<td>
                <button class="btn btn-warning btn-sm btn-edit" id="editRow">Edit</button>
                </td>`

            }
        ],
        paging: true,
        lengthChange: true,
        lengthMenu: [5, 10, 25, 50],
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false
    });

  

    $(document).on('click', "#editRow", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        $.ajax({
            url: "<?= base_url('userroles'); ?>/" + id,
            type: "GET",
            success: function(response) {
                $("#modalID").modal('show');
                $("#id").val(response.auth_id);
                $("#username").val(response.username);
                $("#group").val(response.group);
            },
            error: function(response) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: "Record Not Found",
                    autohide: true,
                    delay: 3000
                });
            }
        });
    });

    $(document).ready(function() {
        'use strict';

        let form = $('.needs-validation');

        form.each(function() {
            $(this).on('submit', function(e) {
                if (this.checkValidity() === false) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    });
    function clearform(){
        $("#id").val("");
        $("#username").val("");
        $("#group").val("");
    }
</script>
<?= $this->endSection(); ?>