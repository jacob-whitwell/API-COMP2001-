<?php
$active_page = "home";
include_once('header.php');

?>


<body>
<!-- Header with image -->
<style>
    body, html {
        height: 100%;
        font-family: "Inconsolata", sans-serif;
    }
    .bgimg {
        background-position: center;
        background-size: cover;
        background-image: url("../assets/img/smog.jpg");
        min-height: 40%;
    }
</style>

<header class="bgimg" id="home">
</header>
<!-- Add the large text to the whole page -->
<div class="container-fluid mt-5 px-5" style="margin: auto; width:65vw; text-align: center;">
    <div class="row">
        <div class="col-sm-6">
            <div class="main-text" style="text-align: left;">
                <h2>Welcome to the Air Quality in Plymouth application</h2><br>
                <p> Air pollution can cause damage to healthy lungs whilst also making it harder to breathe for people who
                    live with lung disease. If you would like to know more, please visit <a href="https://www.blf.org.uk/taskforce/data-tracker/air-quality/pm25">Taskforce for Lung Health.</a></p>
                <p>
                    Currently, the legal limits for Fine Particulate Matter (PM<sub>2.5</sub>) within the United Kingdom are set almost twice as high as is recommended by the World Health Organisation (WHO). (<i>source: <a href="https://www.blf.org.uk/taskforce/data-tracker/air-quality/pm25">https://www.blf.org.uk/taskforce/data-tracker/air-quality/pm25</a></i>)
                    and an estimated staggering 29,000 premature deaths are caused by overexposure to PM<sub>2.5</sub> (<i>source: <a href="https://assets.publishing.service.gov.uk/government/uploads/system/uploads/attachment_data/file/304641/COMEAP_mortality_effects_of_long_term_exposure.pdf">https://publishing.service.gov.uk/COMEAP_mortality_effects_of_long_term_exposure.pdf</a>, p.2</i>)
                </p>

                <p>Currently, the WHO guideline exposure to PM<sub>2.5</sub> is set to an annual mean of <b>just 5 micrograms per cubic metre</b> (μg/m3) </p>

                <p>The purpose of this web application is to utilise the semantic web, showing data in both human readable format and also semantic mark-up for machine-to-machine usage to help highlight this issue.</p>

                <p>
                    This website processes the data from a CSV file provided by DATA Place Plymouth, found here: <a href="https://plymouth.thedata.place/dataset/air-quality-data">https://plymouth.thedata.place/dataset/air-quality-data</a>
                </p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="rdf-text">
                <h2>RDF Data</h2>
                <p>
                    The data has additionally been processed for machine-to-machine reading. If you would like to see the RDF data, a specific page has been created on this website with a base url:
                    <a href="../quality/index.php">http://web.socem.plymouth.ac.uk/COMP2001/jwhitwell/quality/</a>.
                </p>
                <p>
                    This page will provide the necessary JSON-LD markup for the air quality data in Plymouth.
                </p>
                <p>
                    Please click <a href="../quality/index.php">here</a> to see the RDF, or alternatively click the button below.
                </p>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 75px;">
        <div class="col-sm-6">
                <a href="data.php" class="btn btn-primary" style="width: 100%;">View Data</a>
        </div>
        <div class="col-sm-6">
            <a href="../quality/index.php" class="btn btn-secondary" style="width: 100%;">View RDF</a>
        </div>

    </div>
</div>
<?php include_once('footer.php'); ?>


</body>

