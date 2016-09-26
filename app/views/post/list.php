<ul style="margin-left: -20px;">
    <?php foreach ($vars as $comentariu) { ?>
        <li><?php echo $comentariu['comments'] ?> din <?php echo date('d-m-Y', strtotime($comentariu['created_at'])) ?></li>        
    <?php } ?>
</ul>
