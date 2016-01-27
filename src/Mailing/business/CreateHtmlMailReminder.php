<?php

/**
 * Class CreateHtmlMail
 *
 * Create the complete html mail
 */
class CreateHtmlMailReminder
{
    /**
     * Creates the complete html mal
     *
     * @return string the complete html mail
     */
    public function CreateHTMLMailing()
    {
        // init html section classes
        $priming = new HtmlReminder();
        $footer = new HtmlFooter();

        // gets the html header information
        $htmlheadmeta = $this->GetHtmlHeadMeta();

        // gets the html sections
        $priming_html =  $priming->GetHtmlPriming();
        $footer_html = $footer->GetHtmlFooter();


        // build and return the full html mail
        return
            $htmlheadmeta
            .$priming_html
            .$footer_html
            .'
            </div>
            </body>
            </html>';
    }

    /**
     * Define the head for the html mail
     *
     * @return string the html meta head
     */
    private function GetHtmlHeadMeta()
    {
        return '<!DOCTYPE html>
                <html lang="en">
                <head>
                <!-- importend charset=utf-8 and http-equiv="Content-Type" for the inline css -->
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Your personal amphiro Report</title>
                </head>
                <body>
                <div id="page-wrap">';
    }
}
