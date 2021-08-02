<?php 
    $pageTitle = 'Home | Acme Inc.';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; 
?>

            <section class="hero-container">            
                <h1>Welcome to Acme!</h1>
                <div class="hero-image">
                    <div class="transparent"></div>
                    <div class="call-to-action">
                        <ul>
                            <li><h2>Acme Rocket</h2></li>
                            <li>Quick lighting fuse</li>
                            <li>NHTSA approved seat belts</li>
                            <li>Mobile launch stand included</li>
                            <li><a href="/acme/cart/" title="Add to cart button"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
                        </ul>
                    </div>
                </div>
            </section>

            <div class="feature-review">
                <article>
                    <h3>Featured Recipes</h3>
                    <div class="image-content">
                        <div class="image-card">
                            <div class="image">                                
                                <img src="/acme/images/recipes/bbqsand.jpg" alt="Roadrunner BBQ"/>
                            </div>                    
                            <div class="caption"><a href="#" title="Pulled Roadrunner BBQ">Pulled Roadrunner BBQ</a></div>
                        </div>
                        <div class="image-card">
                            <div class="image"> 
                                <img src="/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie"/>
                            </div>                    
                            <div class="caption"><a href="#" title="Roadrunner Pot Pie">Roadrunner Pot Pie</a></div>
                        </div>
                        <div class="image-card">
                            <div class="image">
                                <img src="/acme/images/recipes/soup.jpg" alt="Roadrunner Soup"/>
                            </div>                    
                            <div class="caption"><a href="#" title="Roadrunner Soup">Roadrunner Soup</a></div>
                        </div>
                        <div class="image-card">
                            <div class="image">
                                <img src="/acme/images/recipes/taco.jpg" alt="Roadrunner Tacos"/>
                            </div>                    
                            <div class="caption"><a href="#" title="Roadrunner Tacos">Roadrunner Tacos</a></div>
                        </div>
                    </div>
                </article>

                <aside>
                    <h3>Acme Rocket Reviews</h3>
                    <ul>
                        <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                        <li>"That thing was fast!" (4/5)</li>
                        <li>"Talk about fast delivery." (5/5)</li>
                        <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                        <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                    </ul>
                </aside>
            </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>