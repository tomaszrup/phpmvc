<?php
include __DIR__ . '/template/template_header.php';
?>

<div class="container" style="padding-top: 50px">
    <form action="<?= path("books") ?>" method="POST">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" placeholder="e.g Alex Smith">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" placeholder="e.g. alexsmith@gmail.com">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Add book</button>
            </div>
        </div>
    </form>
</div>

<?php
include __DIR__ . '/template/template_footer.php';
?>