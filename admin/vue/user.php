<div class="container mt-5">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/group.php">Groups</a></li>
        <li class="breadcrumb-item active"><?php echo $group->name ?></li>
    </ol>
    </nav>
  <table class="table">
        <thead>
            <tr>
            <th scope="col">Nom et prénom</th>
            <th scope="col">Email</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <?php foreach( $user as $u ) {?>
            <tr>
            <td><?php echo $u->name ?></td>
            <td><?php echo $u->email ?></td>
            <td><?php require 'partials/modalUser.php';?></td>
            <td><form method="POST">
                <input type="hidden"  name="id" value="<?php echo $u->id ?>">
                <input type="hidden"  name="action"  value="deleteUser">
                <button type="submit" class="btn btn-secondary">Delete</button>
            </form></td>
            </tr>

        <?php } ?>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        Create
    </button>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST">
            <input type="hidden"  name="action"  value="createUser">
            <div class="modal-body">
                <div class="form-group">
                    <label>Firstname and lastname</label>
                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Enter email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>