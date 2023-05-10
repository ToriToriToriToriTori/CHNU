<?php

$HOURS = ['h00_03', 'h03_06', 'h06_09', 'h09_12', 'h12_15', 'h15_18', 'h18_21', 'h21_24'];

$pickeddate = date('Y-m-d');

if(!empty($_GET['pickeddate'])) {
    $pickeddate = $_GET['pickeddate'];
}

$week_day = date('l', strtotime($pickeddate));

require_once('./db/conect.php');
$conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    $sql = "SELECT * FROM timetable WHERE date = '$pickeddate'";
    $groups = mysqli_query($conn, $sql);
}

if(!$groups){
    $groups = ['1', '2','3','4','5'];
}
?>

<script>
function submitForm() {
  document.getElementById("dateform").submit();
}
</script>

<div class="graphiceditpage">

    <form action="" id='datatable' method='POST'>
        <input type="date" id='pickeddate' name="pickeddate" value="<?php echo $pickeddate ?>" onchange=""/>

        <table>
            <tr class="table-heading-row">
                <td colspan="9"> <?php echo $week_day .'<br/>' . $pickeddate; ?> </td>
            </tr>
            <tr class="table-hours-row">
                <td class="free-row"></td>
                <?php
                      foreach ($HOURS as $hour) {
                          $hour = str_replace('h', '', $hour); // remove 'h'
                          $hour = str_replace('_', '-', $hour); // replace '_' with '-'
                          echo "<td>$hour</td>";
                      }
                    ?>
                </tr>
                
                <?php echo $groups; foreach ($groups as $group) { ?>
                    <tr class="table-hours-row">
                        <td class="free-row"><?php echo $group['group']?></td>
                        <?php
                            foreach ($HOURS as $hour) { ?>
                                <td class="table-select">
                                    <select id='' value='<?php echo $group[$hour]?>' onchange="updateSelectClass(this)" class="<?php echo 'table-' . $group[$hour]; ?>">
                                        <option value="green" class="table-g" <?php echo ($group[$hour] == 'g') ? 'selected' : ''; ?> >g</option>
                                        <option value="yelow" class="table-y" <?php echo ($group[$hour] == 'y') ? 'selected' : ''; ?> >y</option>
                                        <option value="red" class="table-r" <?php echo ($group[$hour] == 'r') ? 'selected' : ''; ?> >r</option>
                                    </select>
                                </td>
                                <?php } ?>
                                ?>
                            </tr>
                <?php } ?>

            </table>
            
            <script>
                function updateSelectClass(selectElement) {
                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                    var selectedClass = selectedOption.getAttribute('class');
                    selectElement.setAttribute('class', selectedClass);
                }
            </script>

            <input type="submit" value="Підтвердити" class="submit">
                
        </form>

</div>