
<?php 
session_start();
include_once '/env.loader.php';
include_once '/conn.php';

include 'home_header.inc';

include 'home_navbar.inc'; ?>
           


    <div class="index_container">
        <div class="index_content">
        
            <main>  <!--middle dragon image-->
                <div class="dragon_image_container">
                    <img src="images/Home_page_game_image.jpeg" alt="graphic_of_dragon_background" class="dragon_image"> <!-- images taken from Adobe Stock - https://stock.adobe.com/au/search/images?filters%5Bcontent_type%3Aphoto%5D=1&filters%5Bcontent_type%3Aillustration%5D=1&filters%5Bcontent_type%3Azip_vector%5D=1&filters%5Bfetch_excluded_assets%5D=1&filters%5Binclude_stock_enterprise%5D=1&filters%5Bcontent_type%3Aimage%5D=1&order=relevance&price%5B%24%5D=1&limit=100&search_page=1&search_type=usertyped&acp=&aco=fantasy+video+game+&k=fantasy+video+game+&get_facets=0&asset_id=615946312-->
                </div> 

                <div class="image_text">
                    <!--Company slogan-->
                    <h1>Timeless Classics, Forged in Darkness...</h1>

                <!--text overlay above dragon image-->
                
                    <p id="company_description">With humble beginnings in Melborune, Australia, SDAJ is a game development company that 
                    creates new and innovative games with nostalgia at heart.From PC to mobile platforms, our games showcase our infinite imagination   
                    that continues to delight players around the world.
                    </p>
                </div> 
            </main>
                    
            <?php include 'home_footer.inc';?>

        </div>  
    </div>    
</body>
</html>

<!--add session start to the top of each page (regardless of whether you need to access user input or not)-->
<!--- think about putting .inc files into a folder and change the path for an php file line-->