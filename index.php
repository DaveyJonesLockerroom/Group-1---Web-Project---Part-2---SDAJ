
<?php 
session_start();                /* to store information to be used across multiple pages */
include_once 'env_loader.php';
include_once 'conn.php';

include 'inc_files/home_header.inc';

include 'inc_files/home_navbar.inc';
           
include 'inc_files/error_alert.inc'; ?>

    <div class="index_container">
        
        
        <main>  <!--middle dragon image licensed from Adobe Stock images: 
                https://as2.ftcdn.net/v2/jpg/07/23/38/53/1000_F_723385360_rEzKTrIuBEx9qu5PBJhgFH6wqlb3j4Pl.jpg-->
    <div class="dragon_image_container">
        <img src="images/dragon_RPG.jpeg" alt="graphic_of_dragon_background"  class="dragon_image">            
    </div>
        <div class="image_text">
                <h1>Timeless Classics, Forged in Darkness...</h1>
                    <p id="company_description">
                        With humble beginnings in Melbourne, Australia, SDAJ is a game development company that 
                        creates new and innovative games with nostalgia at heart. From PC to mobile platforms, our games showcase our infinite imagination   
                        that continues to delight players around the world.
                    </p>
        </div> 
                
</main>
                    
            <?php include 'inc_files/home_footer.inc';?>

         
    </div>    
</body>
</html>

<!--add session start to the top of each page (regardless of whether you need to access user input or not)-->
<!--- think about putting .inc files into a folder and change the path for an php file line-->