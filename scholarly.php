<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AuCo - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a class="nav-bar-item" href="sign-up.php"> Sign Up </a>
        <div class="title"> AutographCollector </div>
        <a class="nav-bar-item" href="scholarly.php"> About </a>
    </header>

    <main class="main-wrapper">
        <section class="main-template">
            <div class="my-body">
                <h1 style="color:#27a29e;font-family: 'Open Sans' ;font-weight: bold;text-align:center;">Scholarly</h1>
                <div style="color:white">
                    <ol>
                        <li>
                            <a href="#introduction">
                                Introduction
                            </a>
                            <ol role="directory">
                                <li>
                                    <a href="#Purpose">
                                        <span>1.1</span>
                                        Purpose
                                    </a>
                                </li>
                                <li>
                                    <a href="#audience">
                                        <span>1.2</span>
                                        Intended Audience and Reading Suggestions
                                    </a>
                                </li>
                                <li>
                                    <a href="#scope">
                                        <span>1.3</span>
                                        Product Scope
                                    </a>
                                </li>
                                <li>
                                    <a href="#references">
                                        <span>1.4</span>
                                        References
                                    </a>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <a href="#description">
                                Overall Description
                            </a>
                            <ol role="directory">
                                <li>
                                    <a href="#functions">
                                        <span>2.1</span>
                                        Product Functions
                                    </a>
                                </li>
                                <li>
                                    <a href="#classes">
                                        <span>2.2</span>
                                        User Classes and Characteristics
                                    </a>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </div>
                <article style="color:white">
                    <h2>What is AutographCollector?</h2>
                    <p>AutographCollector is a Web application that allows authenticated users to manage autographs of personalities. </p>
            
                    <section id="introduction">
                        <h2><span>1. </span>
                        Introduction
                        </h2>
                        
                    </section>
                    <section id="Purpose">
                        <h3><span>1.1. </span>
                            Purpose
                        </h3>
                        <p>
                            AutographCollector is a Web application that offers the logged in users the possibility to look for autographs of personalities that they are interested in, buy them, or upload and manage their own collection. 
                        </p>
                    </section>
                    <section id="audience">
                        <h3> <span>1.2. </span>
                            Intended Audience and Reading Suggestions
                        </h3>
                        <p>
                            This project is a prototype for an autograph collecting management system and is useful for any user who is interested in creating a large collection of autographs. 
                        </p>
                    </section>
                    <section id="scope">
                        <h3><span>1.3</span>
                            Product Scope
                        </h3>
                        <p>
                            The scope of the web application is to ease the management of collections of autograph enthusiasts, and the possibility to extend them by purchase or exchange.
                        </p>
                    </section>
                    <section id="references">
                        <h3><span>1.4</span>
                            References
                        </h3>
                        <ul>
                            <li>
                                <a href='https://profs.info.uaic.ro/~busaco/teach/courses/web/web-film.html'> https://profs.info.uaic.ro/~busaco/teach/courses/web/web-film.html</a>
                            </li>
                        </ul>
                    </section>
                    <section id="description">
                        <h2><span>2. </span>
                            Overall Description
                            </h2>
                    </section>
                    <section id="functions">
                        <h3><span>2.1</span>
                            Product Functions
                        </h3>
                        <p>
                            The major functions of AutographCollector database system are shown below:
                        </p>
                        <ul role="functions-list">
                            <li>
                                <p>Any users can register or login into their accounts on the 'login' page.</p>
                            </li>
                            <li>
                                <p>Logged in users can search for autographs of their idols on the 'home' page.</p>
                            </li>
                            <li>
                                <p>Logged in users can buy any autograph that is uploaded on the web site by pressing the 'buy' button on the autographs page.</p>
                            </li>
                            <li>
                                <p>Logged in users can upload and manage their own collections of signed memorabilia by the 'my collection' page. </p>
                            </li>
                        </ul>
                        
                    </section>
                    <section id="classes">
                        <h3><span>2.2</span>
                            User Classes and Characteristics
                        </h3>
                        <p> All users of the web site should be able to register, to login and start their own collection of autographs by uploading them and giving all the information about them, then expanding the collection by searching through all the autographs by their idols or consultating the leaderboard and the statistics to get only valuable ones, by buying or exchanging.
                        </p>
                    </section>
                </article>
            </div>
        </section>
    </main>

    <footer>
        <div class="payments">
            <p>Payment Options:</p>
            <div class="payment-types">
                <a href="https://www.mastercard.com"><i class="fa fa-cc-mastercard fa-2x"></i></a>
                <a href="https://www.visa.com"><i class="fa fa-cc-visa fa-2x"></i></a>
                <a href="https://www.paypal.com"><i class="fa fa-cc-paypal fa-2x"></i></a>
            </div>
        </div>
        <div class="authors"> Bejenariu Razvan-Andrei & Gruia Carmen</div>

        <div class="social-media">
            <a href="https://www.facebook.com"> <i class="fa fa-facebook fa-2x"></i></a>
            <a href="https://www.instagram.com"> <i class="fa fa-instagram fa-2x"></i></a>
            <a href="https://www.twitter.com"> <i class="fa fa-twitter fa-2x"></i></a>
            <a href="https://www.linkedin.com"> <i class="fa fa-linkedin fa-2x"></i></a>
        </div>
    </footer>
</body>

</html>