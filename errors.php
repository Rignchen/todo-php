<?php if (len($errors) > 0): ?>
    <div style="color:red;background-color:#ffcccc;border-radius:5px;padding:5px;">
        <?php foreach ($errors as $error): ?>
            <p>
                <?= $error ?>
            </p>
        <?php endforeach; ?>
    </div>
    <?php $_SESSION["errors"] = [];
endif; ?>
