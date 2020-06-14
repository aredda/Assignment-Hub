<?php

class Layout
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function generate()
    {
        echo 
        "<html>
            <head>
                <title>PHP Module Project</title>
                <link rel='stylesheet' href='bootstrap/css/bootstrap.css'/>
                <link rel='stylesheet' href='stylesheets/style.css'/>
                <script type='text/javascript' src='scripts/jquery.js'></script>
            </head>
            <body class='bg-light'>
                <div class='container-fluid'>
                    <div class='row bg-orange'>
                        <div class='col-lg-12 py-1 text-shadow h2 text-center'>
                            <a class='text-white' href='index.php'>Revision Project</a>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3 p-2'>";
                            include 'navigation-bar.php'; 
                            echo "
                        </div>
                        <div class='col-lg-9'>
                            <div class='row'>
                                <div class='col-lg-12 p-5'>";
                                    if (!is_null($this->content)) 
                                        include $this->content;
                                    else
                                        include "default.php";
                                echo "</div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type='text/javascript' src='scripts/script.js'></script>
            </body>
        </html>";
    }
}