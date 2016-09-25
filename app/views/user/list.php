<table id="data" cellpadding="2" cellspacing="0" border="1">
    <tr>
        <td>username</td>
        <td>Action</td>
    </tr>

    <?php foreach ($vars['users'] as $user): ?>
        <tr>
            <td><?php echo $user['users']; ?></td>
            <td>
                <a href="update?id=<?php echo $user['id']; ?>">Edit</a> | 
                <a id="user_delete<?php echo $user['users']; ?>"  href="javascript:void(0)">Delete</a>
            </td>
        </tr>
        <script>
            $(document).ready(function () {
                $("#user_delete<?php echo $user['users']; ?>").click(function () {
                    $.ajax({
                        method: 'POST',
                        url: "delete",
                        data: {'user_id': <?php echo $user['id']; ?>},
                        dataType: "html",
                        success: function ($date) {
                            $('#data').html($date);
                        }
                    });
                });
            });
        </script> 
    <?php endforeach; ?>	
</table>
