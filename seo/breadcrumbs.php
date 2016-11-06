<?php if(isset($breadcrumbs)) { ?>
    <ul class="breadcrumb" id="pageBreadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
        <?php
        $count = count($breadcrumbs);
        for($i = 0; $i < $count; $i++)
        {
            $breadcrumb = $breadcrumbs[$i];
            if(($i+1) < $count)
            {
                $breadcrumb['text'] = str_replace('<i class="fa fa-home"></i>','Главаня',$breadcrumb['text']);
                ?>
                <li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="title"><?php echo $breadcrumb['text']; ?></span></a></li>
                <?php
            }
            else
            {
                ?>
                <li><?php echo $breadcrumb['text']; ?></li>
                <?php
            }
        }
        ?>
    </ul>
<?php } ?>