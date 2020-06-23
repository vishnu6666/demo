
<?php
if (isset($loadData) && !empty($loadData)) {
    foreach ($loadData as $data) {
        ?>
            <tr class="message_box" data-id="<?php echo $data['id']; ?>">
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['text']; ?></td>
            </tr>
        <?php 
    }
}
?>


