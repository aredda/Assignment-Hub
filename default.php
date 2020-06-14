<div class="row">
    <div class="col-lg-12">
        <h4 class="text-orange">About</h4><br>
        <p class="text-justify">This project contains various exercices and revising materials,
        all of them were categorized into three main sections,
        a section that takes care of <span class='text-orange'>file handling</span>,
        including how to open, write and read them.<br><br>
        The second section is about implementing <span class='text-orange'>functions</span>
        in order to increase code's reusability, and decrease the rate of redundancy, many examples are mentioned
        such as string manipulation functions and more..<br><br>
        The last and final chapter gives a brief introduction about connecting to <span class='text-orange'>SQL Databases</span>,
        manipulate and use all of its components to our favor.<br><br>
        <span class='text-orange font-weight-bold'>This project covers a couple of divisions:</span>
        </p>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <?php
            
            include_once "navigation.php";
            
            foreach (get_nav_items($directory_name) as $item => $sub_items)
            {
                ?>
                <div class="col-lg-4 my-2">
                    <div class="card">
                        <img src="<?php echo "$directory_name$item/__icon.png"; ?>" class="card-img-top mx-auto my-4 pt-2 w-25">
                        <div class="card-body py-0 text-center">
                            <h6><?php echo $item . "<span>".count($sub_items)." Items</span>" ?></h6>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>