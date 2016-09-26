<div id="left">
    <table>
        <?php foreach ($vars as $comentariu) { ?>
            <tr>
                <td><?php echo $comentariu['comments'] ?></td>
                <td><?php echo $comentariu['created_at'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <form name="addcomment" action="" method="post">
        <textarea name="comments"></textarea><br/>
        <input type="submit" name="addcomment" value="Adauga Comentariu" />
    </form>
</div>