<div class="paging">
    <a class="btn btn-light btn-sm" <?= ($curr != 0)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => 0]))."'"
        : "class='disabled'" 
    ?>><<</a>
    <a class="btn btn-light btn-sm" <?= ($curr != 0)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $curr-1 >= 0 ? $curr-1 : 0]))."'"
        : "class='disabled'"
    ?>><</a>
    <?php
        for ($i=0; $i < $total; $i++)
            echo "<a ".($curr != $i 
                ? "class='btn btn-light btn-sm' href='?".http_build_query(array_merge($trailing, ["$name" => $i]))."'"
                : "class='btn btn-primary btn-sm text-white'").
                "'>".($i + 1)."</a> ";
    ?>
    
    <a class="btn btn-light btn-sm" <?= ($curr != $i-1)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $curr+1 < $i ? $curr+1 : $i-1]))."'"
        : "class='disabled'"
    ?>>></a>
    <a class="btn btn-light btn-sm" <?= ($curr != $i-1)
        ? "href='?".http_build_query(array_merge($trailing, ["$name" => $i-1]))."'"
        : "class='disabled'" 
    ?>>>></a>
</div>