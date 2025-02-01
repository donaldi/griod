<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\Datum;
use KateMorley\Grid\State\Emissions;
use KateMorley\Grid\State\Price;

use KateMorley\Grid\UI\GDate;

/** Outputs the status. */
class Status
{
    /**
     * Outputs the status.
     *
     * @param Datum  $datum The datum
     * @param string $time  The time
     * @param bool   $help  Whether to show the help
     */
    public static function output(
        Datum $datum,
        string $time,
        bool $help = false
    ): void {
        ?>
          <dl>
            <dt>Uair<?php if (
                $help
            ) { ?> <span data-help="<p>Tha dàta air na chaidh a ghintinn de chumhachd (ach cumhachd grèine) air ùrachadh gach còig mionaidean. Tha dàta air cumhachd grèine agus aiseag lùtha air ùrachadh gach trithead mionaid.</p>"></span><?php } ?></dt>
            <dd><?= $time ?></dd>
            <dt>Prìs<?php if (
                $help
            ) { ?>  <span data-help="<p>Leis gu bheil dealan air a reic ’s air a cheannach ann am margaidh, chan eil dìreach aon phrìs air: faodaidh luchd-ceannach agus luchd-reic cùmhnant aontachadh uairean, lathaichean, seachdainean no mìosan ro-làimh. Tha an làrach seo a’ sealltainn prìs mòr-reic an dealain aig an àm ann am Breatainn.</p><p>Tha prìsean àrda a’ brosnachadh barrachd gintinn agus nas lugha cleachdaidh, agus tha buaidh phrìsean ìosal calg-dhìreach an aghaidh sin. Tha grunn dhòighean air cumhachd ath-nuadhachail a ghintinn a’ faighinn subsadaidh fo sgeama <a href=\'https://www.gov.uk/government/publications/contracts-for-difference/contract-for-difference\'>Cùmhnantan a nì Diofar / Contracts For Difference</a>, agus ’s urrainn dhaibh cumhachd a ghintinn gu prothaideach ged a bhiodh a’ phrìs fo neoni.</p>"></span><?php } ?></dt>
            <dd><?= Value::formatPrice(
                $datum->price->get(Price::PRICE)
            ) ?><abbr>/MWh</abbr></dd>
            <dt>Eimiseanan<?php if (
                $help
            ) { ?> <span data-help="<p>Nuair a tha gual, gas agus bith-thomad air an losgadh tha seo a’ dèanamh carbon dà-ogsaid. Tha na tha de charbon dà-ogsaid anns an àile air èirigh bho 280 pàirt gach millean ro Mhòr-chaochladh a’ Ghnìomhachais gu còrr is 400 pàirt gach millean an-diugh. ’S e seo as coireach ri èiginn na gnàth-shìde, nuair a tha teòthachdan cuibheasach ag èirigh agus ag adhbharachadh dian-shìde a tha a’ sìor fhàs nas miosa.</p><p>Tha Buidheann-rianachd Nàiseanta Chuantan agus Àile (The National Oceanic And Atmospheric Administration) air a bhith a’ tragadh <a href=\'https://gml.noaa.gov/ccgg/trends/mlo.html\'>ìrean carbon dà-ogsaid san àile</a> bho 1958.</p>"></span><?php } ?></dt>
            <dd><?= (int) $datum->emissions->get(
                Emissions::EMISSIONS
            ) ?><abbr>g/kWh</abbr></dd>
          </dl>
<?php
    }

    /**
     * Formats a time as HTML and returns it.
     * Uses m/f instead of am/pm for Gaelic.
     *
     * @param int $time The time
     */
    public static function time(int $time): string
    {
        $abbr = GDate::fmt("a", $time);
        return '<time datetime="' .
            gmdate("Y-m-d\TH:i:s\Z", $time) .
            '">' .
            date("g:i", $time) .
            "<abbr>" .
            $abbr .
            "</abbr></time>";
    }
}
