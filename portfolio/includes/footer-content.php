<div class="py-5 bg-light border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="footer-heading"><?= webSetting('title') ?? 'Meta Desc' ?></h4>
                <hr>
                <p>
                    <?= webSetting('small_description')?? 'Small Desc'?>
                </p>
            </div>
            <div class="col-md-4">
                <h4 class="footer-heading">Follow Us at</h4>
                <hr>
                <ul>
                    <?php 
                        $socialMedia = getAll('social_medias');
                        if($socialMedia){
                            if(mysqli_num_rows($socialMedia) > 0){
                                foreach($socialMedia as $socialItem){
                                    ?>
                                        <li><a href="<?= $socialItem['url']?>"><?= $socialItem['name']?></a></li>
                                    <?php
                                }
                            }else{
                                echo "<li> No Social Media added </li>";
                            }
                        }else{
                            echo "<li> Somting went wrong </li>";
                        }
                    ?>
                </ul>
        </div>
        <div class="col-md-4">
                <h4 class="footer-heading">Contact Information</h4>
                <hr>
                <p>
                    Address: <?= webSetting('address') ?? 'Address' ?>
                </p>
                <p>
                    Email: <?= webSetting('email') ?? 'Email' ?>
                </p>
                <p>
                    Phone: <?= webSetting('phone') ?? 'Phone' ?>
                </p>
        </div>
    </div>
</div>