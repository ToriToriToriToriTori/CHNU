<?php

$HOURS = ['h00_03', 'h03_06', 'h06_09', 'h09_12', 'h12_15', 'h15_18', 'h18_21', 'h21_24'];

$pickeddate = date('Y-m-d');

if(!empty($_POST['pickeddate'])) {
    $pickeddate = $_POST['pickeddate'];
}


$week_day = date('l', strtotime($pickeddate));

require_once('./db/conect.php');
$conn = mysqli_connect("localhost", $DBLogin, $DBPassword, $DBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$sql = "SELECT * FROM timetable WHERE date = '$pickeddate'";
$result = mysqli_query($conn, $sql);

$groups = ['1', '2','3','4','5'];

if($result){
    $groups = array();
    while($row = mysqli_fetch_assoc($result)){
        $groups[$row['group']] = array(
            'h00_03' => $row['h00_03'],
            'h03_06' => $row['h03_06'],
            'h06_09' => $row['h06_09'],
            'h09_12' => $row['h09_12'],
            'h12_15' => $row['h12_15'],
            'h15_18' => $row['h15_18'],
            'h18_21' => $row['h18_21'],
            'h21_24' => $row['h21_24']
        );
    }}
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $groups = $_POST['groups'];
    foreach($groups as $group => $hours){
        foreach($hours as $hour => $value){
            $sql = "UPDATE timetable SET $hour = '$value' WHERE date = '$pickeddate' AND group = '$group'";
            mysqli_query($conn, $sql);
        }
    }
}

?>

<script>
function submitForm() {
  document.getElementById("datatable").submit();
}
</script>

<div class="graphiceditpage">
    <form action="" id='datatable' method='POST'>
        <input type="date" id='pickeddate' name="pickeddate" value="<?php echo $pickeddate ?>" onchange="submitForm()"/>
        <table>
            <tr class="table-heading-row">
                <td colspan="9"><?php echo $week_day .'<br/>' . $pickeddate; ?></td>
            </tr>
            <tr class="table-hours-row">
                <td class="free-row"></td>
                <?php
                      foreach ($HOURS as $hour) {
                          $hour = str_replace('h', '', $hour);
                          $hour = str_replace('_', '-', $hour);
                          echo "<td>$hour</td>";
                      }
                ?>
            </tr>
            <?php foreach ($groups as $group => $hours) { ?>
                <tr class="table-hours-row">
                    <td class="free-row"><?php echo $group; ?></td>
                    <?php foreach ($HOURS as $hour) { ?>
                        <td class="table-select">
                            <select id='<?php echo $group."_".$hour; ?>' name='groups[<?php echo $group; ?>][<?php echo $hour; ?>]' onchange="updateSelectClass(this)">
                                <option value="g" class="table-g" <?php echo ($hours[$hour] == 'g') ? 'selected' : ''; ?> >g</option>
                                <option value="y" class="table-y" <?php echo ($hours[$hour] == 'y') ? 'selected' : ''; ?> >y</option>
                                <option value="r" class="table-r" <?php echo ($hours[$hour] == 'r') ? 'selected' : ''; ?> >r</option>
                            </select>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
        <input type="submit" value="Підтвердити" class="submit">
    </form>
</div>