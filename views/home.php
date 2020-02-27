<?php
include __DIR__ . '/template/template_header.php';
?>

<div class="container" style="margin-top: 50px">
<h1 class="title"> Book listing </h1>
<?php if(count($books)): ?>
<table class="table is-fullwidth">
    <thead>
        <tr>
        <?php foreach($books[0] as $key => $value): ?>
            <th> <?= strtoupper($key); ?> </th>
        <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach($books as $key => $book): ?>
        <tr>
        <?php foreach($book as $value): ?>
            <td> <?= $value; ?> </td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>There are no books in the library at the moment.</p>
<?php endif; ?>
</div>

<?php
include __DIR__ . '/template/template_footer.php';
?>