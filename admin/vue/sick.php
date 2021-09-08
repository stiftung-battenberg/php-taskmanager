<section class="container mt-5">
    <div class="align-middle">
        <h2>Are you sure of changing that user out.</h2>
        <form method="POST">
            <input type="hidden" name="tasked_id" value="<?php echo $_GET['tasked_id'] ?>">
            <input class="btn btn-primary" type="submit" value="Confirm" />
        </form>
        <a href="/admin/callendar.php"><button class="btn btn-danger mt-2">Cancel</button></a>
    </div>
</section>