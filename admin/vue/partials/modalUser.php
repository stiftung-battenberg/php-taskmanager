<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?php echo $u->id ?>">
    Modifier
</button>

<!-- Modal -->
<div class="modal fade" id="updateModal-<?php echo $u->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <input type="hidden" id="id" name="id" value="<?php echo $u->id ?>">
            <input type="hidden"  name="action"  value="alterUser">
            <div class="form-group">
                <label>Firstname and lastname</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $u->name ?>" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $u->email ?>" placeholder="Enter email">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

