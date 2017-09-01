<?php
/**
 * Template Name: Jobbannonser
 */


?>

<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<section style="background: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php

                $key = null;
                if (isset($_GET['jaid'])) {
                    $key = $_GET['jaid'];
                }

                if ($key) { delete_transient($key); }

                if ( false === ( $item = get_transient( $key ) ) ) {
//                    echo 'not cached';
                    $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
                    $map_url = "https://cv-maxkompetens.app.intelliplan.eu/JobAdGlobePages/Feed.aspx?pid=AA31EA47-FDA6-42F3-BD9F-E42186E5A960&version=2&JobAdId=".$key;
                    $xml = file_get_contents($map_url, false, $context);
                    $xml = simplexml_load_string($xml);
                    $arr = (array) $xml -> xpath('channel');
                    $item = $arr[0]->item;

                    $item = json_encode($item);
                    $item = json_decode($item);

                    if(!empty($item->title)) {
                        // And we unconditionally update the cache with an expiration of 1 day
                        set_transient($key, $item, (12 * HOUR_IN_SECONDS) );
                        echo '<script>jQuery(".page-title").text()</script>';
                        echo "<script>jQuery(\".page-title\").text('" . $item->title  . "')</script>";
                    }else{
                        echo "<script>jQuery(\".page-title\").text('Annonsen finns inte')</script>";
                    }

                } else {
//                    echo 'cached';
                    echo '<script>jQuery(".page-title").text()</script>';
                    echo "<script>jQuery(\".page-title\").text('" . $item->title  . "')</script>";
                }

//                echo $item->intelliplan->attributes();

                $regex = '/(\S+@\S+\.\S+)(?!\s))+/';
                $replace = '<a href="mailto:$1">$1</a>';

                ?>
<!--                <p>--><?//= nl2br(preg_replace('/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', '<a href="\1">\1</a>', preg_replace($regex, $replace, $item->description))); ?><!--</p>-->
                <p class="description">
                    <?php
                    if(!empty($item->title)) {
                        echo $item->description;
                    }else{
                        echo 'Vi kunde inte hitta någon annons med det här id-numret.';
                    }

                    ?></p>
            </div>
            <?php if(!empty($item->title)): ?>
            <div class="col-12 col-sm-3 align-self-end">
                <div class="fancy-button btn-green">
                    <div class="left-frills frills"></div>
                    <a href="https://app.wapcard.se/jobs/<?= $key; ?>" class="button" id="apply_for_job" target="_blank">Ansök med wap </a>
                    <div class="right-frills frills"></div>
                </div>
            </div>
            <div class="col-12">
                <?php
                $wapJobs = ['5088', '5805', '5728', '6213', '6182'];
                if (!in_array($key, $wapJobs)) : ?>
                    <p>Inom kort kommer du enbart kunna söka jobb från Maxkompetens via, det nya och snabbare, <strong>wap - work and passion</strong>, vi rekommenderar därför att du redan nu använder dig av wap för att ansöka denna tjänsten! Har du inte redan ett konto hos wap skapar du ett nytt snabbt och enkelt.
                    Vill du kan du fortfarande ansöka om tjänsten via gamla systemet här nedanför.
                    </p>
                <?php else : ?>
                    <span>Maxkompetens använder sig av, det nya och snabbare, <strong>wap - work and passion</strong> för ansökningar till utannonserade tjänster. Har du inte redan ett konto hos wap skapar du ett nytt snabbt och enkelt!</span>
                <?php endif; ?>
                <p><a href="https://wapcard.se" target="_blank">Läs mer om wap</a></p>
            </div>
                <?php if (!in_array($key, $wapJobs)) : ?>
                    <div class="col-12">
                        <iframe src="http://cv-maxkompetens.app.intelliplan.eu/JobAd/Apply?jaid=<?= $key; ?>" width="100%" height="775" scrolling="no" frameborder="0"></iframe>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>


    </div>
</section>

<?php get_template_part('templates/section', 'stats'); ?>

<?php get_template_part('templates/section', 'companies'); ?>
