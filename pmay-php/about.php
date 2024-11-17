<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMAY - About Us</title>
    <link rel="stylesheet" href="./css/style.css" />

    <style>
        /* Basic styling for the header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: hsl(51, 58%, 95%);
        }

        /* Subheader styles */
        .subheader {
            display: flex;
            justify-content: space-around;
            padding: 15px;
            background-color: #333;
            color: rgb(81, 43, 252);
        }

        .subheader ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
        }

        .subheader li {
            margin: 0 15px;
        }

        .subheader a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        /* Styling for logos */
        .logo {
            height: 80px;
            margin: 0 30px;
        }

        /* About Section Styles */
        #aboutSection {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1140px;
            margin: auto;
        }

        .sectionTitle {
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Box styling for PMAY Urban and Rural */
        .pmay-box {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            display: flex;
            align-items: flex-start;
        }

        .pmay-box img {
            height: 80px;
            margin-right: 15px;
        }

        p {
            text-align: justify;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <?php
        echo '
        <header>
            <div class="container logo">
                <img src="pmay-logo-Urban.jpg" alt="Urban" class="logo">
                <img src="images-91-300x168.jpg" alt="Ministry" class="logo">
                <img src="pmay-gramin-logo.jpg" alt="Rural" class="logo">
            </div>
        </header>

        <nav class="subheader">
            <ul>
                <li><a href="index.html"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="#about"><i class="fas fa-info-circle"></i>About Us</a></li>
                <li><a href="#contact"><i class="fas fa-envelope"></i>Contact Us</a></li>
                <li><a href="#user"><i class="fas fa-user"></i>User</a></li>
            </ul>
        </nav>

        <section class="fullContainer" id="aboutSection">
            <div class="container">
                <h2 class="sectionTitle">About Us</h2>
                <p>
                    The Pradhan Mantri Awas Yojana (PMAY) is a flagship housing scheme launched by the Government of India on June 17, 2015,  
                    with the goal of providing affordable housing for all citizens, 
                    particularly the economically weaker sections (EWS), 
                    low-income groups (LIG), and middle-income groups (MIG). 
                    The scheme aims to address the critical housing shortage in urban areas and promote inclusive development.
                </p>

                <div class="pmay-box">
                    <img src="Picture10.jpg" alt="PMAY Urban">
                    <div>
                        <h3>PMAY Urban</h3>
                        <p>
                            PMAY Urban aims to provide affordable housing to the urban poor. It focuses on slum redevelopment and housing for the economically weaker sections in cities. 
                            This component provides financial assistance through the Credit-Linked Subsidy Scheme, ensuring access to affordable housing in urban areas.
                        </p>
                    </div>
                </div>

                <div class="pmay-box">
                    <img src="pmay-gramin.jpg" alt="PMAY Rural">
                    <div>
                        <h3>PMAY Rural</h3>
                        <p>
                            PMAY Rural targets providing housing for the rural population. It aims to build pucca houses for families living in kutcha houses. 
                            This component not only addresses the housing needs of the rural poor but also promotes the use of local materials and labor, enhancing rural livelihoods.
                        </p>
                    </div>
                </div>

                <h3>Implementation</h3>
                <p>
                    PMAY is implemented through a collaborative approach involving the central government, state governments, and urban local bodies. 
                    The initiative also encourages private sector participation in providing housing solutions.
                </p>

                <h3>Achievements</h3>
                <p>
                    Since its launch, PMAY has facilitated the construction and sanction of millions of houses across the country, significantly improving the living standards of many families and contributing to the government\'s vision of “Housing for All.”
                </p>
            </div>
        </section>';
    ?>
</body>
</html>
