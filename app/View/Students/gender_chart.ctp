<h1>Students</h1>
<table>
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($genders as $gender): ?>
    <tr>
        <td><?php echo $gender['Student']['id']; ?></td>
        <td>
            <?php echo $gender['Student']['first_name']; ?>
        </td>
        <td><?php echo $gender['Student']['last_name'] ;?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>