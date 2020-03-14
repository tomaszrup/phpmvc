<?php
include __DIR__ . '/template/template_header.php';
?>

    <div class="container" style="margin-top: 50px">
        <h1 class="title"> Book listing </h1>
        <?php if (isset($books) && count($books)): ?>
            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Available</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $key => $book): ?>
                    <tr>
                        <td><?= $book->name ?></td>
                        <td><?= $book->author ?></td>
                        <td><?= $book->available ? "Yes" : "No" ?></td>
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