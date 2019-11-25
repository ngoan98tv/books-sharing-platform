<div class="paging">
    <a <?= ($curr != 0)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => 0]))."'"
        : "class='disabled'" 
    ?>><<</a>
    <a <?= ($curr != 0)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $curr-1 >= 0 ? $curr-1 : 0]))."'"
        : "class='disabled'"
    ?>><</a>
    <?php
        for ($i=0; $i < $total; $i++)
            echo "<a ".($curr != $i 
                ? "href='?".http_build_query(array_merge($trailing, ["$name" => $i]))."'"
                : "class='disabled'").
                "'>".($i + 1)."</a> ";
    ?>
    
    <a <?= ($curr != $i-1)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $curr+1 < $i ? $curr+1 : $i-1]))."'"
        : "class='disabled'"
    ?>>></a>
    <a <?= ($curr != $i-1)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $i-1]))."'"
        : "class='disabled'" 
    ?>>>></a>
</div>