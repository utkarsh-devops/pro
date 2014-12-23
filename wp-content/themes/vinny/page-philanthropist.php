<?php

$site = site_url();
if($site != "http://www.vinny40.org" && $site != "http://vinny40.weboniselab.com" && $site != "http://10.0.0.85" && $site != "http://vinny40org.weboapps.com" && $site != "http://vinny40.org" ){
    wp_redirect("/404/");}

get_header();
?>

<div class="philanthropistWrapper">

<header>
    <div class="navbarWrapper">
        <div class="navbar navbar-inverse" id="philanthropistNavbar">
            <div class="container">
                <h1 class="logo" title="VINNY40"><a href="#home" id="logo"></a></h1>
                <div class="navSearchWrapper">
                <ul class="nav mainNav">
                    <li>
                        <a href="#aboutVinny" title="About Vinny40">ABOUT VINNY40</a>
                    </li>
                    <li>
                        <a href="#meetThePatients" title="Meet the Patients">MEET THE PATIENTS</a>
                    </li>
                    <li>
                        <a href="#photoGallery" title="Photo Gallery">PHOTO GALLERY</a>
                    </li>
                    <li>
                        <a href="#supporters" title="Supporters">SUPPORTERS</a>
                    </li>
                    <li>
                        <a href="https://checkinforgood.com/campaigns/vinny-lecavalier-foundation/" class="donateLink" title="Donate" target="_blank">DONATE</a>
                    </li>
                    <li class="contactBtn">
                        <a href="#contactUs" class="msgIcon" title="Contact Us"></a>
                    </li>
                </ul>
            </div>
                <div id="playerInnerMenu" class="innerMenu vsMenu clearfix">
                    <a href="#" class="toggleBtn responsiveButton"></a>
                    <div class="innerMenuWrapper">
                        <div class="innerMenuInner">
                        <ul class="nav">
                            <li>
                                <a href="#aboutVinny" title="About Vinny40">ABOUT VINNY40</a>
                            </li>
                            <li>
                                <a href="#meetThePatients" title="Meet the Patients">MEET THE PATIENTS</a>
                            </li>
                            <li>
                                <a href="#photoGallery" title="Photo Gallery">PHOTO GALLERY</a>
                            </li>
                            <li>
                                <a href="#supporters" title="Supporters">SUPPORTERS</a>
                            </li>
                            <li>
                                <a href="https://checkinforgood.com/campaigns/vinny-lecavalier-foundation/" class="donateLink" title="Donate" target="_blank">DONATE</a>
                            </li>
                            <li>
                                <a href="#contactUs" title="Contact Us">CONTACT US</a>
                            </li>
                            <li>
                                <a href="http://www.vinny40.com/player/" class="vinnyOrgLink" title="Visit vinny40.com">visit vinny40.com</a>
                            </li>
                        </ul>
                        <div class="whiteLinks">Tel: +32(0) 499 11 22 33 | Email: <a href="mailto:info@vinny40.org" title="info@vinny40.org">info@vinny40.org</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<?php
$table_name = $wpdb->prefix . "sliders";
$sql_query = "SELECT * FROM $table_name where type='foundation_slider';";
$slider_images = $wpdb->get_results($sql_query);
$url = site_url()."/wp-content";
?>

<section id="home">
    <div class="sliderOuter" id="foundationSlider">
        <div class="slider foundationImageSlider cycle-slideshow"
             data-cycle-fx="scrollHorz"
             data-cycle-timeout="6000"
             data-cycle-slides=".slide"
             data-cycle-swipe="true"
             data-cycle-prev="#prevSlider"
             data-cycle-next="#nextSlider"
             data-cycle-loader="wait">
            <?php
            if(!empty($slider_images)){
                foreach($slider_images as $slider_image){?>

                    <div class="slide">
                        <img src="<?php echo $url."/uploads/".$slider_image->image; ?>" alt="Vinny40">
                        <div class="container">
                            <div class="sliderCaptions">
                                <h2><?php echo $slider_image->name;?></h2>
                                <p><?php echo $slider_image->content;?></p>
                            </div>
                        </div>
                    </div>

                    <?php }
            }else{ ?>
                <div class="slide">
                    <img src="<?php echo get_template_url(); ?>/img/philanthropist-slider1.jpg" alt="Vinny40">
                    <div class="sliderCaptions">
                        <h2>TOGETHER WE CAN</h2>
                        <p>Our tomorrow depends on Children's well being today.<br />
                            Help Vinny fight pediatric cancer!
                        </p>
                    </div>
                </div>
                <?php  } ?>
        </div>
        <?php if(count($slider_images) > 1){?>
        <a href=# id="prevSlider" class="prevSlider"></a>
        <a href=# id="nextSlider" class="prevSlider nextSlider"></a>
        <?php }?>
    </div>

    <div class="whiteTexture">
        <div class="container">
            <?php dynamic_sidebar("home");?>
            <a href="#" class="nextBtn aboutFirstBtn" title="The Cancer Center"></a>
        </div>
    </div>

</section>
<?php $about_us = get_page_by_title("About Us");?>
<section id="aboutVinny">
    <a href="#" class="contentToggleBtn">About Vinny40 <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <?php
        echo wpautop($about_us->post_content);
        ?>
        <div class="pageBottomDivider">
            <a href="#" class="nextBtn" title="Meet the Patients"></a>
        </div>
    </div>
    <div class="whiteTextureBottom"></div>
</div>
</section>
<?php
$args = array(
    'posts_per_page'    =>'-1',
    'post_type'        => 'meet_patients',
    'post_status'      => 'publish'
);
$patients = get_posts($args);

?>
<section id="meetThePatients">
    <a href="#" class="contentToggleBtn">Meet The Patients <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <div class="topGrayBg">
        </div>
        <?php foreach($patients as $patient){
        $first_name = get_post_meta( $patient->ID, "Patient First Name", true );
        $last_name = get_post_meta( $patient->ID, "Patient Last Name", true );
        $age = get_post_meta( $patient->ID, "Age", true );
        ?>

        <div class="patientsTab clearfix" id="patientsTab<?php echo $patient->ID;?>">
            <h2 class="bigHeading">MEET <?php echo $first_name;?></h2>
            <div class="patientTabs">
                <div class="imgShadow">
                    <?php echo has_post_thumbnail($patient->ID) ? get_the_post_thumbnail($patient->ID) :'<img src="'.get_template_url().'/img/thumbnail2.jpg" alt="Meet the patients">' ;?>
                </div>
                <div class="titleBlock">
                    <h4><?php echo $first_name." ".$last_name;?></h4>
                    <?php echo $age;?> years old
                </div>
                <?php echo wpautop($patient->post_content);?>
            </div>
        </div>
        <?php } ?>


        <div class="thumbnailUl">
            <?php if(count($patients) <= 4){?>
                <div class="defaultCycle-4">
            <?php foreach($patients as $patient){?>
                <a class="patientSlide" href="#patientsTab<?php echo $patient->ID;?>"><?php echo has_post_thumbnail($patient->ID) ? get_the_post_thumbnail($patient->ID) :'<img src="'.get_template_url().'/img/thumbnail2.jpg" alt="Meet the patients">' ;?>
                </a>

            <?php }?></div>
            <?php }?>
            <?php if(count($patients) > 4){?>
            <div id="cycle-4" class="cycle-slideshow"
                 data-cycle-fx=carousel
                 data-cycle-timeout=0
                 data-cycle-next="#patientNext"
                 data-cycle-prev="#patientPrev"
                 data-cycle-carousel-visible=4
                 data-cycle-slides=".patientSlide"
                 data-cycle-swipe="true">
                <?php foreach($patients as $patient){?>
                    <a class="patientSlide" href="#patientsTab<?php echo $patient->ID;?>"><?php echo has_post_thumbnail($patient->ID) ? get_the_post_thumbnail($patient->ID) :'<img src="'.get_template_url().'/img/thumbnail2.jpg" alt="Meet the patients">' ;?>
                    </a>
                <?php }?>
            </div>
            <a href=# class="patientPagination" id="patientPrev"></a>
            <a href=# class="patientPagination prev" id="patientNext"></a>
            <?php }?>
        </div>
        <div class="bottomGrayBg"></div>
        <a href="#" class="nextBtn" title="Photo Gallery"></a>
    </div>
    <div class="whiteTextureBottom"></div>
</div>
</section>

<section id="photoGallery" class="photoGalleryPage">
    <a href="#" class="contentToggleBtn">Photo Gallery <i></i></a>
    <div class="pageContentWrapper">
    <div class="subNavWrapper" id="foundationMediaSubNavWrapper">
        <ul class="nav nav-pills">
            <li class="active"><a href="#foundationMediaTab1" title="Photos">Photos</a></li>
            <li class=""><a href="#foundationMediaTab2" title="Videos">Videos</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="foundationMediaTab" id="foundationMediaTab1">

            <?php
            $table_name = $wpdb->prefix . "media_sliders";
            $sql_query = "SELECT * FROM $table_name where type='photo_gallery'  ORDER BY id desc;";
            $slider_images = $wpdb->get_results($sql_query);
            $url = site_url()."/wp-content";
            ?>

            <div class="photoGallery">
                <ul class="cycle-slideshow"
                    data-cycle-fx="scrollHorz"
                    data-cycle-timeout="0"
                    data-cycle-slides="li"
                    data-cycle-swipe="true"
                    data-cycle-pager="#mediaSlider">
                    <?php
                    foreach($slider_images as $slider_image){
                        ?>
                        <li class="clearfix">
                            <div>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption1;?>" href="<?php echo $url."/uploads/".$slider_image->image1; ?>"> <img src="<?php echo $url."/uploads/resize/".$slider_image->image1; ?>" class="height205" alt="Vinny40"></a>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption2;?>" href="<?php echo $url."/uploads/".$slider_image->image2; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image2;?>" class="height293" alt="Vinny40"></a>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption3;?>" href="<?php echo $url."/uploads/".$slider_image->image3; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image3 ?>" class="height120" alt="Vinny40"></a>
                            </div>
                            <div class="middleColumn">
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption4;?>" href="<?php echo $url."/uploads/".$slider_image->image4; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image4; ?>" class="height419" alt="Vinny40"></a>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption5;?>" href="<?php echo $url."/uploads/".$slider_image->image5; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image5; ?>" class="height208" alt="Vinny40"></a>
                            </div>
                            <div>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption6;?>" href="<?php echo $url."/uploads/".$slider_image->image6; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image6; ?>" class="height208" alt="Vinny40"></a>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption7;?>" href="<?php echo $url."/uploads/".$slider_image->image7; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image7; ?>" class="height202" alt="Vinny40"></a>
                                <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption8;?>" href="<?php echo $url."/uploads/".$slider_image->image8; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image8; ?>" class="height208" alt="Vinny40"></a>
                            </div>
                        </li>
                        <?php } ?>
                </ul>
                <?php if(count($slider_images) > 1){?>
                <div class="example-pager example-pager2 clearfix" id="mediaSlider"></div>
                <?php }?>

            </div>
        </div>
        <?php dynamic_sidebar("foundation_video");?>

        <a href="#" class="nextBtn" title="Our Supporters"></a>
    </div>
    </div>
</section>

<section id="supporters" class="supportersPage">
    <a href="#" class="contentToggleBtn">Supporters <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <h2 class="bigHeading">Our Supporters</h2>
        <h4 class="subHeading">Our achievements in the past and goals for the future could never be accomplished without the help of these outstanding individuals and organizations. The Vinny Lecavalier Foundation is honored that they have elected to stand with us and empower those in need in our community. Every year hundreds of children and families find hope for a better future thanks to these partnerships.</h4>
        <div class="logosContainer">
            <h3>FOUNDERS</h3>
            <div class="logosHolder">
                <?php $table_name =  $wpdb->prefix . "supporters";
                $sql_query = "SELECT * FROM $table_name where type='supporter'  ORDER BY position ASC LIMIT 5;";
                $founders = $wpdb->get_results($sql_query);
                foreach($founders as $key=>$founder){
                    if($key == 4){
                        echo "</div><div class='logosHolder'>";
                    }
                    echo "<a href='".$founder->link."' target='_blank'><img src='".$url."/uploads/".$founder->image."'alt='".$founder->name."'></a>";
                }
                ?>
            </div>
        </div>

        <div class="logosContainer fontSizeBig">
            <h3>PARTNERS</h3>
            Julia Helena Cosma, MD <i>&#9679;</i> Dex Imaging <i>&#9679;</i> Kane's Furniture <br> Vinny & Caroline Lecavalier <i>&#9679;</i> The Centers
        </div>

        <div class="logosContainer">
            <h3>Benefactors</h3>
            <div class="logosHolder">
                <?php
                $sql_query = "SELECT * FROM $table_name where type='partner'  ORDER BY position ASC LIMIT 3;";
                $partners = $wpdb->get_results($sql_query);
                foreach($partners as $partner){
                    echo "<a href='".$partner->link."' target='_blank'><img src='".$url."/uploads/".$partner->image."'alt='".$partner->name."'></a>";
                }
                ?>
            </div>
        </div>

        <?php dynamic_sidebar("patron");?>

        <div class="logosContainer sponsorsLogos">
            <h3>Corporate Sponsors</h3>
            <div class="logosHolder">
                <?php
                $sql_query = "SELECT * FROM $table_name where type='corporate_sponsor' ORDER BY position ASC LIMIT 11;";
                $corporate_sponsors = $wpdb->get_results($sql_query);
                foreach($corporate_sponsors as $key=>$corporate_sponsor){
                    if($key == 5){
                        echo "</div><div class='logosHolder'>";
                    }
                    echo "<a href='".$corporate_sponsor->link."' target='_blank'><img src='".$url."/uploads/".$corporate_sponsor->image."'alt='".$corporate_sponsor->name."'></a>";
                } ?>
            </div>
        </div>

        <a href="#" class="nextBtn goToContactUs" title="Contact us"></a>
    </div>
    <div class="whiteTextureBottom"></div>
</div>
</section>

<section id="contactUs" class="contactUsPage">
    <a href="#" class="contentToggleBtn">Contact Us <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <h2 class="bigHeading">CONTACT US</h2>
        <h4 class="subHeading">Reach us using the form below for inquiries regarding the foundation.</h4>
        <div class="row contactContainer">
            <div class="span4 visible-tablet visible-desktop">
                <p>Genevieve L. Bale <br />
                    Executive Director</p>
                <a href="mailto:glecavalierbale@vinny40.org" class="mailIcon">glecavalierbale@vinny40.org</a>
                <span class="phoneIcon">813-922-VLF4</span>
            </div>
            <div class="span8" id="vinnyContactForm">
                <div id="feedback"></div>
                <form action="javascript:void(0)" class="contactForm" id="contactForm" method="post">
                    <div class="controls controls-row">
                        <div><input class="span4 require inputName" type="text" placeholder="Name" name="name"><span></span></div>
                        <div><input class="span4 require email" type="text" placeholder="Email" name="email"><span></span></div>
                    </div>
                    <div class="controls controls-row">
                        <div><input class="span4" type="text" placeholder="Company" name="company"><span></span></div>
                        <div><input class="span4 phone" type="text" placeholder="Phone number" name="phNo" id="phoneNumber" maxlength="14"><span></span></div>
                    </div>
                    <div class="controls">
                        <textarea class="span8 require" rows="6" placeholder="Your message" name="message"></textarea><span></span>
                    </div>
                    <div class="centerBtn"><button type="submit" class="orangeBtn" id="submitContactForm">Submit</button></div>
                </form>
                <img src="<?php echo get_template_url();?>/img/ajax-loader.gif" alt="loader" class="loadingImage" />
            </div>
        </div>
        <div class="contactDevicesView hidden-desktop hidden-tablet">
            <p><strong>Genevieve L. Bale</strong> <br />
                Executive Director</p>
            <a href="mailto:glecavalierbale@vinny40.org" class="mailIcon">glecavalierbale@vinny40.org</a>
            <span class="phoneIcon">813-922-VLF4</span>
        </div>
    </div></div>

</section>
<div class="topBtnWrapper"><a href="#" class="topBtn" title="Back to Home"></a></div>
</div>

<!--<img src="--><?php //echo get_template_url(); ?><!--/img/foundation-left-vinny.png" class="faceToggle foundationLeftSideImg" usemap="#foundationLeftSideImgMap" alt="Philanthropist">-->
<!--<map name="foundationLeftSideImgMap" id="foundationLeftSideImgMap">-->
<!--    <area shape="poly" coords="-1,33,24,34,49,45,78,78,84,115,84,153,81,182,75,198,64,199,63,208,60,228,60,250,67,261,82,273,101,281,116,289,139,301,168,315,201,330,220,350,230,367,243,391,229,402,165,398,2,399,0,257,1,133,-13,49" alt="Philanthropist" />-->
<!--</map>-->
<div class="faceToggle foundationRelativeDiv" id="foundationFaceToggle">
    <div class="relativeDiv">
        <?php
        if(getenv('env')=="development"){
            $site_url = "http://vinny40.webonise.com/player/";}
        elseif(getenv('env')=="staging"){
            $site_url = "http://vinny40.weboapps.com/player/"; }
        else{
            $site_url = "http://vinny40.com/player/";
        }
        ?>
        <img src="<?php echo get_template_url(); ?>/img/foundation-right-vinny.png" class="foundationRightSideImg" usemap="#foundationRightSideImgMap" alt="Philanthropist">
        <img src="<?php echo get_template_url(); ?>/img/foundation-right-vinny-active.png" class="foundationRightSideImgActive" usemap="#foundationRightSideImgMap" alt="Philanthropist">
        <map name="foundationRightSideImgMap" id="foundationRightSideImgMap">
            <area shape="poly" coords="230,42,218,43,210,45,197,48,190,43,184,49,186,52,180,59,169,70,165,80,159,97,157,113,155,129,156,141,157,149,154,154,154,170,156,184,154,195,161,205,171,206,172,219,173,255,161,260,158,271,151,279,135,286,111,299,87,309,59,324,41,335,31,342,18,350,10,365,5,376,2,384,1,399,52,399,232,401,235,392,230,313,230,44,228,43" alt="Philanthropist" href="<?php echo $site_url;?>" />
        </map>
    </div>
</div>

<div class="ipadRightVinny clearfix">
    <a href="javascript:void(0)" class="vinnyOrgLinkToggle"></a>
    <a href="http://vinny40.com/player/" title="Visit vinny40.com" class="vinnyOrgLink"></a>
</div>

<?php
get_footer();
?>