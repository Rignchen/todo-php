<?php
    if (count($errors) > 0):
        foreach ($errors as $error): ?>
            <p style="color:red;background-color:#ffcccc;border-radius:5px;padding:5px">
                <?= $error ?>
            </p>
        <?php
        endforeach;
    $_SESSION["errors"] = [];
    endif;
?>
