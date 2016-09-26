<div id="left">
    <?php if (count($vars) > 0) { ?>
        <table>
            <?php foreach ($vars as $comentariu) { ?>
                <tr>
                    <td><?php echo $comentariu['comments'] ?></td>
                    <td><?php echo $comentariu['created_at'] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    <form name="addcomment" action="" method="post">
        <textarea name="comments"></textarea><br/>
        <input type="submit" name="addcomment" value="Adauga Comentariu" />
    </form>
</div>