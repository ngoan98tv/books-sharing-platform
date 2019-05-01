<?php
function show_paging($name, $curr, $total, $trailing){
?>
<div class="paging">
        <a <?php if ($curr != 0) { ?> 
            href="?<?php echo $name; ?>=0<?php echo $trailing; ?>"
            <?php } else { echo "class='disabled'";} ?>
        ><<</a>
        <a <?php if ($curr != 0) { ?>
            href="?<?php echo $name; ?>=<?php echo $curr-1 >= 0 ? $curr-1 : 0; ?><?php echo $trailing; ?>"
            <?php } else { echo "class='disabled'";} ?>
            ><</a>
        <?php
            for ($i=0; $i < $total; $i++)
                echo "<a ".($curr != $i 
                    ? "href='?$name=$i".$trailing
                    : "class='disabled'").
                    "'>".($i + 1)."</a> ";
        ?>
        <a <?php if ($curr != $i-1) { ?>
            href="?<?php echo $name; ?>=<?php echo $curr+1 < $i ? $curr+1 : $i-1; ?><?php echo $trailing; ?>"
            <?php } else { echo "class='disabled'";} ?>
            >></a>
        <a <?php if ($curr != $i-1) { ?>
            href="?<?php echo $name; ?>=<?php echo $i-1; ?><?php echo $trailing; ?>"
        <?php } else { echo "class='disabled'";} ?>
        >>></a>
    </div>
<?php
}
?>