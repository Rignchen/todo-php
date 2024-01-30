<form action="index.php" method="get">
    <label>
        <strong>Search </strong>
        <input name="search" type="text" value="<?= $_GET["search"] ?? "" ?>">
    </label>
</form>